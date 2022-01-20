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
    
    <title>Presupuesto nro {{$budget->id}} - Lala Deco Kids</title>
</head>
<body class="pdf">        
    <div class="header"> 
      <div class="title-header">
        <h3>LALA DECO KIDS - PRESUPUESTO</h3>
        {{-- <h4>Colón y Taboada - Qumilí - Santiago del Estero</h4>
        <h4>CUIT:  20-33703862-0 - Teléfono: 3843-675770</h4> --}}
      </div>    
      <div class="details-budget">  
        <div class="document">
          <div class="x-container">
            <label for="" class="x">X</label>
          </div>
          <div class="legend">
            <label for="">Documento no válido como factura</label>
          </div>
        </div>      
        <div class="info">
          <div class="title">
            <label for="">Datos</label>
          </div>
          <div class="name-client">
            <label for="">Cliente:</label>
            <label for="">{{$budget->nameClient}}</label>
          </div>
          <div class="id-budget">
            <label for="">Número:</label>
            <label for="">{{$budget->id}}</label>
          </div>
          <div class="date">
            <label for="">Fecha:</label>
            <label for="">{{ date('d-m-Y', strtotime($budget->date)) }}</label>
          </div>
          <div class="name-seller">
            <label for="">Vendedor:</label>
            <label for="">{{$budget->nameSeller}}</label>
          </div>
        </div>
      </div>
    </div>

    
   

    <div class="detail-table">
      <table class="table-striped text-center" >
        <thead>
          <tr>
            <th scope="col">Cantidad</th>
            <th scope="col">Descripción</th>
            <th scope="col">Precio</th>
            <th scope="col">Subtotal</th>          
          </tr>
        </thead>
        <tbody>
            @foreach ($budgetproducts as $budgetproduct)
            <tr>
                <td>{{ $budgetproduct->cantProduct }}</td>
                <td>{{ $budgetproduct->name }}</td>
                <td>{{ $budgetproduct->priceProduct }}</td>
                <td>{{ $budgetproduct->subtotal }}</td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
          <th scope="col"></th>
          <th scope="col"></th>
          <th scope="col">TOTAL</th>
          <th scope="col">{{$budget->totalPrice}}</th> 
        </tfoot>
      </table>
    </div>

      {{-- <label for="priceTotalBudget">{{$budget->totalPrice}}</label> --}}
</body>
</html>

