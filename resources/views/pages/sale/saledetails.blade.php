@extends('pages.master')

@section('title', 'Detalles de venta')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="" class="nav-link"><i class="fas fa-info-circle"></i> Detalle de venta</a>
    </li>  
@endsection

@section('content')

    <div class="row">
        <div id="liveAlertPlaceholder"></div>
        <div class="col-md-12">
            <div class="container-fluid">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-info-circle"></i></i> Detalle de venta - Venta N: {{$id}}</h2>
                    </div>       
            
                   {{-- AGREGAR PRODUCTO AL PRESUPUESTO --}}
                   <div class="inside">

                        {{-- <div class="btn-add">
                            <a href="/budget/{{$id}}/addnewbudgetproduct" class="btn btn-primary">Agregar producto</a>
                        </div> --}}

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
                                        @if ($sale->typeSale == 0)
                                            @foreach ($saleproducts as $saleproduct)
                                            <tr>
                                                <td>{{ $saleproduct->cantProduct }}</td>                                                
                                                <td>{{ $saleproduct->name }}</td>
                                                <td>{{ $saleproduct->priceProductSale }}</td>
                                                <td>{{ $saleproduct->subtotal }}</td>
                                                {{-- <td></td> --}}
                                            </tr>
                                            @endforeach
                                        @else
                                            @foreach ($saleproducts as $saleproduct)
                                            <tr>
                                                <td>{{ $saleproduct->cantProduct }}</td>                                                
                                                <td>{{ $saleproduct->name }}</td>
                                                <td>{{ $saleproduct->priceProductTrust }}</td>
                                                <td>{{ $saleproduct->subtotal }}</td>
                                                {{-- <td></td> --}}
                                            </tr>
                                            @endforeach
                                        @endif
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

                            {{-- <form action="{{ url('/budget.addnewbudget') }}" id="formpricebudget" method="POST">
                                @csrf
                                <input type="hidden" id="totalBudgetInput" name="totalBudgetInput" value="">
                                <input type="hidden" id="idInput" name="idInput" value="{{$id}}">
                                <button class="btn btn-success">Guardar</button>
                            </form> --}}

                            <a href="/sale/{{$sale->id}}/getpdf" target="_blank" class="btn btn-danger delete" data-toggle="tooltip" data-placement="top" title="Generar PDF"><i class="far fa-file-pdf"></i> Generar PDF</a>

                            
                   </div>

                </div>
            </div>
        </div>
    </div>

         

        <!-- Modal para nuevo producto y modificar producto-->
        

@endsection
{{-- <a href="{{ url('/budget.getpdf') }}" target="_blank">Imprimir</a>    --}}

