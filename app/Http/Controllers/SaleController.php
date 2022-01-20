<?php

namespace App\Http\Controllers;

use App\Http\Models\Sale;
use App\Http\Models\Product;
use App\Http\Models\SaleProduct;
use App\Http\Models\Client;
use App\Http\Models\CurrentAccount;
use App\Http\Models\CurrentAccountDetail;
use Illuminate\Http\Request;
use Validator, Str, Config, Image;
use Carbon\Carbon;

use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;


class SaleController extends Controller
{
    // seleccionar el tipo de venta
    public function getSelectNewSale(){

        $products = Product::all();

        $productconsults = Product::orderBy('nameProduct', 'asc')->get();

        $now = Carbon::now();

        return view('pages.sale.selectnewsale')->with('products', $products)->with('now', $now)->with('productconsults', $productconsults);
    }

    // venta - consumidor final
    public function postNewSaleCF(Request $request){
        // creo la venta
        $sale = new Sale();
            // 0 - cf       1 - p
        $sale->typeSale = 0;
        $sale->idClient =  0;
        $sale->nameSeller = $request->get('nameSeller');
        $sale->nameBuyer = 'Consumidor final';
        $sale->dateSale = $request->get('dateSale');
        $sale->totalPrice = 0;

        if ($sale->save()) {
            return redirect('/sale'.'/'.$sale->id.'/'.'addnewsalecf')->with('message', 'Se comenzó a generar una nueva venta...')->with('typealert', 'alert alert-primary');
        } else {
            # code...
        }
    }


    // anadir productos a la venta - consumidor final
    public function getAddSaleProductCF($id){
        $products = Product::orderBy('nameProduct', 'asc')->get();
        $productconsults = Product::orderBy('nameProduct', 'asc')->get();
        $saleproducts = SaleProduct::where('saleId', $id)->get();
        
        $productsearch = Product::find(0);

        return view('pages.sale.saledetailcf')->with('products', $products)->with('productconsults', $productconsults)->with('saleproducts', $saleproducts)->with('id', $id)->with('productsearch', $productsearch);
    }


    
    public function postAddNewSaleProductCF($id, Request $request){
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
            'cantsaleproduct.required' => 'La cantidad a vender es requerida',            
        ];

        $validator = Validator::make($request->all(), $rules, $messages);  
        
        if ($validator->fails()) {
            return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'alert alert-danger');
        } else {
            // controlo la cantidad de stock disponible
            $productstock = Product::find($request->get('idproduct'));

            if ($productstock->cantStockProduct >= $request->get('cantsaleproduct')) {
                $saleproduct = new SaleProduct();

                $saleproduct->saleId = $id;
                $saleproduct->idProduct = $request->get('barcodeproduct');
                $saleproduct->name = $request->get('nameproduct');
                $saleproduct->cantProduct = $request->get('cantsaleproduct');
                $saleproduct->priceProductSale = $request->get('pricesaleproduct');
                $saleproduct->priceProductTrust = 0;
                $saleproduct->subtotal = $request->get('cantsaleproduct') * $request->get('pricesaleproduct');

                if ($saleproduct->save()) {
                    return redirect('/sale'.'/'.$id.'/'.'addnewsalecf')->with('message', 'Producto añadido con éxito')->with('typealert', 'alert alert-success');
                } else {                    
                }
            } else {
                return back()->with('message', 'No hay suficiente stock para realizar la venta')->with('typealert', 'alert alert-danger');
            }
        }
    }

    // eliminar producto de la venta
    public function getDeleteSaleProductCF($id){
        $saleproduct = SaleProduct::find($id);

        $saleproduct->delete();

        return back()->with('message', 'Producto eliminado de la venta con éxito')->with('typealert', 'alert alert-success');
    }

    // confirmar venta - consumidor final
    public function postAddNewSaleConfirmCF(Request $request){
        $rules = [
            'totalBudgetInput3' => 'required',            
            'idSaleInput' => 'required',                        
        ];

        $messages = [
            'totalBudgetInput3.required' => 'El precio total de la venta es requerido',    
            'idSaleInput.required' => 'El id de la venta es requerido',                      
        ];

        $validator = Validator::make($request->all(), $rules, $messages);  

        if ($validator->fails()) {
            return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'alert alert-danger');
        } else {
            
            // guardo el valor total de la venta
            $id = $request->get('idSaleInput');            
            $sale = Sale::find($id);
            $sale->totalPrice = $request->get('totalBudgetInput3');

            if ($sale->save()) {
                
                // actualizo el stock de los productos
                $productsales = SaleProduct::where('saleId', $id)->get();

                foreach ($productsales as $productsale) {
                    $products = Product::where('codeProduct', $productsale->idProduct)->get();
                    foreach ($products as $product) {
                        $product->cantStockProduct = $product->cantStockProduct - $productsale->cantProduct;
                        $product->save();
                    }
                }

                return redirect('/sale/listsales')->with('message', 'Venta realizada con éxito')->with('typealert', 'alert alert-success'); 

            } else {
                # code...
            }
            
        }
        
    }

    // cancelar venta - consumidor final
    public function getCancelNewSaleCF($id){
        $sale = Sale::find($id);

        $sale->delete();

        return redirect('/sale/selectnewsale')->with('message', 'Venta cancelada con éxito')->with('typealert', 'alert alert-success');
    }

    // nueva venta - cuenta corriente
    public function getNewSaleCA(){

        $clients = Client::orderBy('lastNameClient', 'asc')->get();

        $now = Carbon::now();

        return view('pages.sale.newsaleca')->with('clients', $clients)->with('now', $now);
    }

    public function postNewSaleCA(Request $request){
        $rules = [
            'nameseller' => 'required',            
            'namebuyer' => 'required', 
            'datesale' => 'required'
        ];

        $messages = [
            'nameseller.required' => 'El nombre del vendedor es requerido',    
            'namebuyer.required' => 'El nombre del comprador es requerido',                      
            'datesale.required' => 'La fecha de venta es requerida'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);  

        if ($validator->fails()) {
            return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'alert alert-danger');
        } else {
            // genero una nueva venta
            $sale = new Sale();

            $sale->typeSale = 1;
            $sale->idClient = $request->get('namebuyer');
            $sale->nameSeller = $request->get('nameseller');
            $sale->nameBuyer = $request->get('nameclientinput');
            $sale->dateSale = $request->get('datesale');
            $sale->totalPrice = 0;

            // buscar id, nombre y apellido del cliente
            $idclient = $request->get('nameseller');
            $client = Client::find($idclient);

            if ($sale->save()) {
                return redirect('/sale'.'/'.$sale->id.'/'.'addsaleproductsca')->with('message', 'Se comenzó a generar una nueva venta...')->with('typealert', 'alert alert-primary')->with('client', $client);
            } else {
                # code...
            }
            
        }
    }

    // detalles de nueva venta - Cuenta corriente
    public function getAddSaleProductsCA($id){
        // datos del cliente
        $sale = Sale::find($id);
        $client = Client::find($sale->idClient);

        // productos en stock
        $products = Product::orderBy('nameProduct', 'asc')->get();

        // productos de la venta
        $saleproducts = SaleProduct::where('saleId', $id)->get();

        // consulta de productos
        $productconsults = Product::orderBy('nameProduct', 'asc')->get();

        return view('pages.sale.saledetailaca')->with('id', $id)->with('client', $client)->with('products', $products)->with('saleproducts', $saleproducts)->with('sale', $sale)->with('productconsults', $productconsults);
    }

    // agregar productos a la venta - Cuenta corriente
    public function postAddNewSaleProductCA(Request $request, $id){
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
            'cantsaleproduct.required' => 'La cantidad a vender es requerida',            
        ];

        $validator = Validator::make($request->all(), $rules, $messages);  
        
        if ($validator->fails()) {
            return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'alert alert-danger');
        } else {
            // controlo la cantidad de stock disponible
            $productstock = Product::find($request->get('idproduct'));

            if ($productstock->cantStockProduct >= $request->get('cantsaleproduct')) {
                $saleproduct = new SaleProduct();

                $saleproduct->saleId = $id;
                $saleproduct->idProduct = $request->get('barcodeproduct');
                $saleproduct->name = $request->get('nameproduct');
                $saleproduct->cantProduct = $request->get('cantsaleproduct');
                $saleproduct->priceProductSale = 0;
                $saleproduct->priceProductTrust = $request->get('pricesaleproduct');
                $saleproduct->subtotal = $request->get('cantsaleproduct') * $request->get('pricesaleproduct');

                if ($saleproduct->save()) {
                    return redirect('/sale'.'/'.$id.'/'.'addsaleproductsca')->with('message', 'Producto añadido con éxito')->with('typealert', 'alert alert-success');
                } else {                    
                }
            } else {
                return back()->with('message', 'No hay suficiente stock para realizar la venta')->with('typealert', 'alert alert-danger');
            }
        }
    }

    // quitar producto de la venta - Cuenta corriente
    public function getDeleteSaleProductCA($id){
        $saleproduct = SaleProduct::find($id);

        $saleproduct->delete();

        return back()->with('message', 'Producto eliminado de la venta con éxito')->with('typealert', 'alert alert-success');
    }

    // guardar venta - Cuenta corriente
    public function postAddNewSaleConfirmCA(Request $request){
        $rules = [
            'dateSale' => 'required',
            // 'totalBudgetInput6' => 'required',   
            'totalBudgetInput3' => 'required',
            'idSaleInput' => 'required',
            'idClientInput' => 'required',
            'dniClient' => 'required',
            'nameClientInput' => 'required',
            'lastNameClientInput' => 'required',
            'totalPayClient' => 'required'                  
        ];

        $messages = [
            'dateSale.required' => 'La fecha de venta es requerida',            
            // 'totalBudgetInput6.required' => 'Precio total 6 es requerido',
            'totalBudgetInput3.required' => 'El precio total de la venta es requerido',            
            'idSaleInput.required' => 'El id de la venta es requerido',
            'idClientInput.required' => 'El id del comprador requerido',            
            'dniClient.required' => 'El DNI del comprador es requerido',
            'nameClientInput.required' => 'El nombre del comprador es requerido',            
            'lastNameClientInput.required' => 'El apellido del cliente es requerido',  
            'totalPayClient.requires' => 'El total pagado por el cliente es requerido'                    
        ];

        $validator = Validator::make($request->all(), $rules, $messages);  

        if ($validator->fails()) {
            return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'alert alert-danger');
        } else {
            // guardo el precio total en la venta
            $id = $request->get('idSaleInput');
            $sale = Sale::find($id);
            $sale->totalPrice = $request->get('totalBudgetInput3');
            
            if ($sale->save()) {
                // actualizo el stock de los productos
                $productsales = SaleProduct::where('saleId', $id)->get();

                foreach ($productsales as $productsale) {
                    $products = Product::where('codeProduct', $productsale->idProduct)->get();
                    foreach ($products as $product) {
                        $product->cantStockProduct = $product->cantStockProduct - $productsale->cantProduct;
                        $product->save();
                    }
                }


                // pregunto si la cantidad pagada por el cliente es mayor al precio total de la compra
                if ($request->get('totalPayClient') <= $request->get('totalBudgetInput3')) {
                    // pregunto si el cliente ya tiene cuenta corriente
                    $clientcas = CurrentAccount::where('clientId', $request->get('idClientInput'))->get();

                    $clientId = null;
                    
                    foreach ($clientcas as $clientca) {
                        $clientId = $clientca->clientId;
                    }

                    if ($clientId != null) {
                        // actualizo la cuenta corriente
                        $clientca->balance = $clientca->balance + ( $request->get('totalBudgetInput3') - $request->get('totalPayClient'));
                        $clientca->datelastaction = $request->get('dateSale');
                        $clientca->save();
                        
                        // guardo los detalles de la compra que se guardan en la cuenta corriente
                        $cadetail = new CurrentAccountDetail();
                        
                        $cadetail->idCurrentAccount = $clientca->id;
                        $cadetail->idClient = $request->get('idClientInput');
                        $cadetail->idsale = $request->get('idSaleInput');
                        $cadetail->date = $request->get('dateSale');
                        // 0 - compra // 1 - pago
                        $cadetail->typemovement = 0;
                        $cadetail->pay = 0;
                        $cadetail->sale = $request->get('totalBudgetInput3') - $request->get('totalPayClient');

                        $cadetail->save();

                    } else {
                        // creo una cuenta corriente para el cliente
                        $currentaccount = new CurrentAccount();

                        $currentaccount->clientId = $request->get('idClientInput');
                        $currentaccount->dniClient = $request->get('dniClient');
                        $currentaccount->nameClient = $request->get('nameClientInput');
                        $currentaccount->lastNameClient = $request->get('lastNameClientInput');
                        $currentaccount->balance = $currentaccount->balance + ($request->get('totalBudgetInput3') - $request->get('totalPayClient'));
                        $currentaccount->datelastaction = $request->get('dateSale');

                        $currentaccount->save();

                        // guardo los detalles de la compra que se guardan en la cuenta corriente
                        $cadetail = new CurrentAccountDetail();

                        $cadetail->idCurrentAccount = $currentaccount->id;
                        $cadetail->idClient = $request->get('idClientInput');
                        $cadetail->idsale = $request->get('idSaleInput');
                        $cadetail->date = $request->get('dateSale');
                        // 0 - compra // 1 - pago
                        $cadetail->typemovement = 0;
                        $cadetail->pay = 0;
                        $cadetail->sale = $request->get('totalBudgetInput3') - $request->get('totalPayClient');

                        $cadetail->save();
                        
                    }
                    
                } else {
                    return back()->with('message', 'El pago del cliente no puede ser mayor al monto total de la venta')->with('typealert', 'alert alert-danger');
                }
                
            } else {
                # code...
            }
            
            // actualizo el campo deudors si corresponde
                // pregunto por la fecha, si es superior a 30 actualizo el campor deudors

                $clientcas = CurrentAccount::orderBy('lastNameClient', 'asc')->get();
                $now = Carbon::now();
                
                $deudors = 0;

                // consulto si la fecha de deuda es mayor a 30 dias
                foreach ($clientcas as $clientca) {
                    $dateca = Carbon::parse($clientca->datelastaction);
                    $datenow = Carbon::parse($now);
                    $diference = $dateca->diffInDays($datenow);
                    if ($diference >= 30) {
                        //fecha mayor a 30
                        $deudors = 1;

                        // actualizo el campo deudors en la tabla
                        $id = $clientca->id;
                        $clientdeudor = CurrentAccount::find($id);

                        $clientdeudor->deudors = 1;
                        $clientdeudor->save();

                        // return view('pages.currentaccount.listca')->with('clientcas', $clientcas)->with('now', $now)->with('deudors', $deudors);
                    } else {
                        // actualizo el campo deudors en la tabla
                        $id = $clientca->id;
                        $clientdeudor = CurrentAccount::find($id);
                        $clientdeudor->deudors = 0;
                        $clientdeudor->save();
                    }            
                }
                

                return redirect('/sale/listsales')->with('message', 'Venta realizada con éxito')->with('typealert', 'alert alert-success');

        }
    }

    // cancelar venta - Cuenta corriente
    public function getCancelNewSaleCA($id){
        $sale = Sale::find($id);

        $sale->delete();

        return redirect('/sale/selectnewsale')->with('message', 'Venta cancelada con éxito')->with('typealert', 'alert alert-success');

    }


    // historial de ventas
    public function getListSales(){
        $sales = Sale::where('totalPrice', '>', '0')->orderBy('id', 'desc')->get();
        // $saleproducts = SaleProduct::where('saleId', $id)->get();
        $saleproducts = SaleProduct::all();


        return view('pages.sale.listsales')->with('sales', $sales)->with('saleproducts', $saleproducts);
    }

    // filtrar ventas por fecha

    public function getFilterDateSale(Request $request){
        $rules = [
            'dateinit' => 'required',
            'datefinish' => 'required',                       
        ];

        $messages = [            
            'dateinit.required' => '.',
            'datefinish.required' => '.',
        ];

        $validator = Validator::make($request -> all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect('/sale/listsales')->withErrors($validator)->with('message', 'Ticket generado con exito')->with('typealert', 'alert alert-success')->withInput();
        } else {
            $sales = Sale::where([['dateSale', '>=', $request->get('dateinit')], ['dateSale', '<=', $request->get('datefinish')], ['totalPrice', '>', '0']])->get();

            $dateinit = $request->get('dateinit');
            $datefinish = $request->get('datefinish');

            $saleproducts = SaleProduct::all();

            return view('pages.sale.listsales')->with('sales', $sales)->with('saleproducts', $saleproducts);
        }       
    }

    public function postFilterDateSale(Request $request){
        $rules = [
            'dateinit' => 'required',
            'datefinish' => 'required',                       
        ];

        $messages = [            
            'dateinit.required' => 'La fecha de inicio es requerida',
            'datefinish.required' => 'La fecha de finalización es requerida',
        ];

        $validator = Validator::make($request -> all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect('/sale/listsales')->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'alert alert-danger')->withInput();
        } else {
            $sales = Sale::where([['dateSale', '>=', $request->get('dateinit')], ['dateSale', '<=', $request->get('datefinish')], ['totalPrice', '>', '0']])->get();

            $dateinit = $request->get('dateinit');
            $datefinish = $request->get('datefinish');

            $saleproducts = SaleProduct::all();

            return view('pages.sale.listsales')->with('sales', $sales)->with('saleproducts', $saleproducts);
        }
    }

    // detalle de ventas
    public function getSaleDetail($id){
        $sale = Sale::find($id);

        $saleproducts = SaleProduct::where('saleId', $id)->get();

        return view('pages.sale.saledetails')->with('id', $id)->with('saleproducts', $saleproducts)->with('sale', $sale);
    }

    // obtener PDF del detalle de venta
    public function getPDF($id){
        $pdf = resolve('dompdf.wrapper');

        //$pdf->loadHTML('<h1>Test</h1>');

        
        $saleproducts = SaleProduct::where('saleId', $id)->get();

        $sale = Sale::find($id);

        $pdf = \PDF::loadView('pages.sale.newpdf', compact('saleproducts', 'sale'));

        //return $pdf->download('pages.budget.newpdf.pdf');


        // $budgetproducts = BudgetProduct::where('budgetId', $id);
        

        // return $pdf->stream('pages.budget.newpdf.pdf',compact('budgetproducts'));


        return $pdf->stream('pages.sale.newpdf.pdf');
    }

    // imprimir
    public function getPrint(){
        return view('pages.sale.ticket');
    }

    // generar e imprimir ticket de compra
    public function getTicket1($id){
        $saleproducts = SaleProduct::where('saleId', $id)->get();
        $sales = Sale::find($id);

        return view('pages.sale.saleticket')->with('saleproducts', $saleproducts)->with('sales', $sales)->with('id', $id);

        return back();       
    }    

    public function getTicket($id){
        $saleproducts = SaleProduct::where('saleId', $id)->get();
        $sales = Sale::find($id);


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
        $printer->text("COMPROBANTE DE COMPRA" . "\n");
        $printer->setJustification(Printer::JUSTIFY_LEFT);
       
        // Datos de la venta
        $printer->text("Vendedora:" . " $sales->nameSeller " . "\n");
        $printer->text("Cliente:" . " $sales->nameBuyer " . "\n");
        $printer->text("Nro de compra:" . " $sales->id " . "\n");
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
            if ($sales->typeSale == 0) {
                // venta CF
                foreach ($saleproducts as $saleproduct) {
                    $printer->text("$saleproduct->cantProduct   $saleproduct->name  $saleproduct->priceProductSale  $saleproduct->subtotal \n");
                }
            } else {
                // venta CC
                foreach ($saleproducts as $saleproduct) {
                    $printer->text("$saleproduct->cantProduct   $saleproduct->name  $saleproduct->priceProductTrust  $saleproduct->subtotal \n");
                }
            }
            
        /*
            Terminamos de imprimir
            los productos, ahora va el total
        */
        $printer->text("-----------------------------"."\n");
        $printer->setJustification(Printer::JUSTIFY_RIGHT);
        $printer->text("TOTAL: $ $sales->totalPrice\n");
        // $printer->text("IVA: $16.00\n");
        // $printer->text("TOTAL: $116.00\n");


        /*
            Podemos poner también un pie de página
        */
        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->text("Muchas gracias por su compra\n");



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
