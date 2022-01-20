<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!--ruta absoluta hacia la carpeta public para CSS-->
    <link rel="stylesheet" href="{{ url('static/css/pdf.css?v='.time()) }}">

    {{-- font awesome --}}
    <script src="https://kit.fontawesome.com/b5b44e16f8.js" crossorigin="anonymous"></script>
    
    <title>{{$ca->lastNameClient}} {{$ca->nameClient}} - Comprobante cuenta corriente</title>
</head>
<body class="pdf">        
    <div class="header"> 
      <div class="title-header">
        <h3>LALA DECO KIDS <br> COMPROBANTE DE CUENTA CORRIENTE</h3>
        {{-- <h4>Colón y Taboada - Qumilí - Santiago del Estero</h4>
        <h4>CUIT:  20-33703862-0 - Teléfono: 3843-675770</h4> --}}
      </div>    
      <div class="details-budget">  
        <div class="document">
          {{-- <div class="x-container">
            <label for="" class="x">X</label>
          </div>
          <div class="legend">
            <label for="">Documento no válido como factura</label>
          </div> --}}
        </div>      
        <div class="info">
          <div class="title">
            <label for="">Datos</label>
          </div>
          <div class="name-client">
            <label for="">Cliente:</label>
            <label for="">{{$ca->lastNameClient}} {{$ca->nameClient}}</label>
          </div>          
        </div>
      </div>
    </div>

    
   

    <div class="detail-table">
      <table class="table-striped text-center" >
        <thead>
          <tr>
            <th scope="col">Fecha</th>                       
            <th scope="col">Pago</th>
            <th scope="col">Saldo</th>               
          </tr>
        </thead>
        <tbody>
            @foreach ($cadetails as $cadetail)
            <tr>
                <td>{{ date('d-m-Y', strtotime($cadetail->date)) }}</td>                
                <td>{{ $cadetail->pay }}</td>
                <td>{{ $cadetail->sale }}</td>               
                {{-- <td></td> --}}
            </tr>
        @endforeach
        </tbody>
        {{-- <tfoot>
          
          <th scope="col"></th>
          <th scope="col"></th>
          <th scope="col">TOTAL</th>
          <th scope="col">{{$sale->totalPrice}}</th> 
        </tfoot> --}}
      </table>
    </div>

    <div class="balance mtop16">
        <label for="">Saldo adeudado:</label>
        <label for="">{{$ca->balance}}</label>
    </div>

      {{-- <label for="priceTotalBudget">{{$budget->totalPrice}}</label> --}}
</body>
</html>

