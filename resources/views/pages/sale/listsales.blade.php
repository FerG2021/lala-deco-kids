@extends('pages.master')

@section('title', 'Lista de ventas')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="/sale/listsales" class="nav-link"><i class="fas fa-list-ol"></i> Lista de ventas</a>
    </li>  
@endsection

@section('content')
<div class="container-fluid">
    <div class="panel shadow">
        <div class="header">
            <h2 class="title"><i class="fas fa-list-ol"></i> Lista de ventas</h2>
        </div>  
        
        {{-- <div class="btn-select mtop10">
            <a href="/sale/listsales" class="btn btn-primary">Todas las ventas</a>
            <a href="/sale/listsalescf" class="btn btn-primary">Consumidor final</a>
            <a href="/sale/listsalesp" class="btn btn-primary">Personas</a>
            <a href="/sale/listsalesfc" class="btn btn-primary">Firma comercial</a>
        </div> --}}

        <div class="filter-date mtop10">
            <form action="/sale/filterdate" method="post">
            @csrf
                <div class="row descriptionname">
                    <div class="col-md-2">
                    </div>            
                    <div class="col-md-4">
                        <label for="dateinit">Fecha de inicio</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-calendar-alt"></i></span>
                            <input type="date" name="dateinit" name="dateinit" class="form-control" >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="datefinish">Fecha de fin</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-calendar-alt"></i></span>
                            <input type="date" name="datefinish" id="datefinish" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-2">   
                        <label for="datefinish"></label>                
                        <div class="input-group">
                            <button class="btn btn-primary edit">Filtrar</button>
                            <a href="/sale/listsales" class="btn btn-danger delete">Limpiar</a>  
                        </div>                                         
                    </div>            
                </div>
            </form>
        </div>

        <div class="inside descriptionname">
            <table class="table responsive table-striped table-dark descriptionname table-bordered border-white display" style="width:100%">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Cliente</th>
                        <th>Vendedor</th>
                        <th>Precio total</th>
                        <th>Fecha</th>
                        <th></th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sales as $sale)
                        <tr>
                            <td>{{ $sale->id }}</td>
                            <td>{{ $sale->nameBuyer }}</td>
                            <td>{{ $sale->nameSeller }}</td>
                            <td>{{ $sale->totalPrice }}</td>
                            <td>{{ date('d-m-Y', strtotime($sale->dateSale))}}</td>                            
                            <td>
                                {{-- <a href="/sale/{{$sale->id}}/saledetail" class="btn btn-primary btn-list-edit" data-toggle="tooltip" data-placement="top" title="Detalle"><i class="fas fa-info-circle"></i></a> --}}

                                <button type="button" class="btn btn-primary btn-list-edit" data-bs-toggle="modal" data-bs-target="#exampleModal{{$sale->id}}" data-toggle="tooltip" data-placement="top" title="Detalle">
                                    <i class="fas fa-info-circle"></i>
                                </button>
                                
                                <a href="/sale/{{$sale->id}}/getticket" class="btn btn-success btn-list-success" data-toggle="tooltip" data-placement="top" title="Generar ticket" >
                                    <i class="fas fa-file-invoice-dollar"></i>
                                </a>
                                
                                <a href="/sale/{{$sale->id}}/getpdf" target="_blank" class="btn btn-danger btn-list-delete" data-toggle="tooltip" data-placement="top" title="Generar boleta">
                                    <i class="far fa-file-pdf"></i>
                                </a>                                
                                {{-- <a href="/budget/{{$budget->id}}/getpdf" target="_blank"><i class="far fa-file-pdf"></i> Generar PDF</a> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th></th>
                        <th><input type="hidden" id="totalBudget3" name="totalBudget3" type="decimal" value="" readonly></th>
                        <th id="total">TOTAL:</th>
                        <th><button id="btninput" name="btninput"></button></th>
                        <th></th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
            <input type="hidden" id="totalBudgetInput3" name="totalBudgetInput3" value="">
            {{-- <input type="hidden" id="idInput" name="idInput" value="{{$id}}"> --}}
        </div>
    </div>
</div>

<!-- Modal para el detalle de la venta-->
@foreach ($sales as $sale)
    <div class="modal fade" id="exampleModal{{$sale->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title descriptionname" id="exampleModalLabel">Detalle de la venta</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body descriptionname">
                
                <div class="row">
                    {{-- Nro de compra --}}
                    <div class="col-md-3">
                        <label for="salenumber">Venta nro:</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-money-check-alt"></i></span>
                            <input type="number" class="form-control" id="salenumber" name="salenumber" value="{{$sale->id}}" readonly>
                        </div>
                    </div>
                    {{-- Nombre del cliente --}}
                    <div class="col-md-5">
                        <label for="client">Cliente:</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-money-check-alt"></i></span>
                            <input type="text" class="form-control" id="client" name="client" value="{{$sale->nameBuyer}}" readonly>
                        </div>
                    </div>
                </div>
                
                <div class="table mtop16 descriptionname">
                            
                    <table class="table responsive table-striped table-dark descriptionname table-bordered border-white display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Cantidad</th>                                            
                                <th>Descripción</th>
                                <th>Precio</th>
                                <th>Subtotal</th>
                                {{-- <th></th> --}}
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($saleproducts as $saleproduct)
                                @if ($saleproduct->saleId == $sale->id)
                                    @if ($sale->typeSale == 0)
                                        <tr>
                                            <td>{{ $saleproduct->cantProduct }}</td>                                                
                                            <td>{{ $saleproduct->name }}</td>
                                            <td>{{ $saleproduct->priceProductSale }}</td>
                                            <td>{{ $saleproduct->subtotal }}</td>
                                            {{-- <td></td> --}}                                    
                                        </tr>
                                    @else
                                        <tr>
                                            <td>{{ $saleproduct->cantProduct }}</td>                                                
                                            <td>{{ $saleproduct->name }}</td>
                                            <td>{{ $saleproduct->priceProductTrust }}</td>
                                            <td>{{ $saleproduct->subtotal }}</td>
                                            {{-- <td></td> --}}
                                        </tr>
                                    @endif                              
                                @else
                                    
                                @endif
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>                                            
                                <th></th>
                                <th>TOTAL:</th>            
                                <th><input id="totalSale" name="totalSale" type="decimal" value="{{ $sale->totalPrice }}" readonly></th>
                                {{-- <th></th> --}}
                            </tr>
                        </tfoot>
                    </table>
                </div> 

            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-danger delete" data-bs-dismiss="modal">Cerrar</button>
            {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
            </div>
        </div>
        </div>
    </div>
@endforeach
@endsection