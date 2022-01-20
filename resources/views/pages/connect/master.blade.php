<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lala Deco Kids - @yield('title')</title>
    <link rel="shortcut icon" href="{{url('static/images/buhov.png') }}">


    <!--boostrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ url('/static/css/connect.css?v='.time()) }}">

    <!--fontawesome-->
    <script src="https://kit.fontawesome.com/b5b44e16f8.js" crossorigin="anonymous"></script>
    <!--google fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">   
    
    <!--Añadir script de JS-->
    <script type="text/javascript" src="{{ asset('js/main.js') }}"></script> 
    <!--script para jquery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> 
    <!--script para lightbox-->
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.umd.js"></script>
    <!-- Development version -->
    <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script>
    <!-- Datatables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.1/datatables.min.css"/>
</head>
<body>
    @section('content')
        
    @show
</body>
</html>