
<div class="sidebar shadow">
    {{-- <div class="toggle-btn">
        <span>&#9776;</span>
    </div> --}}
    <div class="section-top">
        <div class="logo">
            <img src="{{url('static/images/user.png') }}" class="img-fluid"> 
        </div>
        <div class="user">
            <span class="subititule">Hola:</span>
            <div class="name">
                {{Auth::user()->name }}  {{Auth::user()->lastname }}
                <!--<a href="  url('/logout') }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Salir"><i class="fas fa-sign-out-alt"></i></a>-->
            </div>
        </div>
    </div>

    
    <!--Botones-->
    <div class="main">        
        {{-- SIDEBAR BOOTSTRAP --}}
        <div class="accordion accordion-flush descriptionname" id="accordionSidebar">
            {{-- DASHBOARD --}}
            <div class="accordion-item shadow bg-body rounded descriptionname" >
                <h2 class="accordion-header descriptionname" id="flush-dashboard">
                    <button class="accordion-button collapsed descriptionname" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        <i class="fas fa-home"></i>Dashboard</a>
                    </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-dashboard" data-bs-parent="#accordionSidebar">
                    <div class="accordion-body">
                        <ul>
                            <li>
                                <div>                                    
                                    <a href="{{ url('/home') }}" class="mletf16"><i class="fas fa-home"></i>Home</a></a>
                                </div>
                            </li>                            
                        </ul>      
                    </div>
                </div>
            </div>
            {{-- ADMINISTRACION --}}
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-administration">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                        <i class="fas fa-user-cog"></i> Administración
                    </button>
                </h2>
                <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-administration" data-bs-parent="#accordionSidebar">
                    <div class="accordion-body">
                        <ul>
                            <li>
                                <div>                                    
                                    <a href="{{'/user/adduser'}}" class="mletf16"><i class="fas fa-user-plus"></i>Agregar usuario</a>
                                </div>
                            </li>                            
                            <li>
                                <div>                                    
                                    <a href="{{'/user/listuser'}}" class="mletf16"><i class="fas fa-clipboard-list"></i>Lista de usuarios</a>
                                </div>
                            </li>
                        </ul>      
                    </div>
                </div>
            </div>
            {{-- PRODUCTOS --}}
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-products">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                        <i class="fas fa-boxes"></i>Productos
                    </button>
                </h2>
                <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-products" data-bs-parent="#accordionSidebar">
                    <div class="accordion-body">
                        <ul>
                            <li>
                                <div>
                                    <a href="{{ url('/product/addproduct') }}" class="mletf16"><i class="fas fa-box"></i>Nuevo producto</a>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <a href="{{ url('/product/productsinstock') }}" class="mletf16"><i class="fas fa-boxes"></i>Productos en stock</a>
                                </div>
                            </li>
                            {{-- <li>
                                <div>
                                    <a href="{{ url('/productsexpiration') }}" class="mletf16"><i class="fas fa-exclamation-triangle"></i>Productos por vencimiento</a>
                                </div>
                            </li> --}}
                            <li>
                                <div>
                                    <a href="{{ url('/product/productsinminstock') }}" class="mletf16"><i class="fas fa-exclamation-triangle"></i></i>Productos en stock minimo</a>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <a href="{{ url('/product/generatebarcode') }}" class="mletf16"><i class="fas fa-barcode"></i> Generar código de barras</a>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <a href="{{ url('/product/listbarcode') }}" class="mletf16"><i class="fas fa-list"></i> Lista de códigos de barras</a>
                                </div>
                            </li>
                    </ul>
                    </div>
                </div>
            </div>
            {{-- COMPRAS --}}
            {{-- <div class="accordion-item">
                <h2 class="accordion-header" id="flush-buy">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                        <i class="fas fa-shopping-basket"></i>Compras
                    </button>
                </h2>
                <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-buy" data-bs-parent="#accordionSidebar">
                    <div class="accordion-body">
                        <ul>
                            <li>
                            <div>
                                {{-- <a href="{{ url('/newbuy') }}" class="mletf16"><i class="fas fa-cart-plus"></i>Nueva compra</a>
                                <a href="{{'/buy/newbuy'}}" class="mletf16"><i class="fas fa-cart-plus"></i>Nueva compra</a>
                            </div>
                            </li>
                            <li>
                            <div>
                                {{-- <a href="{{ url('/adduser') }}" class="mletf16"><i class="fas fa-book-medical"></i>Historial compras</a>
                                <a href="{{'/buy/listbuy'}}" class="mletf16"><i class="fas fa-list-alt"></i> Historial compras</a>
                            </div>
                            </li>
                            {{-- <li>
                            <div>
                                {{-- <a href="{{ url('/adduser') }}" class="mletf16"><i class="fas fa-search"></i>Buscar compra</a> 
                                <a href="" class="mletf16"><i class="fas fa-search"></i>Buscar compra</a>
                            </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div> --}}
            {{-- VENTAS --}}
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-sale">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
                        <i class="fas fa-shopping-cart"></i>Ventas
                    </button>
                </h2>
                <div id="flush-collapseFive" class="accordion-collapse collapse" aria-labelledby="flush-sale" data-bs-parent="#accordionSidebar">
                    <div class="accordion-body">
                        <ul>
                            <li>
                                <div>
                                {{-- <a href="{{ url('/adduser') }}" class="mletf16"><i class="fas fa-cart-plus"></i>Nueva venta</a> --}}
                                    <a href="{{ url('/sale/selectnewsale') }}" class="mletf16"><i class="fas fa-cart-plus"></i>Nueva venta</a>
                                </div>
                            </li>
                            <li>
                                <div>
                                {{-- <a href="{{ url('/adduser') }}" class="mletf16"><i class="fas fa-book-medical"></i>Historial ventas</a> --}}
                                    <a href="{{ url('/sale/listsales') }}" class="mletf16"><i class="fas fa-list-ol"></i>Historial ventas</a>
                                </div>
                            </li>
                            {{-- <li>
                                <div>
                                {{-- <a href="{{ url('/adduser') }}" class="mletf16"><i class="fas fa-search"></i>Buscar venta</a>
                                    <a href="" class="mletf16"><i class="fas fa-search"></i>Buscar venta</a>
                                </div>
                            </li>                     --}}
                        </ul>
                    </div>
                </div>
            </div>
            {{-- PRESUPUESTOS --}}
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-budget">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSix" aria-expanded="false" aria-controls="flush-collapseSix">
                        <i class="fas fa-clipboard-list"></i>Presupuestos
                    </button>
                </h2>
                <div id="flush-collapseSix" class="accordion-collapse collapse" aria-labelledby="flush-budget" data-bs-parent="#accordionSidebar">
                    <div class="accordion-body">
                        <ul>
                            <li>
                                <div>
                                    <a href="{{ url('/budget/newbudget') }}" class="mletf16"><i class="fas fa-plus"></i>Nuevo presupuesto</a>
                                    {{-- <a href="" class="mletf16"><i class="fas fa-plus"></i>Nuevo presupuesto</a> --}}
                                </div>
                            </li>
                            <li>
                            <div>
                                <a href="{{ url('/budget/listbudget') }}" class="mletf16"><i class="fas fa-clipboard-list"></i>Lista de presupuestos</a> 
                                {{-- <a href="" class="mletf16"><i class="fas fa-list-ol"></i>Lista de presupuestos</a> --}}
                            </div>
                            </li>                                  
                        </ul>
                    </div>
                </div>
            </div>
            {{-- CLIENTES --}}
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-clients">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSeven" aria-expanded="false" aria-controls="flush-collapseSeven">
                        <i class="fas fa-users"></i>Clientes
                    </button>
                </h2>
                <div id="flush-collapseSeven" class="accordion-collapse collapse" aria-labelledby="flush-clients" data-bs-parent="#accordionSidebar">
                    <div class="accordion-body">
                        <ul>
                            <li>
                                <div>
                                    {{-- NUEVO CLIENTE --}}
                                    <a href="{{url('/client/addnewclient')}}" class="mletf16"><i class="fas fa-user-plus"></i>Nuevo cliente</a>
                                </div>
                            </li>
                            <li>
                                <div>
                                    {{-- LISTA DE CLIENTES --}}
                                    <a href="{{url('/client/listclient')}}" class="mletf16"><i class="fas fa-clipboard-list"></i>Lista de clientes</a>
                                </div>
                            </li>
                            {{-- <li>
                                <div>
                                    {{-- <a href="{{ url('/adduser') }}" class="mletf16"><i class="fas fa-search"></i>Buscar cliente</a>
                                    <a href="" class="mletf16"><i class="fas fa-search"></i>Buscar cliente</a>
                                </div>
                            </li>                     --}}
                        </ul>
                    </div>
                </div>
            </div>
            {{-- CUENTA CORRIENTE --}}
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-currentacount">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseEight" aria-expanded="false" aria-controls="flush-collapseEight">
                        <i class="fas fa-dollar-sign"></i>Cuenta corriente
                    </button>
                </h2>
                <div id="flush-collapseEight" class="accordion-collapse collapse" aria-labelledby="flush-currentacount" data-bs-parent="#accordionSidebar">
                    <div class="accordion-body">
                        <ul>
                            <li>
                            <div>
                                {{-- <a href="{{ url('/adduser') }}" class="mletf16"><i class="fas fa-clipboard-list"></i>Lista cuenta corriente</a> --}}
                                <a href="{{ url('/currentaccount/listcurrentaccount') }}" class="mletf16"><i class="fas fa-clipboard-list"></i>Lista cuenta corriente</a>
                            </div>
                            </li>
                            {{-- <li>
                                <div>
                                    
                                    <a href="" class="mletf16"><i class="fas fa-search"></i>Buscar cliente</a>
                                </div>
                            </li>                                     --}}
                        </ul>
                    </div>
                </div>
            </div>
            {{-- PROVEEDORES --}}
            {{-- <div class="accordion-item">
                <h2 class="accordion-header to-down" id="flush-providers">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseNine" aria-expanded="false" aria-controls="flush-collapseNine">
                        <i class="fas fa-truck"></i>Proveedores
                    </button>
                </h2>
                <div id="flush-collapseNine" class="accordion-collapse collapse" aria-labelledby="flush-providers" data-bs-parent="#accordionSidebar">
                    <div class="accordion-body">
                        <ul>
                            <li>
                            <div>
                                <a href="{{url('provider/newprovider')}}" class="mletf16"><i class="fas fa-folder-plus"></i>Nuevo proveedor</a>
                            </div>
                            </li>
                            <li>
                            <div>
                                <a href="{{ url('provider/listprovider') }}" class="mletf16"><i class="fas fa-clipboard-list"></i>Lista de proveedores</a>
                            </div>
                            </li>                            
                        </ul>
                    </div>
                </div>
            </div> --}}
        </div>




    </div>  
    
    
    <!--Contenido-->
    <!--<div class="collapse" id="collpase1">
        <p>Contenido 1</p>
    </div>-->


    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
</div>
