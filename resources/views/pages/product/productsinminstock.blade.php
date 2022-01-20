@extends('pages.master')

@section('title', 'Productos en stock minimo')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/product/productsinstock') }}" class="nav-link"><i class="fas fa-exclamation-triangle"></i> Productos en stock minimo</a>
    </li>  
@endsection

@section('content') <!--aqui se muestan el contenido propio de cada pagina-->
    <!--panel que se va a utilizar para mostrar las diferentes secciones-->
    <div class="container-fluid">
        <div class="panel shadow">
            <div class="header">
                <h2 class="title"><i class="fas fa-exclamation-triangle"></i> Productos en stock minimo</h2>
            </div>
           
            <div class="inside">
                <div class="inside descriptionname">
                    <table id="" class="table responsive table-striped table-dark descriptionname table-bordered border-white display" style="width:100%">
                        <thead>
                            <tr>
                                <th class="descriptionname aling">Código</th>
                                <th class="descriptionname aling">Nombre</th>                                
                                <th class="descriptionname aling">Precio de venta</th>
                                <th class="descriptionname aling">Precio de fiado</th>                                
                                <th class="descriptionname aling">Cantidad de stock</th>
                                <th class="descriptionname aling">Cantidad minima de stock</th>                            
                            </tr>
                        </thead>
                        <tbody>                    
                            @foreach ($products as $p)
                                <tr>
                                    <td class="descriptionname">{{ $p->codeProduct }}</td>
                                    <td class="descriptionname">{{ $p->nameProduct }}</td>                                    
                                    <td class="descriptionname">{{ $p->priceSaleProduct }}</td>
                                    <td class="descriptionname">{{ $p->priceTrustProduct }}</td>  
                                    <td class="descriptionname">{{ $p->cantStockProduct }}</td> 
                                    <td class="descriptionname">{{ $p->cantStockMinProduct }}</td>                                
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
@endsection