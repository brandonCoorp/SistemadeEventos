<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/dashboard/bootstrap.min.css">
  <script src="css/dashboard/jquery.js"></script>
  <script src="css/dashboard/bootstrap.js"></script>

<title>Factura</title>
</head>
<body>
<img src="assets/img/logo-grande.png" height="100" width="100">
<strong><h2 >Factura Electronica</h2></strong>

<h4>Folio Fiscal :</h4>
<h5>59EFREFERG-GERGE-RGHRT-JHTH-TERER</h5>
<h4>Certificado SIN : 20000000000000123545</h4>

<h4>Fecha : <?php echo now(); ?></h4> 


<h3>Receptor : {{$persona->name}}</h3>
<h3>ID del usuario : {{$persona->email}}</h3>

	
<!-- Order Details -->
<div class="col-md-5 order-details">
    <div class="section-title text-center">
        <h3 class="title">Tu Orden</h3>
    </div>
    <div class="order-summary">
      
            <div><strong>PAQUETE</strong></div>
<table class="table table-striped">
    <thead>
    <tr>
        <th>Cantidad</th>
        <th>Precio</th>
        <th>Nombre</th>
        <th>Monto</th>
    </tr>
    </thead>
    <tbody>
        @foreach ($paquetes as $paquete)
        <tr>
            <td>1x</td>
            <td>{{$paquete->Precio}}</td>
            <td><strong>{{$paquete->Nombre}}</strong></td>
            <td><strong>Bs.{{$paquete->Total}}</strong></td>
        </tr>
            @foreach ($paqueteprod as $item)
            @if ($paquete->id == $item->paquete_id)
            <tr>
               <td>{{$item->cantidad}}x</td>
                  @foreach ($productos as $producto)
                      @if ($item->producto_id == $producto->id)
                        <td>{{$producto->Precio}}</td>
                        <td> {{$producto->Nombre}}</td> 
                        <td>Bs.{{$producto->Precio*$item->cantidad}}</td>     
                      @endif
                 @endforeach
            </tr>
          @endif 
            @endforeach 
      
        @endforeach
    </tbody>
</table>
       


<hr>
        <div class="order-col">
            <div><strong>OTROS PRODUCTO</strong></div>      
        </div>
    </div>
</div>
<!-- /Order Details -->

<table class="table table-striped">
    <thead>
    <tr>
        <th>Cantidad</th>
        <th>Precio</th>
        <th>Nombre</th>
        <th>Monto</th>
    </tr>
    </thead>
    <tbody>
        @foreach ($dproductos as $dproducto)
        <tr>
            <td>{{$dproducto->cantidad}}x</td>
            <td>{{$dproducto->Precio}}</td>
                @foreach ($productos as $producto)
                @if ($dproducto->producto_id == $producto->id)
                <td> {{$producto->Nombre}}</td>        
                @endif
            @endforeach 
        <td>Bs.{{$dproducto->Total}}</td>
    </tr>
        @endforeach
    </tbody>
</table>

    <h3>Costo de envío : Gratis</h2>
<h2>Subtotal : {{$factura->Total }} Bs.</h2>
    <h2>Subtotal + IVA (13 %) : <?php echo round(12+$factura->Total*1.13,2); ?> Bs.</h2>
</body>
</html>