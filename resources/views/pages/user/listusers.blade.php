@extends('pages.master')

@section('title', 'Lista de usuarios')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/product/productsinstock') }}" class="nav-link"><i class="fas fa-users"></i> Lista de usuarios</a>
    </li>  
@endsection

@section('content') <!--aqui se muestan el contenido propio de cada pagina-->
    <!--panel que se va a utilizar para mostrar las diferentes secciones-->
    <div class="container-fluid">
        <div class="panel shadow">
            <div class="header">
                <h2 class="title"><i class="fas fa-users"></i> Lista de usuarios</h2>
            </div>
           
            <div class="inside">
                <div class="inside descriptionname">
                    <table id="" class="table responsive table-striped table-dark descriptionname table-bordered border-white display" style="width:100%">
                        <thead>
                            <tr>
                                <th class="descriptionname aling">Apellido</th>
                                <th class="descriptionname aling">Nombre</th>                                
                                <th class="descriptionname aling">Nombre de usuario</th>
                                {{-- <th class="descriptionname aling">Precio de fiado</th>                                
                                <th class="descriptionname aling">Cantidad de stock</th>
                                <th class="descriptionname aling">Cantidad minima de stock</th>                                 --}}
                                <th class="descriptionname aling"></th>
                            </tr>
                        </thead>
                        <tbody>                    
                            @foreach ($users as $user)
                                <tr>
                                    <td class="descriptionname">{{ $user->lastname }}</td>
                                    <td class="descriptionname">{{ $user->name }}</td>                                    
                                    <td class="descriptionname">{{ $user->userName }}</td>
                                    {{-- <td class="descriptionname">{{ $p->priceTrustProduct }}</td>  
                                    <td class="descriptionname">{{ $p->cantStockProduct }}</td> 
                                    <td class="descriptionname">{{ $p->cantStockMinProduct }}</td>                                    --}}
                                    <td class="descriptionname">                                        
                                        <a href="{{ '/user'.'/'.$user->id.'/edit' }}" data-toggle="tooltip" data-placement="top" title="Editar" class="btn btn-primary btn-list-edit">
                                            <i class="fas fa-pencil-alt descriptionname"></i>
                                        </a>
                                        <a href="{{'/user'.'/'.$user->id.'/delete' }}" data-toggle="tooltip" data-placement="top" title="Eliminar" class="delete btn btn-danger btn-list-delete">
                                            <i class="fas fa-trash-alt descriptionname"></i>
                                        </a>                                           
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