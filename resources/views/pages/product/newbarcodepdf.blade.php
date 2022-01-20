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
    
    <title> {{ $barcodes }} - Código de barras</title>
</head>
<body class="pdf">        
    {{-- Codigo de barra --}}
    {{-- <div>
        {!! DNS1D::getBarcodeHTML($barcodes, "C128") !!}
    </div> 
    <div>
        {{ $barcodes }}
    </div> --}}
    
    @while ($i >= 0)
        {{-- Codigo de barra --}}
        <div>
            {!! DNS1D::getBarcodeHTML($barcodes, "C128") !!}
        </div>        
        <div>
            {{ $barcodes }}
        </div>
        <input type="hidden" value="{{ $i = $i - 1 }}">
        &nbsp;

    @endwhile

</body>
</html>

