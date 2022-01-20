@extends('pages.master')

@section('title', 'Lista de presupuestos')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="" class="nav-link"><i class="fas fa-list-ol"></i> Lista de presupuestos</a>
    </li>  
@endsection

@section('content')
<div class="container-fluid">
    <div class="panel shadow">
        <div class="header">
            <h2 class="title"><i class="fas fa-list-ol"></i> Lista de presupuestos</h2>
        </div>       

        <div class="inside descriptionname">
            <table class="table responsive table-striped table-dark descriptionname table-bordered border-white display" style="width:100%">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Cliente</th>
                        <th>Vendedor</th>
                        <th>Fecha de emisión</th>
                        <th>Precio total</th>
                        <th></th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach ($budgets as $budget)
                        <tr>
                            <td>{{ $budget->id }}</td>
                            <td>{{ $budget->nameClient }}</td>
                            <td>{{ $budget->nameSeller }}</td>
                            <td>{{ date('d-m-Y', strtotime($budget->date)) }}</td>
                            <td>{{ $budget->totalPrice }}</td>
                            <td>
                                {{-- <a href="/budget/{{$budget->id}}/budgetdetail" class="btn btn-primary  btn-list-edit" data-toggle="tooltip" data-placement="top" title="Detalle">
                                    <i class="fas fa-info-circle"></i>
                                </a> --}}

                                <button type="button" class="btn btn-primary  btn-list-edit" data-bs-toggle="modal" data-bs-target="#exampleModal{{$budget->id}}" data-toggle="tooltip" data-placement="top" title="Detalle">
                                    <i class="fas fa-info-circle"></i>
                                </button>

                                <a href="/budget/{{$budget->id}}/getticketbudget" class="btn btn-success btn-list-success" data-toggle="tooltip" data-placement="top" title="Generar ticket" >
                                    <i class="fas fa-file-invoice-dollar"></i>
                                </a>
                                
                                <a href="/budget/{{$budget->id}}/getpdf" target="_blank" class="btn btn-danger btn-list-delete" data-toggle="tooltip" data-placement="top" title="Generar PDF">
                                    <i class="far fa-file-pdf"></i>
                                </a>
                                {{-- <a href="/budget/{{$budget->id}}/getpdf" target="_blank"><i class="far fa-file-pdf"></i> Generar PDF</a> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    
                </tfoot>
            </table>
           
        </div>
    </div>
</div>


<!-- Modal detalle del presupuesto-->
@foreach ($budgets as $budget)
    <div class="modal fade" id="exampleModal{{$budget->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title descriptionname" id="exampleModalLabel">Detalles del presupuesto</h5>
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
                            @foreach ($budgetproducts as $budgetproduct)
                                @if ($budgetproduct->budgetId == $budget->id)
                                    <tr>
                                        <td>{{ $budgetproduct->cantProduct }}</td>
                                        <td>{{ $budgetproduct->name }}</td>
                                        <td>{{ $budgetproduct->priceProduct }}</td>
                                        <td>{{ $budgetproduct->subtotal }}</td>
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
                                <th><input id="totalBudget" name="totalBudget" type="decimal" value="{{ $budget->totalPrice }}" readonly></th>
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