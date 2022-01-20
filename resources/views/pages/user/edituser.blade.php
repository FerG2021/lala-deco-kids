@extends('pages.master')

@section('title', 'Editar usuario')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/product/addproduct') }}" class="nav-link"><i class="fas fa-user-edit"></i> Editar usuario</a>
    </li>  
@endsection

@section('content') <!--aqui se muestan el contenido propio de cada pagina-->
    <!--panel que se va a utilizar para mostrar las diferentes secciones-->
    <div class="container-fluid">
        <div class="panel shadow">
            <div class="header">
                <h2 class="title"><i class="fas fa-user-edit"></i> Editar usario</h2>
            </div>
           
            <div class="inside">
                <form action="/user/{{ $id }}/edit" method="post">
                @csrf
                    
                    <div class="row descriptionname">
                        {{-- Nombre del usuario --}}
                        <div class="col-md-6">
                            <label for="name">Nombre</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                            </div>
                        </div>
                        {{-- Apellido del usuario --}}
                        <div class="col-md-6">
                            <label for="lastname">Apellido</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                <input type="text" class="form-control" id="lastname" name="lastname" value="{{ $user->lastname }}">
                            </div>
                        </div>
                    </div>
                    {{-- Nombre de usuario --}}
                    <div class="row descriptionname mtop16">
                        <div class="col-md-12">
                            <label for="userName">Nombre de usuario</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                                <input type="text" class="form-control" id="userName" name="userName" value="{{ $user->userName }}">
                            </div>
                        </div>
                    </div>
                    {{-- Contrasena --}}
                    <div class="row descriptionname mtop16">
                        <div class="col-md-12">
                            <label for="password">Contraseña</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-key"></i></span>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                        </div>
                    </div>
                    {{-- Confirmar contrasena --}}
                    <div class="row descriptionname mtop16">
                        <div class="col-md-12">
                            <label for="cpassword">Confirmar contraseña</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-key"></i></span>
                                <input type="password" class="form-control" id="cpassword" name="cpassword">
                            </div>
                        </div>
                    </div>
                    <div class="mtop16">
                        <button class="btn btn-success success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection