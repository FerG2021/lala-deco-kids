@extends('pages.master')

@section('title', 'Dashboard')

@section('content') <!--aqui se muestan el contenido propio de cada pagina-->
    <!--panel que se va a utilizar para mostrar las diferentes secciones-->
    <div class="container-fluid">
        <div class="panel shadow">
            <div class="header">
                <h2 class="title"><i class="fas fa-home"></i> Dashboard</h2>
            </div>
           
            <div class="inside">

                
                <!--Cajas para el dashboard-->
                <div class="container-fluid">
                    <!-- Accesos principales -->
                    <div class="row">
                        {{-- Nuevo producto --}}
                        <div class="col-md-4">
                            <div class="full-box tile-container col">
                                <a href="{{ url('/product/addproduct') }}" class="link">
                                    <div class="card" style="">
                                        <div class="card-body">
                                            <h5 class="card-title tile-title">Nuevo producto</h5>
                                            <div class="tile-icon">
                                                <i class="fas fa-box icon"></i>
                                            </div>                           
                                        </div>
                                    </div>
                                </a>     
                            </div>
                        </div>
                        {{-- Nueva compra --}}
                        {{-- <div class="col-md-3">
                            <div class="full-box tile-container col ">
                                <a href="{{ url('/buy/newbuy') }}" class="link">
                                    <div class="card" style="">
                                        <div class="card-body">
                                            <h5 class="card-title tile-title">Nueva compra</h5>
                                            <div class="tile-icon">
                                                <i class="fas fa-shopping-basket icon"></i>
                                            </div>                           
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div> --}}
                        {{-- Nueva venta --}}
                        <div class="col-md-4">
                            <div class="full-box tile-container col"> 
                                <a href="{{ url('/sale/selectnewsale') }}" class="link">
                                    <div class="card" style="">
                                        <div class="card-body">
                                            <h5 class="card-title tile-title">Nueva venta</h5>
                                            <div class="tile-icon">
                                                <i class="fas fa-shopping-cart icon"></i>
                                            </div>                           
                                        </div>
                                    </div>
                                </a>                                         
                            </div>
                        </div>                        
                        {{-- Nuevo presupuesto --}}
                        <div class="col-md-4">
                            <div class="full-box tile-container col">
                                <a href="{{ url('/budget/newbudget') }}" class="link">
                                    <div class="card" style="">
                                        <div class="card-body">
                                            <h5 class="card-title tile-title">Nuevo presupuesto</h5>
                                            <div class="tile-icon">
                                                <i class="fas fa-clipboard-list icon"></i>
                                            </div>                           
                                        </div>
                                    </div>
                                </a>                                       
                            </div>
                        </div>
                    </div>
                    <!-- Administracion -->
                    <!--<div class="row">
                        <div class="full-box tile-container col">
                            <a href="{{ url('/listuser') }}" class="tile">
                                <div class="tile-title">Agregar usuario</div>
                                <div class="tile-icon">
                                    <i class="fas fa-user-plus icon"></i>
                                </div>
                            </a>                                              
                        </div>
                        <div class="full-box tile-container col">
                            <a href="{{ url('/listuser') }}" class="tile">
                                <div class="tile-title">Modificar usuario</div>
                                <div class="tile-icon">
                                    <i class="fas fa-user-edit icon"></i>
                                </div>
                            </a>                                              
                        </div>
                        <div class="full-box tile-container col">
                            <a href="{{ url('/listuser') }}" class="tile">
                                <div class="tile-title">Lista de usuarios</div>
                                <div class="tile-icon">
                                    <i class="fas fa-clipboard-list icon"></i>
                                </div>
                            </a>                                              
                        </div>
                    </div>-->

                    <!-- Productos -->
                    <!--<div class="row">
                        <div class="full-box tile-container col">
                            <a href="{{ url('/listuser') }}" class="tile">
                                <div class="tile-title">Productos en almacen</div>
                                <div class="tile-icon">
                                    <i class="fas fa-boxes icon"></i>
                                </div>
                            </a>                                              
                        </div>
                        <div class="full-box tile-container col">
                            <a href="{{ url('/listuser') }}" class="tile">
                                <div class="tile-title">Productos por vencimiento</div>
                                <div class="tile-icon">
                                    <i class="fas fa-clipboard-list icon"></i>
                                </div>
                            </a>                                              
                        </div>
                        <div class="full-box tile-container col">
                            <a href="{{ url('/listuser') }}" class="tile">
                                <div class="tile-title">Productos en stock minimo</div>
                                <div class="tile-icon">
                                    <i class="fas fa-minus-square icon"></i>
                                </div>
                            </a>                                              
                        </div>
                        <div class="full-box tile-container col">
                            <a href="{{ url('/listuser') }}" class="tile">
                                <div class="tile-title">Buscar producto</div>
                                <div class="tile-icon">
                                    <i class="fas fa-search icon"></i>
                                </div>
                            </a>                                              
                        </div>
                    </div>-->

                    <!-- Compras -->
                    <!--<div class="row">
                        <div class="full-box tile-container col">
                            <a href="{{ url('/listuser') }}" class="tile">
                                <div class="tile-title">Nueva compra</div>
                                <div class="tile-icon">
                                    <i class="fas fa-boxes icon icon"></i>
                                </div>
                            </a>                                              
                        </div>
                        <div class="full-box tile-container col">
                            <a href="{{ url('/listuser') }}" class="tile">
                                <div class="tile-title">Historial de compras</div>
                                <div class="tile-icon">
                                    <i class="fas fa-book-medical icon"></i>
                                </div>
                            </a>                                              
                        </div>                        
                        <div class="full-box tile-container col">
                            <a href="{{ url('/listuser') }}" class="tile">
                                <div class="tile-title">Buscar compra</div>
                                <div class="tile-icon">
                                    <i class="fas fa-search icon"></i>
                                </div>
                            </a>                                              
                        </div>
                    </div>-->

                    <!-- Ventas -->
                    <!--<div class="row">
                        <div class="full-box tile-container col">
                            <a href="{{ url('/listuser') }}" class="tile">
                                <div class="tile-title">Nueva venta</div>
                                <div class="tile-icon">
                                    <i class="fas fa-cart-plus icon"></i>
                                </div>
                            </a>                                              
                        </div>
                        <div class="full-box tile-container col">
                            <a href="{{ url('/listuser') }}" class="tile">
                                <div class="tile-title">Historial de ventas</div>
                                <div class="tile-icon">
                                    <i class="fas fa-book-medical icon"></i>
                                </div>
                            </a>                                              
                        </div>                        
                        <div class="full-box tile-container col">
                            <a href="{{ url('/listuser') }}" class="tile">
                                <div class="tile-title">Buscar venta</div>
                                <div class="tile-icon">
                                    <i class="fas fa-search icon"></i>
                                </div>
                            </a>                                              
                        </div>
                    </div>-->

                    <!-- Clientes -->
                    <!--<div class="row">
                        <div class="full-box tile-container col">
                            <a href="{{ url('/listuser') }}" class="tile">
                                <div class="tile-title">Nuevo cliente</div>
                                <div class="tile-icon">
                                    <i class="fas fa-user-plus icon"></i>
                                </div>
                            </a>                                              
                        </div>
                        <div class="full-box tile-container col">
                            <a href="{{ url('/listuser') }}" class="tile">
                                <div class="tile-title">Lista de clientes</div>
                                <div class="tile-icon">
                                    <i class="fas fa-clipboard-list icon"></i>
                                </div>
                            </a>                                              
                        </div>                        
                        <div class="full-box tile-container col">
                            <a href="{{ url('/listuser') }}" class="tile">
                                <div class="tile-title">Buscar cliente</div>
                                <div class="tile-icon">
                                    <i class="fas fa-search icon"></i>
                                </div>
                            </a>                                              
                        </div>
                    </div>-->

                    <!-- Cuenta corriente -->
                    <!--<div class="row">                        
                        <div class="full-box tile-container col">
                            <a href="{{ url('/listuser') }}" class="tile">
                                <div class="tile-title">Lista de cuenta corriente</div>
                                <div class="tile-icon">
                                    <i class="fas fa-clipboard-list icon"></i>
                                </div>
                            </a>                                              
                        </div>                        
                        <div class="full-box tile-container col">
                            <a href="{{ url('/listuser') }}" class="tile">
                                <div class="tile-title">Buscar cliente</div>
                                <div class="tile-icon">
                                    <i class="fas fa-search icon"></i>
                                </div>
                            </a>                                              
                        </div>
                    </div>-->

                    <!-- Proveedores -->
                    <!--<div class="row">
                        <div class="full-box tile-container col">
                            <a href="{{ url('/listuser') }}" class="tile">
                                <div class="tile-title">Nuevo proveedor</div>
                                <div class="tile-icon">
                                    <i class="fas fa-folder-plus icon"></i>
                                </div>
                            </a>                                              
                        </div>
                        <div class="full-box tile-container col">
                            <a href="{{ url('/listuser') }}" class="tile">
                                <div class="tile-title">Lista de provedores</div>
                                <div class="tile-icon">
                                    <i class="fas fa-clipboard-list icon"></i>
                                </div>
                            </a>                                              
                        </div>                        
                        <div class="full-box tile-container col">
                            <a href="{{ url('/listuser') }}" class="tile">
                                <div class="tile-title">Buscar proveedor</div>
                                <div class="tile-icon">
                                    <i class="fas fa-search icon"></i>
                                </div>
                            </a>                                              
                        </div>
                    </div>-->
                </div>
            </div>
        </div>
    </div>
@endsection
    
