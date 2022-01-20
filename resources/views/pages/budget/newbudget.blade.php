@extends('pages.master')

@section('title', 'Nuevo presupuesto')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="" class="nav-link"><i class="fas fa-clipboard-list"></i> Nuevo presupuesto</a>
    </li>  
@endsection

@section('content')
<div class="container-fluid">
    <div class="panel shadow">
        <div class="header">
            <h2 class="title"><i class="fas fa-clipboard-list"></i> Nuevo presupuesto</h2>
        </div>               

        <div class="inside descriptionname">
      
            <form action="/budget/newbudget" method="post">
            @csrf
                {{-- Nombre del vendedor --}}
                <div class="row">
                    <label for="nameseller">Nombre del vendedor</label>                
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-user-tie"></i></span>
                        <input type="text" class="form-control" name="nameseller" id="nameseller" value="{{Auth::user()->name }}  {{Auth::user()->lastname }}" readonly>
                    </div>
                </div>

                {{-- Nombre del cliente --}}
                <div class="row">
                    <label for="nameclient">Nombre del cliente</label>                
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                        <input type="text" class="form-control" name="nameclient" id="nameclient"> 
                    </div>
                </div>

                {{-- Fecha de venta --}}
                <div class="row">
                    <label for="datesale">Fecha de venta</label>                
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-calendar-alt"></i></span>
                        <input type="date" class="form-control" id="datesale" name="datesale" value="{{$now->format('Y-m-d')}}" readonly>
                    </div>
                </div>

                {{-- nombre del cliente --}}
                {{-- <input type="hidden" id="nameclientinput" name="nameclientinput" value=""> --}}

                {{-- Boton generar venta --}}           
                <button class="btn btn-success">Generar presupuesto</button>
            </form>
                
        </div>
    </div>
</div>

@endsection