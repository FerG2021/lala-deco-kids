@extends('pages.master')

@section('title', 'Lista de clientes')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/product/productsinstock') }}" class="nav-link"><i class="fas fa-users"></i> Lista de clientes</a>
    </li>  
@endsection

@section('content') <!--aqui se muestan el contenido propio de cada pagina-->
    <!--panel que se va a utilizar para mostrar las diferentes secciones-->
    <div class="container-fluid">
        <div class="panel shadow">
            <div class="header">
                <h2 class="title"><i class="fas fa-users"></i> Lista de clientes</h2>
            </div>
           
            <div class="inside">
                <div class="inside descriptionname">
                    <table id="" class="table responsive table-striped table-dark descriptionname table-bordered border-white display" style="width:100%">
                        <thead>
                            <tr>
                                <th class="descriptionname aling">Apellido</th>
                                <th class="descriptionname aling">Nombre</th>                                
                                <th class="descriptionname aling">DNI</th>
                                <th class="descriptionname aling">Direccion</th>                                
                                <th class="descriptionname aling">Telefono</th>
                                <th class="descriptionname aling">Mail</th>                                
                                <th class="descriptionname aling"></th>
                            </tr>
                        </thead>
                        <tbody>                    
                            @foreach ($clients as $client)
                                <tr>
                                    <td class="descriptionname">{{ $client->lastNameClient }}</td>
                                    <td class="descriptionname">{{ $client->nameClient }}</td>                                    
                                    <td class="descriptionname">{{ $client->dniClient }}</td>
                                    <td class="descriptionname">{{ $client->directionClient }}</td>  
                                    <td class="descriptionname">{{ $client->phoneClient }}</td> 
                                    <td class="descriptionname">{{ $client->mailClient }}</td>                                   
                                    <td class="descriptionname">                                        
                                        <a href="{{ '/client'.'/'.$client->id.'/edit' }}" data-toggle="tooltip" data-placement="top" title="Editar" class="btn btn-primary btn-list-edit">
                                            <i class="fas fa-pencil-alt descriptionname"></i>
                                        </a>
                                        <a href="{{'/client'.'/'.$client->id.'/delete' }}" data-toggle="tooltip" data-placement="top" title="Eliminar" class="delete btn btn-danger btn-list-delete">
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