<?php

namespace App\Http\Controllers;

use App\Http\Models\CurrentAccount;
use App\Http\Models\CurrentAccountDetail;
use App\Http\Models\Sale;
use App\Http\Models\SaleProduct;
use Illuminate\Http\Request;
use Validator, Str, Config, Image;
use Carbon\Carbon;

use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

class CurrentAccountController extends Controller
{
    public function getListCA(){
        // $currentaccounts = CurrentAccount::all();
        
        // return view('pages.currentaccount.listscurrentaccount')->with('currentaccounts', $currentaccounts);
        // 

        $cadetails = CurrentAccountDetail::all();

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


        return view('pages.currentaccount.listscurrentaccount')->with('clientcas', $clientcas)->with('now', $now)->with('deudors', $deudors)->with('cadetails', $cadetails);
    }

    // cobrar saldo de cuenta corriente
    public function postPayCA(Request $request, $id){
        $rules = [
            'mountca' => 'required',
            'totalpay' => 'required',                     
        ];

        $messages = [
            'mountca.required' => 'El monto adeudado es requerido',            
            'totalpay.required' => 'El monto entregado por el cliente es requerido'            
        ];

        $validator = Validator::make($request->all(), $rules, $messages);  

        if ($validator->fails()) {
            return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'alert alert-danger');
        } else {
            $now = Carbon::now();
            // busco la cuenta del cliente
            $ca = CurrentAccount::find($id);

            if ($ca->balance >= $request->get('totalpay')) {
                // actualizo la cuenta corriente
                $ca->balance = $ca->balance - $request->get('totalpay');
                $ca->datelastaction = $now->format('Y-m-d');
                $ca->save();

                // agrego un detalle a la cuenta corriente
                $cadetail = new CurrentAccountDetail();

                $cadetail->idCurrentAccount = $ca->id;
                $cadetail->idClient = $request->get('idclient');
                $cadetail->idSale = 0;
                $cadetail->date = $now->format('Y-m-d');
                $cadetail->typemovement = 1;
                $cadetail->pay = $request->get('totalpay');
                $cadetail->sale = 0;

                if ($cadetail->save()) {
                    // actualizo deudors                    
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
                            
                        } else {
                            // actualizo el campo deudors en la tabla
                            $id = $clientca->id;
                            $clientdeudor = CurrentAccount::find($id);
                            $clientdeudor->deudors = 0;
                            $clientdeudor->save();
                        }            
                    }

                    return back()->with('message', 'Pago procesado con éxito')->with('typealert', 'alert alert-success');
                } else {
                    return back()->with('message', 'No se pudo procesar el pago')->with('typealert', 'alert alert-danger');
                }
                

            } else {
                return back()->with('message', 'El monto pagado por el cliente supera la cantidad adeudada')->with('typealert', 'alert alert-danger');
            }         

        }
    }

    // agregar intereses cuenta corriente
    public function postAddInterestsCA(Request $request, $id){
        $rules = [
            'mountca' => 'required',
            'interests' => 'required',                     
        ];

        $messages = [
            'mountca.required' => 'El monto adeudado es requerido',            
            'interests.required' => 'El porcentaje de interes es requerido'            
        ];

        $validator = Validator::make($request->all(), $rules, $messages);  

        if ($validator->fails()) {
            return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'alert alert-danger');
        } else {
            $now = Carbon::now();
            // busco la cuenta corriente
            $ca = CurrentAccount::find($id);

            // actualizo el saldo de la cuenta corriente
            $porc = $request->get('interests') / 100;
            $mounttoadd = $ca->balance * $porc;
            $ca->balance = $ca->balance + $mounttoadd;
            $ca->save();

            // agrego un detalle a la cuenta corriente
            $cadetail = new CurrentAccountDetail();

            $cadetail->idCurrentAccount = $ca->id;
            $cadetail->idClient = $request->get('idclient');
            $cadetail->idsale = 0;
            $cadetail->date = $now->format('Y-m-d');
            $cadetail->typemovement = 2;
            $cadetail->pay = 0;
            $cadetail->sale = $mounttoadd;

            if ($cadetail->save()) {
                return back()->with('message', 'Intereses agredados con exito')->with('typealert', 'alert alert-success');
            } else {
                return back()->with('message', 'Se ha producido un error')->with('typealert', 'alert alert-danger');
            }
            
        }
    }

    // detalle de cuenta corriente
    public function getDetailCA($id){
        $cadetails = CurrentAccountDetail::where('idCurrentAccount', $id)->get();
        $saleproducts = SaleProduct::all();

        return view('pages.currentaccount.detailca')->with('cadetails', $cadetails)->with('id', $id)->with('saleproducts', $saleproducts);
    }

    // detalle de cada venta guardada en la cuenta corriente
    public function getDetailSaleCA($id){
        $saleproducts = SaleProduct::where('saleId', $id)->get();

        return view('pages.currentaccount.detailsaleca')->with('saleproducts', $saleproducts);
    }

    // generar PDF con detalle de cuenta corriente
    public function getPFDetailCA($id){
        $pdf = resolve('dompdf.wrapper');   

        $ca = CurrentAccount::find($id);
        $cadetails = CurrentAccountDetail::where('idCurrentAccount', $id)->get();
        
        $pdf = \PDF::loadView('pages.currentaccount.newpdf', compact('ca', 'cadetails'));

        return $pdf->stream('pages.currentaccount.newpdf.pdf');
    }  
    
    // generar ticket con detalles de la cuenta corriente
    public function getTicketCA($id){
        $ca = CurrentAccount::find($id);
        $cadetails = CurrentAccountDetail::where('idCurrentAccount', $id)->get();

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
        $printer->text("Direccion: Moreno 163 \n");
        $printer->text("Tel: 3843-674065 \n");
        #La fecha también
        date_default_timezone_set("America/Argentina/Buenos_Aires");
        $printer->text(date("d-m-Y H:i:s") . "\n");
        $printer->text("-----------------------------" . "\n");
        $printer->text("COMPROBANTE DE CUENTA CORRIENTE" . "\n");
        $printer->setJustification(Printer::JUSTIFY_LEFT);
       
        // Datos de la venta
        // $printer->text("Vendedora:" . " $sales->nameSeller " . "\n");
        $printer->text("Cliente:" . " $ca->lastNameClient $ca->nameClient " . "\n");
        // $printer->text("Nro de compra:" . " $sales->id " . "\n");
        $printer->text("-----------------------------" . "\n");


        $printer->text("FECHA       PAGO        SALDO\n");
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
            foreach ($cadetails as $cadetail) {
                $date = date('d-m-Y', strtotime($cadetail->date));
                $printer->text("$date   $cadetail->pay      $cadetail->sale \n");
            }
            
        /*
            Terminamos de imprimir
            los productos, ahora va el total
        */
        $printer->text("-----------------------------"."\n");
        $printer->setJustification(Printer::JUSTIFY_RIGHT);
        $printer->text("SALDO ADEUDADO: $ $ca->balance\n");
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
