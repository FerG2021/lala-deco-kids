@extends('pages.master')

@section('title', 'Lista de codigos de barras')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/product/productsinstock') }}" class="nav-link"><i class="fas fa-list"></i> Lista de códigos de barras</a>
    </li>  
@endsection

@section('content') <!--aqui se muestan el contenido propio de cada pagina-->
    <!--panel que se va a utilizar para mostrar las diferentes secciones-->
    <div class="container-fluid">
        <div class="panel shadow">
            <div class="header">
                <h2 class="title"><i class="fas fa-list"></i> Lista de códigos de barras</h2>
            </div>
           
            <div class="inside">
                <div class="inside descriptionname">
                    <table id="" class="table responsive table-striped table-dark descriptionname table-bordered border-white display" style="width:100%">
                        <thead>
                            <tr>
                                <th class="descriptionname aling">Código</th>
                                <th class="descriptionname aling">Nombre</th>                                
                                <th class="descriptionname aling"></th>                                
                            </tr>
                        </thead>
                        <tbody>                    
                            @foreach ($productbarcodes as $productbarcode)
                                <tr>
                                    <td class="descriptionname">{{ $productbarcode->barcodeBarCodeProduct }}</td>
                                    <td class="descriptionname">{{ $productbarcode->nameBarCodeProduct }}</td>                                                              
                                    <td class="descriptionname">                                        
                                        <a href="{{ '/product'.'/'.$productbarcode->id.'/detailbarcode' }}" data-toggle="tooltip" data-placement="top" title="Codigo de barras" class="btn btn-primary btn-list-edit" target="_blank">
                                            <i class="fas fa-barcode"></i>
                                        </a>   
                                        
                                        {{-- <a href="{{ '/product'.'/'.$productbarcode->id.'/ticketbarcode' }}" data-toggle="tooltip" data-placement="top" title="Generar ticket con codigo de barras" class="btn btn-primary btn-list-edit">
                                            <i class="fas fa-file-invoice-dollar"></i>
                                        </a> --}}
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
    </div>
@endsection