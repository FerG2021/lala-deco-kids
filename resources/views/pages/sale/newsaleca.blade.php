@extends('pages.master')

@section('title', 'Nueva venta CC')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="" class="nav-link"><i class="fas fa-shopping-cart"></i> Nueva venta - Cuenta Corriente</a>
    </li>  
@endsection

@section('content')
<div class="container-fluid">
    <div class="panel shadow">
        <div class="header">
            <h2 class="title"><i class="fas fa-shopping-cart"></i> Nueva venta - Cuenta Corriente</h2>
        </div>               

        <div class="inside descriptionname">

            
                {{-- Agregar nuevo cliente --}}
                <div class="add-client descriptionname">
                    <label for="newClient">¿No existe el cliente?</label>
                    <button type="button" class="btn btn-purple" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Añadir nuevo cliente
                    </button>
                </div>

            <form action="/sale/newsaleca" method="post">
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
                    <label for="namebuyer">Nombre del comprador</label>                
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                        <select name="namebuyer" id="namebuyer" class="form-select" onchange="selectIdClient();">
                            <option selected disabled>Seleccione un cliente</option>
                            @foreach ($clients as $client)
                                <option value="{{$client->id}}" data-name="{{$client->lastNameClient}} {{$client->nameClient}}">{{$client->lastNameClient}} {{$client->nameClient}} - {{ $client->dniClient }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Fecha de venta --}}
                <div class="row">
                    <label for="datesale">Fecha de venta</label>                
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-calendar-alt"></i></span>
                        <input type="date" class="form-control" id="datesale" name="datesale" value="{{$now->format('d-m-Y')}}">
                    </div>
                </div>

                {{-- nombre del cliente --}}
                <input type="hidden" id="nameclientinput" name="nameclientinput" value="">

                {{-- Boton generar venta --}}           
                <button class="btn btn-success">Generar venta</button>
            </form>
                
        </div>
    </div>
</div>

<!-- Modal anadir nuevo cliente -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header descriptionname">
          <h5 class="modal-title" id="staticBackdropLabel">Agregar nuevo cliente</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body descriptionname">
            <form action="/client/addnewclientsale" method="post">
            @csrf
                <div class="row">
                    {{-- dni cliente --}}
                    <label for="dniclient">DNI</label>
                    <div class="input-group col-md-12">
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-address-card"></i></span>
                        <input type="text" class="form-control" name="dniclient" id="dniclient">
                    </div>
                </div>
                <div class="row mtop10">
                    {{-- nombre cliente --}}
                    <div class="col-md-6">
                        <label for="nameclient">Nombre</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                            <input type="text" class="form-control" name="nameclient" id="nameclient">
                        </div>
                    </div>
                    {{-- apellido cliente --}}
                    <div class="col-md-6">
                        <label for="lastnameclient">Apellido</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                            <input type="text" class="form-control" name="lastnameclient" id="lastnameclient">
                        </div>
                    </div>                
                </div>
                <div class="row mtop10">
                    <div class="col-md-4">
                        <label for="directionclient">Direccion</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-map-marker-alt"></i></span>
                            <input type="text" class="form-control" name="directionclient" id="directionclient">
                        </div>
                    </div>   
                    <div class="col-md-4">
                        <label for="phoneclient">Telefono</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-mobile-alt"></i></span>
                            <input type="text" class="form-control" name="phoneclient" id="phoneclient">
                        </div>
                    </div> 
                    <div class="col-md-4">
                        <label for="mailclient">Mail (opcional)</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-envelope"></i></span>
                            <input type="mail" class="form-control" name="mailclient" id="mailclient">
                        </div>
                    </div> 
                </div>
        </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-danger delete" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-success success">Guardar</button>
                </div>
            </form>
      </div>
    </div>
  </div>
@endsection