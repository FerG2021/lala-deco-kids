@extends('pages.master')

@section('title', 'Detalle nuevo presupuesto')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/budget.newbudget') }}" class="nav-link"><i class="fas fa-plus-circle"></i> Nuevo presupuesto</a>
    </li>  
@endsection

@section('content')

    <div class="row">
        <div id="liveAlertPlaceholder"></div>
        <div class="col-md-12">
            <div class="container-fluid">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-plus-circle"></i> Nuevo presupuesto - Presupuesto N: {{$id}}</h2>
                    </div>       
            
                   {{-- AGREGAR PRODUCTO AL PRESUPUESTO --}}
                   <div class="inside">

                        {{-- <div class="btn-add">
                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">                                    
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                    Agregar producto
                                </button>               
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    Consultar producto
                                </button>    
                            </div>
                        </div>                         --}}

                        <div class="row searchinput">
                            {{-- id de la venta --}}
                            <input type="hidden" id="idsale" name="idsale" value="{{ $id }}">
                            {{-- Codigo de barras --}}
                            <div class="col-md-6">
                                <label for="barcodeproductsearch" class="descriptionname">Codigo de barras</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-barcode"></i></span>
                                    <select name="barcodeproductsearch" id="barcodeproductsearch" class="form-select" onchange="selectProductSaleBarCode(this);" class="gui-input" autofocus>
                                        <option selected>Ingrese codigo de barra</option>                                    
                                        @foreach ($products as $product)
                                            <option value="{{$product->nameProduct}}" data-id="{{$product->id}}" data-pricesale="{{$product->priceSaleProduct}}" data-barcode="{{$product->codeProduct}}" data-name="{{$product->nameProduct}}" data-stock="{{$product->cantStockProduct}}"> {{ $product->codeProduct }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            {{-- Nombre del producto --}}
                            <div class="col-md-6">
                                <label for="nameproductsearch" class="descriptionname">Nombre del producto</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    <select name="nameproductsearch" id="nameproductsearch" class="form-select" onchange="selectProductSale(this);">
                                        <option selected>Seleccione un producto</option>                                    
                                        @foreach ($products as $product)
                                            <option value="{{$product->nameProduct}}" data-id="{{$product->id}}" data-pricesale="{{$product->priceSaleProduct}}" data-barcode="{{$product->codeProduct}}" data-name="{{$product->nameProduct}}" data-stock="{{$product->cantStockProduct}}"> {{ $product->nameProduct }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" name="idproductsearch" id="idproductsearch" value="">                        
                        </div>
    
                        {{-- Datos del producto a vender --}}
                        <form action="/budget/{{$id}}/addnewbudgetproduct" method="post">
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
                                    <label for="pricesaleproduct" class="descriptionname">$ de venta</label>
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
                                        <button class="btn btn-primary">Agregar</button>
                                    </div>
                                </div>    
                            </div>
                        </form>

                        <div class="table mtop16 descriptionname">
                            
                                <table class="table responsive table-striped table-dark descriptionname table-bordered border-white display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Cantidad</th>
                                            <th>Descripción</th>
                                            <th>Precio</th>
                                            <th>Subtotal</th>
                                            <th></th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($budgetproducts as $budgetproduct)
                                            <tr>
                                                <td>{{ $budgetproduct->cantProduct }}</td>
                                                <td>{{ $budgetproduct->name }}</td>
                                                <td>{{ $budgetproduct->priceProduct }}</td>
                                                <td>{{ $budgetproduct->subtotal }}</td>
                                                <td>
                                                    <a href="/budget/{{$budgetproduct->id}}/deletebudgetproduct" class="btn btn-danger btn-list-delete" data-toggle="tooltip" data-placement="top" title="Quitar"><i class="fas fa-trash-alt"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th>TOTAL:</th>
                                            <th><input id="totalBudget3" name="totalBudget3" type="decimal" value="" readonly></th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                </table>
                        </div>

                            <form action="/budget/addnewbudgetconfirm"  method="POST">
                            @csrf
                                <input type="hidden" id="totalBudgetInput3" name="totalBudgetInput3" value="">
                                <input type="hidden" id="idInput" name="idInput" value="{{$id}}">
                                <div class="btn">
                                    <button class="btn btn-success success">Guardar presupuesto</button>                                
                            </form>
                                <a href="/budget/{{$id}}/cancelnewbudget" class="btn btn-danger delete">Cancelar presupuesto</a>
                                </div>
                                

                            
                   </div>

                </div>
            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title descriptionname" id="exampleModalLabel"><i class="fas fa-search"></i> Consultar producto</h5>
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
                                                <td class="descriptionname">Descripción</td>
                                                <td class="descriptionname">Stock</td>
                                                <td class="descriptionname">Precio</td>                               
                                            </tr>
                                        </thead>
                                        <tbody>                                
                                            @foreach ($products as $p)
                                                <tr>
                                                    
                                                    <td class="descriptionname" id="name">{{ $p->name }}</td>
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
            </div>
            </div>
        </div>
    </div>
        {{-- <div class="col-md-6">
            <div class="container-fluid">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-search"></i> Consultar producto</h2>
                    </div>           
                    
                    <div class="inside-consult mtop16">
                        <table id="" class="table responsive table-striped table-dark descriptionname table-bordered border-white display mtop16" style="width:100%">
                            <thead>
                                <tr>
                                    <td class="descriptionname">Descripción</td>
                                    <td class="descriptionname">Stock</td>
                                    <td class="descriptionname">Precio</td>                               
                                </tr>
                            </thead>
                            <tbody>                                
                                @foreach ($products as $p)
                                    <tr>
                                        
                                        <td class="descriptionname" id="name">{{ $p->name }}</td>
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
        </div>  --}}

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content descriptionname">
            <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Agregar producto al presupuesto</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ url('/budget.addnewbudgetproduct') }}" id="formaddproductsbudget" method="POST">
                    @csrf
                    {{-- Nombre del producto --}}
                    <div class="row">
                        <div class="col-md-12">
                            <label for="nameSelectForm" class="descriptionname">Nombre del producto</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-box"></i></span>
                                <select name="nameSelectForm" id="nameSelectForm" class="form-control" onchange="selectProduct(this);">
                                    <option selected>Seleccione un producto</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->name }}" data-pricesale="{{ $product->pricesale }}">{{ $product->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mtop16">
                        <div class="row">
                            {{-- Precio de venta --}}
                            <div class="col-md-6">
                                <label for="pricesaleForm" class="descriptionname">Precio</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-dollar-sign"></i></span>
                                    <input type="number" id="pricesaleForm" name="pricesaleForm" class="form-control" value="" readonly>
                                </div>  
                            </div>
                            {{-- Cantidad --}}
                            <div class="col-md-6">
                                <label for="cantBudgetForm" class="descriptionname">Cantidad</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-shopping-cart"></i></span>
                                    <input type="number" id="cantBudgetForm" name="cantBudgetForm" class="form-control" value="">
                                </div>
                                
                            </div>
                            {{-- ID de presupuesto --}}
                            <div>
                                <input type="hidden" id="idBudget" name="idBudget" value="{{$id}}">
                            </div>
                        </div>
                    </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-success">Añadir</button>
            </div>
                </form>
        </div>
        </div>
    </div>
        

@endsection
{{-- <a href="{{ url('/budget.getpdf') }}" target="_blank">Imprimir</a>    --}}

