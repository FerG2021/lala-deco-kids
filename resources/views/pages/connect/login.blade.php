@extends('pages.connect.master')

@section('title', 'Login')
    
@section('content')
    <div class="box box_login shadow">
        <div class="header">
            <div class="title">
                LALA DECO KIDS
            </div>           
        </div>

        <div class="inside">
                {!! Form::open(['url' => '/']) !!} <!--Abrir un formulario con html colectivo-->
            <label for="text">Usuario:</label>
            <div class="input-group">            
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                    {!! Form::text('userName', null, ['class' => 'form-control']) !!}
                </div>            
            </div>

            <label for="password" class="mtop16">Contraseña:</label>
            <div class="input-group">            
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                </div>            
                
            </div>
            {!! Form::submit('Ingresar', ['class' => 'btn btn-success mtop16']) !!}
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
                            setTimeout(function(){$('.alert').slideUp();}, 5000);
                        </script>
                    </div>
                </div>        
            @endif

            <div class="footer mtop16">
                {{-- <a href="{{ url('/register') }}">¿No tienes cuenta? Registrarse</a> --}}
                {{-- <a href="{{ url('/recover') }}">Recuperar contraseña</a> --}}
            </div>
        </div>    
    </div>
@stop