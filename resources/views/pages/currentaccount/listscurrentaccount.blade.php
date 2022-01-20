@extends('pages.master')

@section('title', 'Lista de cuentas corrientes')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="" class="nav-link"><i class="fas fa-list-ol"></i> Lista de cuentas corrientes</a>
    </li>  
@endsection

@section('content')
<div class="container-fluid">
    <div class="panel shadow">
        <div class="header">
            <h2 class="title"><i class="fas fa-list-ol"></i> Lista de cuentas corrientes</h2>
        </div>  
        
        {{-- Notificacion de deuda cuenta corriente --}}
        <div class="control-last-action">
            @if ($deudors == 1)            
                {{-- toast para notificaciones --}}
                <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
                 <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                     <div class="toast-header text-white">
                         {{-- <img src="..." class="rounded me-2" alt="..."> --}}
                         {{-- <i class="fas fa-exclamation-triangle mright5"></i> --}}
                         <strong class="me-auto"><b><i class="fas fa-exclamation-triangle warning"></i> Notificacion de saldo adeudado</b></strong>
                         {{-- <small>11 mins ago</small> --}}
                         <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                     </div>
                     <div class="toast-body"> 
                        Hay clientes con fecha de ultima actualización de saldo mayores a 30 días <br>
                        {{-- <a href="/minstock" type="button" class="btn btn-secondary btn-sm">Ver stock mínimo</a> --}}
                        <div class="btn-group" >
                            <button type="button" class="btn btn-primary edit" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Clientes
                            </button>
                            {{-- <button  type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModa2">
                                Firmas
                            </button> --}}
                        </div>
                     </div>
                 </div>
             </div>
            @else
                
            @endif
         </div>

        <div class="inside descriptionname">
            <table class="table responsive table-striped table-dark descriptionname table-bordered border-white display" style="width:100%">
                <thead>
                    <tr>
                        <th>Apellido</th>
                        <th>Nombre</th>
                        <th>DNI</th>
                        <th>Saldo</th>
                        <th>Fecha ultima modificacion</th>
                        <th></th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clientcas as $clientca)
                        <tr>
                            <td>{{ $clientca->lastNameClient }}</td>
                            <td>{{ $clientca->nameClient }}</td>
                            <td>{{ $clientca->dniClient }}</td>
                            <td>{{ $clientca->balance }}</td>
                            <td>{{ date('d-m-Y', strtotime($clientca->datelastaction))}}</td>                            
                            <td>
                                {{-- <a href="/sale/{{$currentaccount->id}}/saledetail" class="btn btn-primary btn-list-edit" data-toggle="tooltip" data-placement="top" title="Detalle"><i class="fas fa-info-circle"></i></a> --}}
                                {{-- COBRAR --}}
                                <a href="" class="btn btn-success btn-list-success" data-toggle="tooltip" data-placement="top" title="Cobrar" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $clientca->id }}">
                                    <i class="fas fa-cash-register"></i>
                                </a>

                                {{-- AGREGAR INTERESES --}}
                                <a href="" class="btn btn-danger btn-list-delete" data-toggle="tooltip" data-placement="top" title="Agregar intereses" data-bs-toggle="modal" data-bs-target="#interestsModal{{ $clientca->id }}">
                                    <i class="fas fa-percentage"></i>
                                </a>

                                {{-- DETALLES --}}
                                <a href="/currentaccount/{{ $clientca->id }}/cadetail" class="btn btn-primary btn-list-edit" data-toggle="tooltip" data-placement="top" title="Detalles">
                                    <i class="fas fa-info-circle"></i>
                                </a>

                                {{-- <a class="btn btn-primary btn-list-edit" data-toggle="tooltip" data-placement="top" title="Detalles" data-bs-toggle="modal" href="#exampleModalToggleDetail{{ $clientca->id }}" role="button">
                                    <i class="fas fa-info-circle"></i>
                                </a> --}}

                                {{-- TICKET --}}
                                <a href="/currentaccount/{{$clientca->id}}/getticketca" class="btn btn-warning btn-list-warning" data-toggle="tooltip" data-placement="top" title="Generar ticket" >
                                    <i class="fas fa-file-invoice-dollar"></i>
                                </a>
                                
                                {{-- BOLETA --}}
                                <a href="/currentaccount/{{$clientca->id}}/getpdf" target="_blank" class="btn btn-danger btn-list-delete" data-toggle="tooltip" data-placement="top" title="Generar boleta" >
                                    <i class="far fa-file-pdf"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    
                </tfoot>
            </table>
           
        </div>
    </div>
</div>

{{-- Modal cobranza de cuenta corriente --}}
@foreach ($clientcas as $clientca)
    <div class="modal fade" id="exampleModal{{ $clientca->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header descriptionname">
            <h5 class="modal-title" id="exampleModalLabel">Cobrar cuenta corriente</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body descriptionname">
                <form action="/currentaccount/{{ $clientca->id }}/payca" method="post">
                @csrf
                    <div class="row">
                        {{-- Monto adeudado --}}
                        <div class="col-md-6">
                            <label for="mountca">Monto adeudado</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-file-invoice-dollar"></i></span>
                                <input type="number" class="form-control" id="mountca" name="mountca" value="{{ $clientca->balance }}" readonly>
                            </div>
                        </div>
                        {{-- Total a pagar --}}
                        <div class="col-md-6">
                            <label for="totalpay">$ entregado</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-dollar-sign"></i></span>
                                <input type="number" class="form-control" id="totalpay" name="totalpay">
                            </div>
                        </div>
                        <input type="hidden" name="idclient" id="idclient" value="{{ $clientca->clientId }}">
                    </div>
                
            </div>
            <div class="modal-footer">
                    <button type="button" class="btn btn-danger delete" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-success success">Cobrar</button>
                </form>
            </div>
        </div>
        </div>
    </div>
@endforeach

<!-- Modal para agregar intereses-->
@foreach ($clientcas as $clientca)
    <div class="modal fade" id="interestsModal{{ $clientca->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header descriptionname">
            <h5 class="modal-title" id="exampleModalLabel">Agregar intereses</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body descriptionname">
                    <form action="/currentaccount/{{ $clientca->id }}/addinterests" method="post">
                    @csrf
                        <div class="row">                    
                            {{-- Monto adeudado --}}
                            <div class="col-md-6">
                                <label for="mountca">Monto adeudado</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-file-invoice-dollar"></i></span>
                                    <input type="number" class="form-control" id="mountca" name="mountca" value="{{ $clientca->balance }}" readonly>
                                </div>
                            </div>
                            {{-- Total a pagar --}}
                            <div class="col-md-6">
                                <label for="interests">% de interes</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-percentage"></i></span>
                                    <input type="number" class="form-control" id="interests" name="interests">
                                </div>
                            </div>
                            <input type="hidden" name="idclient" id="idclient" value="{{ $clientca->clientId }}">
                        </div>

            </div>
            <div class="modal-footer">
                        <button type="button" class="btn btn-danger delete" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-success success">Agregar intereses</button>
                    </form>
            </div>
        </div>
        </div>
    </div>
@endforeach

<!-- Modal para detalle de deudores - Personas -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content descriptionname">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Clientes con deuda</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <table id="" class="table responsive table-striped table-dark descriptionname table-bordered border-white display" style="width:100%">
                <thead>
                    <tr>
                        <th>Apellido</th>
                        <th>Nombre</th>
                        <th>DNI</th>
                        <th>Saldo</th>  
                        <th>Fecha última acción</th>                           
                                              
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clientcas as $clientca)
                        @if ($clientca->deudors == 1 && $clientca->clientIdFirm == 0)
                            <tr>
                                <td>{{ $clientca->lastNameClient }}</td>
                                <td>{{ $clientca->nameClient }}</td>
                                <td>{{ $clientca->dniClient }}</td>
                                <td>{{ $clientca->balance }}</td>
                                <td>{{ date('d-m-Y', strtotime($clientca->datelastaction)) }}</td>                               
                            </tr> 
                        @endif
                   @endforeach
                </tbody>
                <tfoot>
                    
                </tfoot>
            </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger delete" data-bs-dismiss="modal">Cerrar</button>
          {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
        </div>
      </div>
    </div>
</div>

{{-- Modal para mostrar detalles de la cuenta corriente --}}

    {{-- MODAL 1 --}}
@foreach ($clientcas as $clientca)
    <div class="modal fade" id="exampleModalToggleDetail{{ $clientca->id }}" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title descriptionname" id="exampleModalToggleLabel">Detalle de cuenta corriente</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body descriptionname">
                {{-- Nombre del cliente --}}
                <div class="row mbottom10">
                    <div class="col-md-5">
                        <label for="client">Cliente:</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-money-check-alt"></i></span>
                            <input type="text" class="form-control" id="client" name="client" value="{{ $clientca->lastNameClient }} {{ $clientca->nameClient }}" readonly>
                        </div>
                    </div>
                </div>

                <table class="table responsive table-striped table-dark descriptionname table-bordered border-white display" style="width:100%">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Pago</th>
                            <th>Saldo adeudado</th>                        
                            <th></th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cadetails as $cadetail)
                            @if ($cadetail->idCurrentAccount == $clientca->id)
                                <tr>
                                    <td>{{ date('d-m-Y', strtotime($cadetail->date)) }}</td>
                                    <td>{{ $cadetail->pay }}</td>
                                    <td>{{ $cadetail->sale }}</td>
                                    @if ($cadetail->typemovement == 0)
                                        <td>
                                            <a href="/currentaccount/{{ $cadetail->idsale }}/detailsale" class="btn btn-primary btn-list-edit" data-toggle="tooltip" data-placement="top" title="Detalles de venta"><i class="fas fa-info-circle"></i></a>  
                                            
                                            <button class="btn btn-primary btn-list-edit" data-bs-target="#exampleModalToggleDetail2{{ $cadetail->idsale }}" data-bs-toggle="modal" data-toggle="tooltip" data-placement="top" title="Detalles de venta">
                                                <i class="fas fa-info-circle"></i>
                                            </button>
                                            
                                        </td>
                                    @else
                                        <td></td>
                                    @endif                   
                                </tr>
                            @else
                                
                            @endif
                        @endforeach
                    </tbody>
                    <tfoot>
                        
                    </tfoot>
                </table>
            </div>
            <div class="modal-footer">
            <button class="btn btn-primary" data-bs-target="#exampleModalToggleDetail2" data-bs-toggle="modal">Open second modal</button>
            </div>
        </div>
        </div>
    </div>
@endforeach


{{-- MODAL 2 --}}
@foreach ($cadetails as $cadetail)
    <div class="modal fade" id="exampleModalToggleDetail2{{ $cadetail->idsale }}" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title descriptionname" id="exampleModalToggleLabel2">Detalle de venta</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body descriptionname">
            Hide this modal and show the first with the button below.
            </div>
            <div class="modal-footer">
            {{-- <button class="btn btn-primary" data-bs-target="#exampleModalToggleDetail" data-bs-toggle="modal">Back to first</button> --}}
            </div>
        </div>
        </div>
    </div>
@endforeach

@endsection