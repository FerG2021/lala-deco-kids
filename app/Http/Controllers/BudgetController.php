<?php

namespace App\Http\Controllers;

use App\Http\Models\Budget;
use App\Http\Models\Product;
use App\Http\Models\BudgetProduct;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Validator, Str, Config, Image;

use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

class BudgetController extends Controller
{
    // generar nuevo presupuesto
    public function getNewBudget(){
        $now = Carbon::now();

        return view('pages.budget.newbudget')->with('now', $now);
    }

    public function postNewBudget(Request $request){
        $rules = [
            'nameseller' => 'required',
            'nameclient' => 'required', 
            'datesale' => 'required',                
        ];

        $messages = [
            'nameseller.required' => 'El nombre del vendedor es requerido',            
            'nameclient.required' => 'El nombre del cliente es requerido',
            'datesale.required' => 'La fecha del presupuesto es requerida'           
        ];

        $validator = Validator::make($request->all(), $rules, $messages);       

        if ($validator->fails()) {
            return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'alert alert-danger');
        } else {
           $budget = new Budget();

           $budget->nameClient = $request->get('nameclient');
           $budget->date = $request->get('datesale');
           $budget->nameSeller = $request->get('nameseller');
           $budget->totalPrice = 0;

           if ($budget->save()) {
                return redirect('/budget'.'/'.$budget->id.'/'.'addbudgetproducts')->with('message', 'Se comenzó a generar un nuevo presupuesto...')->with('typealert', 'alert alert-primary');
           } else {
               # code...
           }
        }
    }

    public function getAddBudgetProducts($id){
        $products = Product::orderBy('nameProduct', 'asc')->get();

        $budgetproducts = BudgetProduct::where('budgetId', $id)->get();

        return view('pages.budget.addnewbudgetproduct')->with('id', $id)->with('products', $products)->with('budgetproducts', $budgetproducts);

    }

    // agregar producto al presupuesto
    public function postAddNewBudgetProduct(Request $request, $id){
        $rules = [
            'barcodeproduct' => 'required',
            'nameproduct' => 'required', 
            'stockproduct' => 'required', 
            'pricesaleproduct' => 'required',
            'cantsaleproduct' => 'required',                  
        ];

        $messages = [
            'barcodeproduct.required' => 'El codigo del producto es requerido',            
            'nameproduct.required' => 'El nombre del producto es requerido',
            'stockproduct.required' => 'El stock del producto es requerido',
            'pricesaleproduct.required' => 'El precio de venta del prodcuto es requerido',
            'cantsaleproduct.required' => 'La cantidad es requerida',            
        ];

        $validator = Validator::make($request->all(), $rules, $messages);  
        
        if ($validator->fails()) {
            return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'alert alert-danger');
        } else {
            // controlo la cantidad de stock disponible
            $productstock = Product::find($request->get('idproduct'));

            if ($productstock->cantStockProduct >= $request->get('cantsaleproduct')) {

                $budgetproduct = new BudgetProduct();

                $budgetproduct->budgetId = $id;
                $budgetproduct->name = $request->get('nameproduct');
                $budgetproduct->cantProduct = $request->get('cantsaleproduct');
                $budgetproduct->priceProduct = $request->get('pricesaleproduct');
                $budgetproduct->subtotal = $request->get('cantsaleproduct') * $request->get('pricesaleproduct');                
               
                if ($budgetproduct->save()) {
                    return redirect('/budget'.'/'.$id.'/'.'addbudgetproducts')->with('message', 'Producto añadido con éxito')->with('typealert', 'alert alert-success');
                } else {                    
                }
            } else {
                return back()->with('message', 'No hay suficiente stock')->with('typealert', 'alert alert-danger');
            }
        }
    }

    // eliminar producto del presupuesto
    public function getDeleteBudgetProduct($id){
        $budgetproduct = BudgetProduct::find($id);

        $budgetproduct->delete();

        return back()->with('message', 'Producto quitado del presupuesto con éxito')->with('typealert', 'alert alert-success');
    }

    // confirmar presupuesto
    public function postAddNewBudgetConfirm(Request $request){
        $rules = [
            //'code' => 'required|unique:App\Http\Models\Product,code',
            'totalBudgetInput3' => 'required',
            'idInput' => 'required'                               
        ];

        $messages = [
            'totalBudgetInput3.required' => 'El precio total del presupuesto es requerido',
            'idInput.required' => 'El id del presupuesto es requerido'           
        ];

        $validator = Validator::make($request -> all(), $rules, $messages);

        if ($validator->fails()):
           return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'alert alert-danger')->withInput(); //para que si falla la validacion cuando vuelva atras vuelva con los valores cargados
        else:                        
           
            $id = $request->get('idInput');

            $budget = Budget::find($id);

            $budget->totalPrice = $request->get('totalBudgetInput3');

           if($budget->save()):
               return redirect('/budget/listbudget')->with('message', 'Presupuesto guardado con éxito')->with('typealert', 'alert alert-success');
           else:
                return back()->with('message', 'No se pudo gurdar')->with('typealert', 'alert alert-success');
           endif;  
        endif;         
    }

    // cancelar presupuesto
    public function getCanceNewBudget($id){
        $budget = Budget::find($id);

        $budget->delete();

        return redirect('/budget/newbudget')->with('message', 'Presupuesto cancelado con éxito')->with('typealert', 'alert alert-success');
    }

    // lista de presupuestos
    public function getListBudget(){
        $budgets = Budget::where('totalPrice', '>', 0)->orderBy('id', 'desc')->get();
        $budgetproducts = BudgetProduct::all();

        return view('pages.budget.listbudget')->with('budgets', $budgets)->with('budgetproducts', $budgetproducts);
    }

    // detalle de presupuestos
    public function getBudgetDetail($id){
        $budgetproducts = BudgetProduct::where('budgetId', '=', $id)->get();

        $budget = Budget::find($id);

        return view('pages.budget.budgetdetail')->with('budgetproducts', $budgetproducts )->with('budget', $budget)->with('id', $id);
    }

    // generara PDF
    public function getPDF($id){
        //$pdf = resolve('dompdf.wrapper');

        //$pdf->loadHTML('<h1>Test</h1>');

        
        $budgetproducts = BudgetProduct::where('budgetId', $id)->get();

        $budget = Budget::find($id);

        $pdf = \PDF::loadView('pages.budget.newpdf', compact('budgetproducts', 'budget'));

        //return $pdf->download('pages.budget.newpdf.pdf');


        // $budgetproducts = BudgetProduct::where('budgetId', $id);
        

        // return $pdf->stream('pages.budget.newpdf.pdf',compact('budgetproducts'));


        return $pdf->stream('pages.budget.newpdf.pdf');
    }

    // imprimir ticket
    public function getTicketBudget($id){
        $budgetproducts = BudgetProduct::where('budgetId', $id)->get();
        $budget = Budget::find($id);


        /*
            Este ejemplo imprime un
            ticket de venta desde una impresora térmica
        */


        /*
            Aquí, en lugar de "POS" (que es el nombre de mi impresora)
            escribe el nombre de la tuya. Recuerda que debes compartirla
            desde el panel de control
        */

        /*$nombre_impresora = "POS";*/

        $nombre_impresora = "TICKETERA";
        


        $connector = new WindowsPrintConnector($nombre_impresora);
        $printer = new Printer($connector);
        #Mando un numero de respuesta para saber que se conecto correctamente.
        // echo 1;
        /*
            Vamos a imprimir un logotipo
            opcional. Recuerda que esto
            no funcionará en todas las
            impresoras

            Pequeña nota: Es recomendable que la imagen no sea
            transparente (aunque sea png hay que quitar el canal alfa)
            y que tenga una resolución baja. En mi caso
            la imagen que uso es de 250 x 250
        */

        # Vamos a alinear al centro lo próximo que imprimamos
        $printer->setJustification(Printer::JUSTIFY_CENTER);

        /*
            Intentaremos cargar e imprimir
            el logo
        */
        // try{
        //     $logo = EscposImage::load("geek.png", false);
        //     $printer->bitImage($logo);
        // }catch(Exception $e){/*No hacemos nada si hay error*/}

        /*
            Ahora vamos a imprimir un encabezado
        */

        $printer->text("\n LALA DECO KIDS \n");
        $printer->text("Direccion: Moreno 163\n");
        $printer->text("Tel: 3843-674065 \n");
        #La fecha también
        date_default_timezone_set("America/Argentina/Buenos_Aires");
        $printer->text(date("d-m-Y H:i:s") . "\n");
        $printer->text("-----------------------------" . "\n");
        $printer->text("PRESUPUESTO" . "\n");
        $printer->setJustification(Printer::JUSTIFY_LEFT);
       
        // Datos de la venta
        $printer->text("Vendedora:" . " $budget->nameSeller " . "\n");
        $printer->text("Cliente:" . " $budget->nameClient " . "\n");
        $printer->text("Nro de presupuesto:" . " $budget->id " . "\n");
        $printer->text("-----------------------------" . "\n");


        $printer->text("CANT  DESCRIPCION    P.U   IMP.\n");
        $printer->text("-----------------------------"."\n");
        
        
        /*
            Ahora vamos a imprimir los
            productos
        */
            /*Alinear a la izquierda para la cantidad y el nombre*/
            $printer->setJustification(Printer::JUSTIFY_LEFT);
            // $printer->text("Producto Galletas\n");
            // $printer->text( "2  pieza    10.00 20.00   \n");
            // $printer->text("Sabrtitas \n");
            // $printer->text( "3  pieza    10.00 30.00   \n");
            // $printer->text("Doritos \n");
            // $printer->text( "5  pieza    10.00 50.00   \n");

            // pregunto si la venta es CF o CC
            foreach ($budgetproducts as $budgetproduct) {
                // $date = date('d-m-Y', strtotime($cadetail->date));
                $printer->text("$budgetproduct->cantProduct     $budgetproduct->name    $budgetproduct->priceProduct    $budgetproduct->subtotal \n");
            }
            
        /*
            Terminamos de imprimir
            los productos, ahora va el total
        */
        $printer->text("-----------------------------"."\n");
        $printer->setJustification(Printer::JUSTIFY_RIGHT);
        $printer->text("TOTAL: $ $budget->totalPrice\n");
        // $printer->text("IVA: $16.00\n");
        // $printer->text("TOTAL: $116.00\n");


        /*
            Podemos poner también un pie de página
        */
        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->text("Muchas gracias\n");



        /*Alimentamos el papel 3 veces*/
        $printer->feed(3);

        /*
            Cortamos el papel. Si nuestra impresora
            no tiene soporte para ello, no generará
            ningún error
        */
        $printer->cut();

        /*
            Por medio de la impresora mandamos un pulso.
            Esto es útil cuando la tenemos conectada
            por ejemplo a un cajón
        */
        $printer->pulse();

        /*
            Para imprimir realmente, tenemos que "cerrar"
            la conexión con la impresora. Recuerda incluir esto al final de todos los archivos
        */


        $printer->close();

        return back()->with('message', 'Ticket generado con exito')->with('typealert', 'alert alert-success'); 
    }

    


}
