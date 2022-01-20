@extends('pages.connect.master') <!--le decimos que login utilice el arvhivo master, que se encuentra dentro de connect-->

@section('title', 'Registro de usuario') <!--cambiamos el titulo de la pestaña login, llamado por title en master-->

@section('content')
    <div class="box box_register shadow">
        <div class="header">
            <div class="title">
                LALA DECO KIDS - Registrar usuario
            </div>           
        </div>
        <div class="inside">
            {!! Form::open(['url' => '/register']) !!} <!--Abrir un formulario con html colectivo-->
            <label for="name">Nombre:</label>            
            <div class="input-group">            
                <div class="input-group">                    
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                    {!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}
                </div>                    
             </div>
                
            <label for="lastname" class="mtop16">Apellido:</label>            
            <div class="input-group">            
                <div class="input-group">                    
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                    {!! Form::text('lastname', null, ['class' => 'form-control', 'required']) !!}
                </div>
                    
            </div>

            <label for="userName" class="mtop16">Nombre de usuario:</label>            
            <div class="input-group">            
                <div class="input-group">                    
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-user-tag"></i></span>
                    {!! Form::text('userName', null, ['class' => 'form-control', 'required']) !!}
                </div>                
            </div>

            <label for="password" class="mtop16">Contraseña:</label>
            <div class="input-group">            
                <div class="input-group">                    
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-key"></i></span>
                    {!! Form::password('password', ['class' => 'form-control', 'required']) !!}
                </div>
                
            </div>

            <label for="cpassword" class="mtop16">Confirmar contraseña:</label>
            <div class="input-group">            
                <div class="input-group">                    
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-key"></i></span>
                    {!! Form::password('cpassword', ['class' => 'form-control', 'required']) !!}
                </div>
                
            </div>

            {!! Form::submit('Registrarse', ['class' => 'btn btn-success mtop16']) !!}
            {!! Form::close() !!} <!--Cerrar un formulario con html colectivo-->

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

            <div class="footer mtop16">
                <a href="{{ url('/login')}}">Ya tengo cuenta, ingresar</a>                
            </div>
        </div>

       
        
    </div>
@stop