@extends('pages.master')

@section('title', 'Detalles de CC')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="" class="nav-link"><i class="fas fa-list-ol"></i> Detalle de cuenta corriente</a>
    </li>  
@endsection

@section('content')
<div class="container-fluid">
    <div class="panel shadow">
        <div class="header">
            <h2 class="title"><i class="fas fa-list-ol"></i> Detalle de cuenta corriente</h2>
        </div>  
        
        {{-- <div class="btn-select mtop10">
            <a href="/sale/listsales" class="btn btn-primary">Todas las ventas</a>
            <a href="/sale/listsalescf" class="btn btn-primary">Consumidor final</a>
            <a href="/sale/listsalesp" class="btn btn-primary">Personas</a>
            <a href="/sale/listsalesfc" class="btn btn-primary">Firma comercial</a>
        </div> --}}       

        
        <div class="button-back">
            <a href="/currentaccount/listcurrentaccount" class="btn btn-primary edit">Atrás</a>
        </div>
           

        <div class="inside descriptionname">
            <table class="table responsive table-striped table-dark descriptionname table-bordered border-white display" style="width:100%">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Pago</th>
                        <th>Saldo adeudado</th>                        
                        <th></th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cadetails as $cadetail)
                        <tr>
                            <td>{{ date('d-m-Y', strtotime($cadetail->date)) }}</td>
                            <td>{{ $cadetail->pay }}</td>
                            <td>{{ $cadetail->sale }}</td>
                            @if ($cadetail->typemovement == 0)
                                <td>
                                    <a href="/currentaccount/{{ $cadetail->idsale }}/detailsale" class="btn btn-primary btn-list-edit" data-toggle="tooltip" data-placement="top" title="Detalles"><i class="fas fa-info-circle"></i></a>                                    
                                
                                    {{-- <button type="button" class="btn btn-primary btn-list-edit" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $cadetail->idsale }}" data-toggle="tooltip" data-placement="top" title="Detalles de la compra">
                                        <i class="fas fa-info-circle"></i>
                                    </button> --}}
                                      
                                </td>                               
                            @else
                                <td></td>
                            @endif                   
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    
                </tfoot>
            </table>
           
        </div>
    </div>
</div>


<!-- Modal detalles de las compras-->
@foreach ($cadetails as $cadetail)
    <div class="modal fade" id="exampleModal{{ $cadetail->idsale }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title descriptionname" id="exampleModalLabel">Detalles de la compra</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body descriptionname">
                
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
                                @if ($saleproduct->saleId == $cadetail->idsale)
                                    <tr>
                                        <td>{{ $saleproduct->cantProduct }}</td>                                                
                                        <td>{{ $saleproduct->name }}</td>
                                        <td>{{ $saleproduct->priceProductTrust }}</td>
                                        <td>{{ $saleproduct->subtotal }}</td>
                                        {{-- <td></td> --}}
                                    </tr>
                                @else
                                    
                                @endif
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>                                            
                                <th></th>
                                <th>TOTAL:</th>            
                                <th><input id="totalBudget3" name="totalBudget3" type="decimal" value="" readonly></th>
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