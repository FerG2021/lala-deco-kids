@extends('pages.master')

@section('title', 'Nuevo producto')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/product/addproduct') }}" class="nav-link"><i class="fas fa-box"></i> Nuevo producto</a>
    </li>  
@endsection

@section('content') <!--aqui se muestan el contenido propio de cada pagina-->
    <!--panel que se va a utilizar para mostrar las diferentes secciones-->
    <div class="container-fluid">
        <div class="panel shadow">
            <div class="header">
                <h2 class="title"><i class="fas fa-box"></i> Nuevo producto</h2>
            </div>
           
            <div class="inside">
                <form action="{{ url('/product/addproduct') }}" method="post">
                @csrf                    
                    <div class="row">
                        {{-- Codigo del producto --}}
                        <div class="col-md-6 descriptionname">
                            <label for="codeproduct">Codigo del producto</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-barcode"></i></span>
                                <input type="number" class="form-control" id="codeproduct" name="codeproduct">
                            </div>
                        </div>
                        {{-- Nombre del producto --}}
                        <div class="col-md-6 descriptionname">
                            <label for="nameproduct">Nombre del producto</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                <input type="text" class="form-control" name="nameproduct" id="nameproduct">
                            </div>
                        </div>
                    </div>

                    <div class="row mtop16">
                        {{-- Precio de venta --}}
                        <div class="col-md-6 descriptionname">
                            <label for="pricesaleproduct">Precio de venta</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-dollar-sign"></i></span>
                                <input type="decimal" class="form-control" id="pricesaleproduct" name="pricesaleproduct">
                            </div>
                        </div>
                        {{-- Porcentaje de precio de fiado --}}
                        <div class="col-md-6 descriptionname">
                            <label for="porcpricetrust">Porcentaje precio de fiado</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-percentage"></i></span>
                                <input type="number" class="form-control" id="porcpricetrust" name="porcpricetrust" value="10">
                            </div>
                        </div>                        
                    </div>

                    <div class="row mtop16">
                        {{-- Cantidad de stock --}}
                        <div class="col-md-6 descriptionname">
                            <label for="cantstockproduct">Cantidad de stock</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-cubes"></i></span>
                                <input type="number" class="form-control" id="cantstockproduct" name="cantstockproduct">
                            </div>
                        </div> 
                        {{-- Cantidad de stock minimo --}}
                        <div class="col-md-6 descriptionname">
                            <label for="cantstockminproduct">Cantidad de stock minimo</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-exclamation-triangle"></i></span>
                                <input type="number" class="form-control" id="cantstockminproduct" name="cantstockminproduct">
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