@extends('pages.master')

@section('title', 'Editar cliente')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/product/addproduct') }}" class="nav-link"><i class="fas fa-user-edit"></i> Editar cliente</a>
    </li>  
@endsection

@section('content') <!--aqui se muestan el contenido propio de cada pagina-->
    <!--panel que se va a utilizar para mostrar las diferentes secciones-->
    <div class="container-fluid">
        <div class="panel shadow">
            <div class="header">
                <h2 class="title"><i class="fas fa-user-edit"></i> Editar cliente</h2>
            </div>
           
            <div class="inside">
                <form action="/client/{{ $client->id }}/edit" method="post">
                @csrf
                    {{-- DNI del cliente --}}
                    <div class="row">                    
                        <div class="col-md-6 descriptionname">
                            <label for="dniclient">DNI</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-id-card"></i></span>
                                <input type="number" class="form-control" id="dniclient" name="dniclient" value="{{ $client->dniClient }}">
                            </div>
                        </div>
                    </div>
                    <div class="row mtop16">
                        {{-- Nombre del cliente --}}
                        <div class="col-md-6 descriptionname">
                            <label for="nameclient">Nombre</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                <input type="text" class="form-control" id="nameclient" name="nameclient" value="{{ $client->nameClient }}">
                            </div>
                        </div>
                        {{-- Apellido del cliente --}}
                        <div class="col-md-6 descriptionname">
                            <label for="lastnameclient">Apellido</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                <input type="text" class="form-control" id="lastnameclient" name="lastnameclient" value="{{ $client->lastNameClient }}">
                            </div>
                        </div>
                    </div>
                    <div class="row mtop16">
                        {{-- Direccion del cliente --}}
                        <div class="col-md-4 descriptionname">
                            <label for="directionclient">Direccion</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-map-marker-alt"></i></span>
                                <input type="text" class="form-control" id="directionclient" name="directionclient" value="{{ $client->directionClient }}">
                            </div>
                        </div>
                        {{-- Telefono del cliente --}}
                        <div class="col-md-4 descriptionname">
                            <label for="phoneclient">Telefono</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-mobile-alt"></i></span>
                                <input type="text" class="form-control" id="phoneclient" name="phoneclient"value="{{ $client->phoneClient }}">
                            </div>
                        </div>
                        {{-- Mail del cliente --}}
                        <div class="col-md-4 descriptionname">
                            <label for="mailclient">Mail (opcional)</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-envelope"></i></span>
                                <input type="mail" class="form-control" id="mailclient" name="mailclient" value="{{ $client->mailClient }}">
                            </div>
                        </div>
                    </div>
                    <div class="mtop16">
                        <button class="btn btn-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection