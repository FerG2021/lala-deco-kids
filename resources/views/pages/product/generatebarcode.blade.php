@extends('pages.master')

@section('title', 'Generar codigo de barras')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/product/addproduct') }}" class="nav-link"><i class="fas fa-barcode"></i> Generar codigo de barras</a>
    </li>  
@endsection

@section('content') <!--aqui se muestan el contenido propio de cada pagina-->
    <!--panel que se va a utilizar para mostrar las diferentes secciones-->
    <div class="container-fluid">
        <div class="panel shadow">
            <div class="header">
                <h2 class="title"><i class="fas fa-barcode"></i> Generar codigo de barras</h2>
            </div>
           
            <div class="inside">
                <form action="/product/generatebarcode" method="post">
                @csrf
                    <div class="row">
                        {{-- Codigo del producto --}}
                        <div class="col-md-6 descriptionname">
                            <label for="codeproduct">Ingrese el codigo del producto</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-barcode"></i></span>
                                <input type="text" class="form-control" id="codeproduct" name="codeproduct">
                            </div>
                        </div>
                        {{-- Nombre del producto --}}
                        <div class="col-md-6 descriptionname">
                            <label for="nameproduct">Ingrese el nombre del producto</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                <input type="text" class="form-control" id="nameproduct" name="nameproduct">
                            </div>
                        </div>
                    </div>
                    {{-- Boton guardar --}}
                    <div class="row mtop16">
                        <div class="col-md-3 descriptionname">
                            <button class="btn btn-success success">Guardar</button>                            
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection