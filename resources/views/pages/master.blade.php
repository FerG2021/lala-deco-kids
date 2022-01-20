<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - Lala Deco Kids</title>
    <link rel="shortcut icon" href="{{url('static/images/buhov.png') }}">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="routeName" content="{{ Route::currentRouteName() }}">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    {{-- Datatables --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.1/css/dataTables.bootstrap5.min.css">
        {{-- Datatables botones --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jszip-2.5.0/b-2.0.1/b-html5-2.0.1/b-print-2.0.1/datatables.min.css"/>

    {{-- Jquery --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    {{-- CSS y styl --}}    
    <link rel="stylesheet" href="{{ url('static/css/pages.css?v='.time()) }}">

    {{-- Font awesome --}}
    <script src="https://kit.fontawesome.com/b5b44e16f8.js" crossorigin="anonymous"></script>

    {{-- Google fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>    

    <div class="wrapper">
        
        <div class="col1">
            
            @include('pages.sidebar')
        </div>        
        
        <div class="col2">
            {{-- <nav class="navbar navbar-expand-lg shadow"> --}}
            <nav class="navbar navbar-expand-lg shadow">
                <div class="collapse navbar-collapse">                    
                    <ul class="navbar-nav">                        
                        <li class="nav-item">
                            <a href="{{ url('/home') }}" class="nav-link"><i class="fas fa-home"></i> Dashboard</a>                            
                        </li>
                    </ul>
                    <div class="notification">
                        {{-- <a href="" type="button"  data-bs-toggle="tooltip" data-bs-placement="bottom" title="Notificaciones"><i class="fas fa-bell"></i></a>  --}}
                        <a href="{{ url('/logout') }}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Salir"><i class="fas fa-power-off"></i><a>                       

                        {{-- Formulario para el cierre de la sesion --}}
                        {{-- <form style="display: inline" action="{{ url('/logout') }}" method="post">
                        @csrf
                            <a href="" onclick="this.closest('form').submit()"><i class="fas fa-power-off"></a>
                        </form> --}}
                    </div>                    

                    {{-- <div class="collapse navbar-collapse navbar-items" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item dropdown navbar-ul">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Notificaciones">
                                    <i class="fas fa-bell" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Notificaciones"></i> 
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="#">Stock</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="#">Vencimiento</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                            </li>                            
                            <li class="nav-item">
                                <a href="{{ url('/logout') }}" class="nav-link" ><i class="fas fa-power-off" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Salir"></i></a>
                            </li>
                        </ul>                        
                    </div> --}}

                </div>
            </nav> 

            {{-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                  <a class="navbar-brand" href="#">Navbar</a>
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                      <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                      </li>
                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Dropdown
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <li><a class="dropdown-item" href="#">Action</a></li>
                          <li><a class="dropdown-item" href="#">Another action</a></li>
                          <li><hr class="dropdown-divider"></li>
                          <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link disabled">Disabled</a>
                      </li>
                    </ul>
                    <form class="d-flex">
                      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                      <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                  </div>
                </div>
            </nav> --}}
            
            
            
            
              <div class="page">                
                <div class="container-fluid">
                    <nav aria-label="breadcrumb shadow">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ url('/home') }}" class="nav-link"><i class="fas fa-home"></i> Dashboard</a>                                
                            </li>
                            @section('breadcrumb') 
                            @show
                        </ol>
                    </nav>
                </div>

                 
                <!--FUNCION QUE PERMITE MOSTRAR LOS ERRORES--> 
                @if (Session::has('message'))
                    <div class="container">
                        <div class="mtop16 alert alert-{{Session::get('typealert')}}" style="display: none;">
                            {{Session::get('message')}}
                            @if ($errors->any())
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>    
                            @endif
                            <script>
                                $('.alert').slideDown();
                                setTimeout(function(){$('.alert').slideUp();}, 10000);
                            </script>
                        </div>
                    </div>        
                @endif

                @section('content')  
                @show                 
                
            </div>            
        </div>
    
    
    
    </div>
    {{-- <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip()
        });
    </script> --}}
    

    {{-- <script>
        $("#menu-toggle").click(function(e){
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        })
    </script> --}}
    
    
    {{-- Datatables --}}
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.1/js/dataTables.bootstrap5.min.js"></script>

        {{-- sum --}}
        <script src="https://cdn.datatables.net/plug-ins/1.11.1/api/sum().js"></script>

        {{-- datapciker --}}
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/b-2.0.1/b-html5-2.0.1/b-print-2.0.1/datatables.min.js"></script>


        
    
    {{-- JS --}}
    <script type="text/javascript" src="{{ asset('js/main.js') }}"></script>

    
</body>
<footer>
    <div class="foot">
        <p>Desarrollado por Fernando González - fernandojaviergonzalez2018@gmail.com</p>
    </div>
</footer>
</html>