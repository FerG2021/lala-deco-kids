<?php

namespace App\Http\Controllers;

use App\Http\Models\Product;
use App\Http\Models\BarCodeProduct;
use Illuminate\Http\Request;
use Validator, Str, Config, Image;

use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

use Milon\Barcode\DNS1D;

class ProductController extends Controller
{
    // agregar nuevo producto
    public function getAddProduct(){
        return view('pages.product.addproduct');
    }

    public function postAddProduct(Request $request){
        $rules = [
            'codeproduct' => 'required|unique:App\Http\Models\Product,codeproduct',
            'nameproduct' => 'required', 
            'pricesaleproduct' => 'required', 
            'porcpricetrust' => 'required',
            'cantstockproduct' => 'required',
            'cantstockminproduct' => 'required'            
        ];

        $messages = [
            'codeproduct.required' => 'El código del producto es requerido',
            'codeproduct.unique' => 'Ya existe un producto registrado con el código ingresado',
            'nameproduct.required' => 'El nombre del producto es requerido',
            'pricesaleproduct.required' => 'El precio de venta es requerido',
            'porcpricetrust.required' => 'El porcentaje del precio de fiado es requerido',
            'cantstockproduct.required' => 'La cantidad actual de stock es requerida',
            'cantstockminproduct.required' => 'La cantidad minima de stock es requerida'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);        
        

        if ($validator->fails()) {
            return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'alert alert-danger');
        } else {
            $product = new Product();

            $product->codeProduct =  $request->get('codeproduct');
            $product->nameProduct = $request->get('nameproduct');
            $product->priceSaleProduct = $request->get('pricesaleproduct');
            $product->porcPriceTrustProduct = $request->get('porcpricetrust');
            $porc = $request->get('porcpricetrust') / 100;
            $product->priceTrustProduct = ($request->get('pricesaleproduct') * $porc) + $request->get('pricesaleproduct');
            $product->cantStockProduct = $request->get('cantstockproduct');
            $product->cantStockMinProduct = $request->get('cantstockminproduct');

            if ($product->save()) {
                return back()->with('message', 'Producto añadido con éxito')->with('typealert', 'alert alert-success');
            } else {
                # code...
            }
        }
    }

    // productos en stock
    public function getProductsInStock(){
        $products = Product::all();

        return view('pages.product.productsinstock')->with('products', $products);
    }

    // editar producto
    public function getEditProduct($id){
        $product = Product::find($id);

        return view('pages.product.editproduct')->with('product', $product)->with('id', $id);
    }

    public function postEditProduct(Request $request, $id){
        $rules = [
            'codeproduct' => 'required',
            'nameproduct' => 'required', 
            'pricesaleproduct' => 'required', 
            'porcpricetrust' => 'required',
            'cantstockproduct' => 'required',
            'cantstockminproduct' => 'required'            
        ];

        $messages = [
            'codeproduct.required' => 'El código del producto es requerido',            
            'nameproduct.required' => 'El nombre del producto es requerido',
            'pricesaleproduct.required' => 'El precio de venta es requerido',
            'porcpricetrust.required' => 'El porcentaje del precio de fiado es requerido',
            'cantstockproduct.required' => 'La cantidad actual de stock es requerida',
            'cantstockminproduct.required' => 'La cantidad minima de stock es requerida'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);       

        if ($validator->fails()) {
            return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'alert alert-danger');
        } else {
            $product = Product::find($id);

            $product->codeProduct =  $request->get('codeproduct');
            $product->nameProduct = $request->get('nameproduct');
            $product->priceSaleProduct = $request->get('pricesaleproduct');
            $product->porcPriceTrustProduct = $request->get('porcpricetrust');
            $porc = $request->get('porcpricetrust') / 100;
            $product->priceTrustProduct = ($request->get('pricesaleproduct') * $porc) + $request->get('pricesaleproduct');
            $product->cantStockProduct = $request->get('cantstockproduct');
            $product->cantStockMinProduct = $request->get('cantstockminproduct');

            if ($product->save()) {
                return redirect('/product/productsinstock')->with('message', 'Producto actualizado con éxito')->with('typealert', 'alert alert-success');
            } else {
                # code...
            }
        }
    }

    // eliminar producto
    public function getDeleteProduct($id){
        $product = Product::find($id);

        $product->delete();

        return back()->with('message', 'Producto eliminado con éxito')->with('typealert', 'alert alert-success');
    }

    // productos en stock minimo
    public function getProductsInMinStock(){
        $products = Product::whereColumn('cantStockMinProduct', '>=', 'cantStockProduct')->get();

        return view('pages.product.productsinminstock')->with('products', $products);
    }

    // generador de código de barras
    public function getGenerateBarCode(){
        return view('pages.product.generatebarcode');
    }

    public function postGenerateBarCode(Request $request){
        $rules = [             
            'codeproduct' => 'required|unique:App\Http\Models\BarCodeProduct,barcodeBarCodeProduct', 
            'nameproduct' => 'required'           
        ];

        $messages = [            
            'codeproduct.required' => 'El código del producto es requerido',   
            'codeproduct.unique' => 'Ya se encuentra generado el código de barras',   
            'nameproduct.required' => 'El nombre del producto es requerido'                  
        ];

        $validator = Validator::make($request->all(), $rules, $messages);  

        if ($validator->fails()) {
            return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'alert alert-danger');
        } else {   

            // agrego el nuevo producto a la tabla barcodeproduct
            $barcodeproduct = new BarCodeProduct();

            $barcodeproduct->barcodeBarCodeProduct = $request->get('codeproduct');
            $barcodeproduct->nameBarCodeProduct = $request->get('nameproduct');

            $barcodeproduct->save();

            
            // $barcodes = $request->get('codeproduct');
            // $i = 12;
            // $pdf = \PDF::loadView('pages.product.newbarcodepdf', compact('barcodes', 'i'));            
            // return $pdf->stream('pages.product.newbarcodepdf.pdf');

            return redirect('/product/listbarcode')->with('message', 'Código de barra generado con éxito')->with('typealert', 'alert alert-success');
        }
    }

    // lista de códigos de barras
    public function getListBarCode(){
        $productbarcodes = BarCodeProduct::orderBy('id', 'desc')->get();

        return view('pages.product.listbarcode')->with('productbarcodes', $productbarcodes);
    }

    // detalle de código de barras
    public function getDetailBarCode($id){
        $barcodeproduct = BarCodeProduct::find($id);
        $barcodes = $barcodeproduct->barcodeBarCodeProduct;
        $i = 12;
        $pdf = \PDF::loadView('pages.product.newbarcodepdf', compact('barcodes', 'i'));            
        return $pdf->stream('pages.product.newbarcodepdf.pdf');
    }

    // generar ticket de codigo de barras
    public function getGenerateTicketBarCode($id){
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
        $printer->text("Direccion: Moreno \n");
        $printer->text("Tel: 123456789 \n");
        #La fecha también
        date_default_timezone_set("America/Argentina/Buenos_Aires");
        $printer->text(date("d-m-Y H:i:s") . "\n");
        $printer->text("-----------------------------" . "\n");
        $printer->text("COMPROBANTE DE COMPRA" . "\n");
        $printer->setJustification(Printer::JUSTIFY_LEFT);
       
        // Datos de la venta
        // $printer->text("Vendedora:" . " $sales->nameSeller " . "\n");
        // $printer->text("Cliente:" . " $sales->nameBuyer " . "\n");
        // $printer->text("Nro de compra:" . " $sales->id " . "\n");
        // $printer->text("-----------------------------" . "\n");


        $printer->text("CANT  DESCRIPCION    P.U   IMP.\n");
        $printer->text("-----------------------------"."\n");

        $barcode = DNS1D::getBarcodeHTML($barcodes, "C128");

        $printer->text(" $barcode ");
        
        
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
            // if ($sales->typeSale == 0) {
            //     // venta CF
            //     foreach ($saleproducts as $saleproduct) {
            //         $printer->text("$saleproduct->cantProduct   $saleproduct->name  $saleproduct->priceProductSale  $saleproduct->subtotal \n");
            //     }
            // } else {
            //     // venta CC
            //     foreach ($saleproducts as $saleproduct) {
            //         $printer->text("$saleproduct->cantProduct   $saleproduct->name  $saleproduct->priceProductTrust  $saleproduct->subtotal \n");
            //     }
            // }
            
        /*
            Terminamos de imprimir
            los productos, ahora va el total
        */
        $printer->text("-----------------------------"."\n");
        $printer->setJustification(Printer::JUSTIFY_RIGHT);
        // $printer->text("TOTAL: $ $sales->totalPrice\n");
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