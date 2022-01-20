@extends('pages.master')

@section('title', 'Seleccionar el tipo de venta')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/product/productsinstock') }}" class="nav-link"><i class="fas fa-shopping-cart"></i> Tipo de venta</a>
    </li>  
@endsection

@section('content') <!--aqui se muestan el contenido propio de cada pagina-->
    
    {{-- verificar si hay productos con stock minimo --}}
    <div class="control-stock">
        <input type="hidden" value="{{ $stockmin = 0 }}">
        @foreach ($products as $product)
            @if ($product->cantStockMinProduct >= $product->cantStockProduct && $stockmin == 0)
                <input type="hidden" value="{{ $stockmin = 1 }}">
                <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
                    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header">
                            {{-- <img src="..." class="rounded me-2" alt="..."> --}}
                            <strong class="me-auto"><b><i class="fas fa-exclamation-triangle warning"></i> Notificacion de stock minimo</b></strong>
                            {{-- <small>11 mins ago</small> --}}
                            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body">
                            Hay productos que alcanzaron su stock minimo. Hacé click en el botón para más información
                            {{-- <button class="btn btn-warning">Ver productos</button> --}}
                            <a href="/product/productsinminstock" class="btn btn-warning">Ver productos</a>
                        </div> 
                    </div>
                </div>
            @else
                
            @endif
        @endforeach
    </div>

    <div class="container-fluid">
        <div class="panel shadow">
            <div class="header">
                <h2 class="title"><i class="fas fa-shopping-cart"></i> Tipo de venta</h2>
            </div>
           
            <div class="inside">
                <div class="typesale descriptionname">
                    <h3>Seleccione el tipo de venta</h3>                    
                    <div class="typesale-btn mtop16">
                        {{-- Formulario para consumidor final --}}
                        <form action="{{ url('sale/newsalecf') }}" method="post">
                        @csrf
                            {{-- Nombre del vendedor --}}
                            <input type="hidden" id="nameSeller" name="nameSeller" value="{{Auth::user()->name}} {{ Auth::user()->lastname }}" readonly>

                            {{-- Fecha actual --}}
                            <input type="hidden" id="dateSale" name="dateSale" value="{{ $now->format('Y-m-d') }}" readonly>

                            <button class="btn btn-typesale">Consumidor final <br> Efectivo</button>

                            <a href="{{ url('sale/newsaleca') }}" class="btn btn-typesale">Cuenta corriente <br> Tarjeta</a>
                        </form>               
                    </div>
                    <div class="consult-stock mtop16 typesale-btn">
                        <h4>Consultar precios</h4>
                        <button type="button" class="btn mtop16" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Consultar precios
                        </button>
                        {{-- <a href="/sale/print" type="button" class="btn btn-typesale">Imprimir</a>                         --}}
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
            <button type="button" class="btn-close descriptionname" data-bs-dismiss="modal" aria-label="Close"></button>
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