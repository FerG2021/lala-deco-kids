@extends('pages.master')

@section('title', 'Detalle nueva venta')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="" class="nav-link"><i class="fas fa-plus-circle"></i> Nueva venta (Consumidor final)</a>
    </li>  
@endsection

@section('content')

<div class="row">
    <div id="liveAlertPlaceholder"></div>
    <div class="col-md-12">
        <div class="container-fluid">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="fas fa-plus-circle"></i> Nueva venta (Consumidor final) - Venta N: {{$id}}</h2>
                </div>       
        
               {{-- AGREGAR PRODUCTO A LA VENTA --}}
               <div class="inside">

                {{-- <div class="btn-add">
                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                        {{-- Agregar producto
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalAddProduct">
                            Agregar producto
                        </button>
                        {{-- Consultar producto
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalConsultProduct">
                            Consultar producto
                        </button>    
                    </div>
                </div>        --}}

                <div class="client-detail">
                    <div class="col-md-6 descriptionname">                        
                        <label for="nameClient">Nombre del cliente</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                            <input type="text" name="nameClient" id="nameClient" class="form-control" readonly value="{{$client->lastNameClient}} {{$client->nameClient}}">
                        </div>                        
                    </div>
                </div>

                <div class="product-sale mtop10">
                    
                    <div class="row searchinput">
                        {{-- id de la venta --}}
                        <input type="hidden" id="idsale" name="idsale" value="{{ $id }}">
                        {{-- Codigo de barras --}}
                        <div class="col-md-5">
                            <label for="barcodeproductsearch" class="descriptionname">Codigo de barras</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-barcode"></i></span>
                                <select name="barcodeproductsearch" id="barcodeproductsearch" class="form-select" onchange="selectProductSaleBarCode(this);" class="gui-input" autofocus>
                                    <option selected disabled>Ingrese codigo de barras</option>                                    
                                    @foreach ($products as $product)
                                        <option value="{{$product->nameProduct}}" data-id="{{$product->id}}" data-pricesale="{{$product->priceTrustProduct}}" data-barcode="{{$product->codeProduct}}" data-name="{{$product->nameProduct}}" data-stock="{{$product->cantStockProduct}}"> {{ $product->codeProduct }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        {{-- Nombre del producto --}}
                        <div class="col-md-5">
                            <label for="nameproductsearch" class="descriptionname">Nombre del producto</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                <select name="nameproductsearch" id="nameproductsearch" class="form-select" onchange="selectProductSale(this);">
                                    <option selected disabled>Seleccione un producto</option>                                    
                                    @foreach ($products as $product)
                                        <option value="{{$product->nameProduct}}" data-id="{{$product->id}}" data-pricesale="{{$product->priceTrustProduct}}" data-barcode="{{$product->codeProduct}}" data-name="{{$product->nameProduct}}" data-stock="{{$product->cantStockProduct}}"> {{ $product->nameProduct }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">                            
                            <label for="" class="descriptionname"></label>
                            <div class="input-group consult-stock">
                                <button class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal">Consultar precios</button>
                            </div>
                        </div>
                        <input type="hidden" name="idproductsearch" id="idproductsearch" value="">                        
                    </div>

                    {{-- Datos del producto a vender --}}
                    <form action="/sale/{{$id}}/addnewsaleproductca" method="post">
                    @csrf
                        <div class="row mtop16">
                            {{-- Codigo del producto --}}
                            <div class="col-md-2">
                                <label for="barcodeproduct" class="descriptionname">Codigo de barras</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-barcode"></i></span>
                                    <input type="text" class="form-control" name="barcodeproduct" id="barcodeproduct" value="" readonly>
                                </div>
                            </div>
                            {{-- Nombre del producto --}}
                            <div class="col-md-3">
                                <label for="nameproduct" class="descriptionname">Nombre del producto</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    <input type="text" class="form-control" name="nameproduct" id="nameproduct" readonly>
                                </div>
                            </div>
                            {{-- Stock del producto --}}
                            <div class="col-md-2">
                                <label for="stockproduct" class="descriptionname">Stock</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-cubes"></i></span>
                                    <input type="number" class="form-control" name="stockproduct" id="stockproduct" readonly>
                                </div>
                            </div>
                            {{-- Precio de venta del producto --}}
                            <div class="col-md-2">
                                <label for="pricesaleproduct" class="descriptionname">$ de fiado</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-dollar-sign"></i></span>
                                    <input type="number" class="form-control" name="pricesaleproduct" id="pricesaleproduct" readonly>
                                </div>
                            </div>
                            {{-- Cantidad a vender del producto --}}
                            <div class="col-md-2">
                                <label for="cantsaleproduct" class="descriptionname">Cantidad</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-sort-numeric-down"></i></span>
                                    <input type="number" class="form-control" name="cantsaleproduct" id="cantsaleproduct" value="1">
                                </div>
                            </div>

                            <input type="hidden" id="idproduct" name="idproduct" value="">

                            {{-- Boton agregar --}}
                            <div class="col-md-1">
                                <label for="" class="descriptionname"></label>
                                <div class="input-group">
                                    <button class="btn btn-primary edit">Agregar</button>
                                </div>
                            </div>

                        </div>
                    </form>
                    
                </div>

                
    
                <div class="table mtop16 descriptionname">
                        
                            <table class="table responsive table-striped table-dark descriptionname table-bordered border-white display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Cantidad</th>                                        
                                        <th>Descripción</th>
                                        <th>Precio de venta</th>
                                        <th>Subtotal</th>
                                        <th></th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($saleproducts as $saleproduct)
                                        <tr>
                                            <td>{{ $saleproduct->cantProduct }}</td>                                           
                                            <td>{{ $saleproduct->name }}</td>
                                            <td>{{ $saleproduct->priceProductTrust }}</td>
                                            <td>{{ $saleproduct->subtotal }}</td>
                                            <td>
                                                <a href="/sale/{{$saleproduct->id}}/deletesaleproductca" class="btn btn-danger btn-list-delete" data-toggle="tooltip" data-placement="top" title="Quitar">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th></th>                                                                              
                                        <th><input id="totalBudget6" name="totalBudget6" type="hidden" value="" readonly></th>                                        
                                        <th>TOTAL:</th>
                                        <th><input id="totalBudget3" name="totalBudget3" type="decimal" value="" readonly></th>
                                        <th></th>    
                                    </tr>
                                </tfoot>
                            </table>
                    </div>

                        <form action="{{ url('/sale/addnewsaleconfirmca') }}" id="formpricebudget" method="POST">
                        @csrf
                            <input type="hidden" id="dateSale" name="dateSale" value="{{$sale->dateSale}}">
                            <input type="hidden" id="totalBudgetInput6" name="totalBudgetInput6" value="">
                            <input type="hidden" id="totalBudgetInput3" name="totalBudgetInput3" value="">
                            <input type="hidden" id="idSaleInput" name="idSaleInput" value="{{$id}}">                            
                            <input type="hidden" id="idClientInput" name="idClientInput" value="{{$client->id}}">
                            <input type="hidden" id="dniClient" name="dniClient" value="{{$client->dniClient}}">
                            <input type="hidden" id="nameClientInput" name="nameClientInput" value="{{$client->nameClient}}">
                            <input type="hidden" id="lastNameClientInput" name="lastNameClientInput" value="{{$client->lastNameClient}}">
                            
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="totalPayClient" class="descriptionname">Total pagado por el cliente</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                        <input type="decimal" id="totalPayClient" name="totalPayClient" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="btn">
                                <button class="btn btn-success success"></i> Guardar venta</button>
                        </form>
                                <a href="/sale/{{$id}}/cancelnewsaleca" class="btn btn-danger delete">Cancelar venta</a>    
                            </div>
                      
                </div>

            </div>
        </div>
    </div>


    <!-- Modal agregar producto a la venta-->
    <div class="modal fade" id="modalAddProduct" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title descriptionname" id="staticBackdropLabel">Agregar producto a la venta</h5>
                <button type="reset" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/sale/{{$id}}/addnewsaleproductcf" method="POST" id="modalAddProduct">
                @csrf
                    <div class="row">
                        {{-- ID de producto en tabla productos en stock --}}
                        <input type="hidden" id="idProduct" name="idProduct" value="">
                        {{-- Codigo del producto del producto --}}
                        <div class="col-md-6">
                            <label for="codeProduct" class="descriptionname">Coidgo del producto</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                <input type="text" class="form-control" name="codeProduct" id="codeProduct">
                            </div>
                        </div>       
                        {{-- Nombre del producto --}}
                        <div class="col-md-6">
                            <label for="nameProduct" class="descriptionname">Nombre del producto</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                <select name="nameProduct" id="nameProduct" class="form-select" onchange="selectProductSale(this);">
                                    <option selected>Seleccione un producto</option>
                                    @foreach ($products as $product)
                                        <option value="{{$product->nameProduct}}" data-id="{{$product->id}}" data-pricesale="{{$product->priceSaleProduct}}"> {{ $product->nameProduct }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>                   
                    </div>                    
                    <div class="row mtop16">
                        {{-- Precio de venta --}}
                        <div class="col-md-6">
                            <label for="pricesale" class="descriptionname">Precio de venta</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-dollar-sign"></i></span>
                                <input type="number" id="pricesale" name="pricesale" class="form-control" readonly>
                            </div>
                        </div>                        
                        {{-- Cantidad a vender --}}
                        <div class="col-md-6">
                            <label for="cant" class="descriptionname">Cantidad a vender</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-sort-numeric-up"></i></span>
                                <input type="number" id="cant" name="cant" class="form-control">
                            </div>
                        </div>                        
                        {{-- Porcentaje para la venta --}}
                        {{-- <div class="col-md-4">
                            <label for="porcsale" class="descriptionname">Porcentaje para venta</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-percentage"></i></span>
                                <input type="decimal" id="porcsale" name="porcsale" class="form-control">
                            </div>
                        </div> --}}
                        {{-- ID de venta --}}
                        <input type="hidden" id="buyId" name="buyId" class="form-control" value="{{$id}}">

                        {{-- tipo de venta --}}
                        <input type="hidden" id="tipesaleinput" name="tipesaleinput" value="">

                        
                    </div>
                
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-success">Añadir</button>
            </form>
            </div>
        </div>
        </div>
    </div>

    {{--  --}}
    {{-- Modal x2 Agregar producto a la venta --}}
    {{--  --}}
    {{-- Modal 1 --}}
    <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title descriptionname" id="exampleModalToggleLabel">Ingrese codigo o nombre del producto</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              
                <div class="row">
                    <form action="" method="post">
                        {{-- ID de producto en tabla productos en stock --}}
                        <input type="hidden" id="idProduct" name="idProduct" value="">
                        {{-- Codigo del producto del producto --}}
                        <div class="col-md-6">
                            <label for="codeProduct" class="descriptionname">Codigo del producto</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                <input type="text" class="form-control" name="codeProduct" id="codeProduct">
                            </div>
                        </div>       
                        {{-- Nombre del producto --}}
                        <div class="col-md-6">
                            <label for="nameProduct" class="descriptionname">Nombre del producto</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                <select name="nameProduct" id="nameProduct" class="form-select" onchange="selectProductSale(this);">
                                    <option selected>Seleccione un producto</option>
                                    @foreach ($products as $product)
                                        <option value="{{$product->nameProduct}}" data-id="{{$product->id}}" data-pricesale="{{$product->priceSaleProduct}}"> {{ $product->nameProduct }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>      
                                
                </div>              


            </div>
            <div class="modal-footer">
                        <button class="btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal">Open second modal</button>
                    </form> 
            </div>
          </div>
        </div>
    </div>

    {{-- Modal 2 --}}
    <div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalToggleLabel2">Modal 2</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            Hide this modal and show the first with the button below.
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Back to first</button>
        </div>
        </div>
    </div>
    </div>      
    
    <!-- Modal nuevo producto-->
    <div class="modal fade" id="modalAddNewProduct" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title descriptionname" id="staticBackdropLabel">Agregar nuevo producto</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{url('/buy/addnewproduct')}}" method="POST">
                @csrf    
                    <div class="row">
                        {{-- Código del producto --}}
                        <div class="col-md-6">
                            <label for="code" class="descriptionname">Código del producto</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-barcode"></i></span>
                                <input type="number" id="code" name="code" class="form-control">
                            </div>
                        </div>
                        {{-- Nombre del producto --}}
                        <div class="col-md-6">
                            <label for="name" class="descriptionname">Nombre del producto</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                <input type="text" id="name" name="name" class="form-control">
                            </div>
                        </div>
                    </div> 
                    <div class="mtop16">
                        <div class="row">  
                            <!--Tipo de venta-->  
                            <div class="col-md-2 mtop16">
                                <label for="tipesale" class="descriptionname">Tipo de venta</label> 
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-shopping-bag"></i></span>  
                                    <select name="tipesale" id="tipesale" class="form-select">
                                        <option value="0">Por unidad</option>
                                        <option value="1">Por bolsa</option>
                                    </select>
                                </div>                               
                            </div>   
                            <!--Precio de compra-->  
                            <div class="col-md-2 mtop16">
                                <label for="pricebuy" class="descriptionname">Precio de compra</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-tag"></i></span>
                                    <input type="decimal" id="pricebuy" name="pricebuy" class="form-control" value="">
                                </div>                       
                            </div>       
                            {{-- Porcentaje de precio de venta --}}
                            <div class="col-md-2 mtop16">
                                <label for="porcpricesale" class="descriptionname">Porcentaje para venta</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-percentage"></i></span>
                                    <input type="decimal" id="porcpricesale" name="porcpricesale" class="form-control" value="">
                                </div>                       
                            </div>
                            <!--Precio por kilo-->  
                             <div class="col-md-3 mtop16">
                                <label for="pricekg" class="descriptionname">Precio por kilo</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-tag"></i></span>
                                    <input type="decimal" id="pricekg" name="pricekg" class="form-control" value="">
                                </div>                       
                            </div>       
                            <!--Cantidad de kilos por bolsa-->  
                            <div class="col-md-3 mtop16">
                                <label for="kgbag" class="descriptionname">Cantidad de kilos por bolsa</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-tag"></i></span>
                                    <input type="number" id="kgbag" name="kgbag" class="form-control" value="">
                                </div>                       
                            </div>                    
                        </div>
                    </div>
     
                    <div class="mtop16">
                        <div class="row">
                            <!--Cantidad de stock-->  
                            {{-- <div class="col-md-3 mtop16">
                                <label for="stock" class="descriptionname">Cantidad de stock</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-boxes"></i></i></span>
                                    <input type="decimal" id="stock" name="stock" class="form-control" value="">
                                </div>                       
                            </div>   --}}
                            <!--Stock minimo-->  
                            <div class="col-md-6 mtop16">
                                <label for="stockmin" class="descriptionname">Cantidad de stock mínimo</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-exclamation-triangle"></i></span>
                                    <input type="decimal" id="stockmin" name="stockmin" class="form-control" value="">
                                </div>                       
                            </div>  
                            <!--Vencimiento del producto-->  
                            <div class="col-md-3 mtop16">
                                <label for="expiration" class="descriptionname">Vencimiento del producto</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-calendar"></i></span>                 
                                    <select name="expiration" id="expiration" class="form-select">
                                        <option value="0">No</option>
                                        <option value="1">Si</option>
                                    </select>
                                </div>
                            </div>  
                            <!--Fecha de vencimiento-->  
                            <div class="col-md-3 mtop16">
                                <label for="date" class="descriptionname">Fecha de vencimiento</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-calendar"></i></span>
                                    <input type="date" id="date" name="date" class="form-control" value="">
                                </div>                       
                            </div>                             
                        </div>
                    </div>
    
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-success">Guardar</button>
            </form>
            </div>
        </div>
        </div>
    </div>

    <!-- Modal consulta de producto-->
    <div class="modal fade" id="modalConsultProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title descriptionname" id="exampleModalLabel"> Consultar producto</h5>
            <button type="button" class="btn-close descriptionname" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="panel shadow">
                        {{-- <div class="header">
                            <h2 class="title"><i class="fas fa-search"></i> Consultar producto</h2>
                        </div>            --}}
                        
                        <div class="table mtop16 descriptionname">
                            <div class="inside-consult">
                                <table id="" class="table responsive table-striped table-dark descriptionname table-bordered border-white display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <td class="descriptionname">Código</td>
                                            <td class="descriptionname">Descripción</td>
                                            <td class="descriptionname">Stock</td>
                                            <td class="descriptionname">Precio de venta</td>                               
                                        </tr>
                                    </thead>
                                    <tbody>                                
                                        @foreach ($productconsults as $p)
                                            <tr>
                                                <td class="descriptionname" id="name">{{ $p->code }}</td>
                                                <td class="descriptionname" id="name">{{ $p->nameProduct }}</td>
                                                <td class="descriptionname" id="stock">{{ $p->stock }}</td>
                                                <td class="descriptionname" id="pricesale">{{ $p->pricesale }}</td>                                     
                                            </tr>
                                        @endforeach                                
                                    </tbody>
                                    <tfoot>                                 
                                    </tfoot>
                                </table>                                  
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>                
            </div>               
        </div>
        </div>
    </div>
</div>

<!-- Modal para la consulta de precios-->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header descriptionname">
            <h5 class="modal-title" id="exampleModalLabel">Precio de productos</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body descriptionname">
            <table class="table responsive table-striped table-dark descriptionname table-bordered border-white display" style="width:100%">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Código</th>
                        <th>$ venta</th>
                        <th>$ fiado</th>                        
                        {{-- <th></th> --}}
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productconsults as $productconsult)
                        <tr>
                            <td>{{ $productconsult->nameProduct }}</td>
                            <td>{{ $productconsult->codeProduct }}</td>
                            <td>{{ $productconsult->priceSaleProduct }}</td>
                            <td>{{ $productconsult->priceTrustProduct }}</td>
                            {{-- <td>{{ $sale->totalPrice }}</td>
                            <td>{{ date('d-m-Y', strtotime($sale->dateSale))}}</td>                            
                            <td>
                                <a href="/sale/{{$sale->id}}/saledetail" class="btn btn-primary btn-list-edit" data-toggle="tooltip" data-placement="top" title="Detalle"><i class="fas fa-info-circle"></i></a>
                                <a href="/sale/{{$sale->id}}/getpdf" target="_blank" class="btn btn-danger btn-list-delete" data-toggle="tooltip" data-placement="top" title="Generar PDF" >
                                    <i class="far fa-file-pdf"></i>
                                </a>
                            </td> --}}
                        </tr>
                    @endforeach
                </tbody>
                {{-- <tfoot>
                    <tr>
                        <th></th>
                        <th><input type="hidden" id="totalBudget3" name="totalBudget3" type="decimal" value="" readonly></th>
                        <th id="total">TOTAL:</th>
                        <th><button id="btninput" name="btninput"></button></th>
                        <th></th>
                        <th></th>
                    </tr>
                </tfoot> --}}
            </table>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger delete" data-bs-dismiss="modal">Cerrar</button>                
        </div>
    </div>
    </div>
</div>
        

@endsection
{{-- <a href="{{ url('/budget.getpdf') }}" target="_blank">Imprimir</a>    --}}

