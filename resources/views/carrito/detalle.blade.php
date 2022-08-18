@extends('layouts.app2')

@section('contenido')

    
    <!-- BREADCRUMB -->
    <div id="breadcrumb" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <h3 class="breadcrumb-header">Carrito</h3>
                    <ul class="breadcrumb-tree">
                        <li>Detalle</li>
                        <li class="active">Carrito</li>
                    </ul>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /BREADCRUMB -->

    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
         <form action="{{route('carrito.store')}}"   method="POST">
                 @csrf 
                <div class="containner">
            <div class="row">
 
                <div class="col-md-7">
                    <!-- Billing Details -->
                    <div class="billing-details">
                        <div class="section-title">
                            <h3 class="title">Direccion de Envío</h3>
                        </div>
                        <div class="form-group">
                            <input class="input" value="{{old('Nombre', $persona->Nombre)}}" type="text" name="Nombre" placeholder="Nombre">
                        </div>
                        <div class="form-group">
                            <input class="input" type="text" value="{{old('Apellido', $persona->Apellido)}}" name="Apellido" placeholder="Apellido">
                        </div>
                        <div class="form-group">
                            <input class="input" type="email" value="{{old('email', $users->email)}}" name="email" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <input class="input" type="text" value="{{old('Direccion', $persona->Direccion)}}" name="Direccion" placeholder="Direccion">
                        </div>
                        <div class="form-group">
                            <input class="input" type="tel" value="{{old('Telefono', $persona->Telefono)}}" name="Telefono" placeholder="Telefono">
                        </div>
                        <div class="form-group"> 
                            <input type="date" class="form-control"
                             value="{{old('Fecha_inicio')}}" name="Fecha_inicio" id="Fecha_inicio" >
                        <input type="text" name="total" id="total" value="{{$totales}}" hidden="none">
                            </div>
                    </div>
                    <!-- /Billing Details -->

                    <!-- Shiping Details -->
                    <div class="shiping-details">
                        <div class="section-title">
                            <h3 class="title">Direccion de Envios</h3>
                        </div>
                        <div class="input-checkbox">
                            <input type="checkbox" id="shiping-address">
                            <label for="shiping-address">
                                <span></span>
                                Enviar a una direccion diferente?
                            </label>
                            <div class="caption">
                                
                                <div class="form-group">
                                    <input class="input" type="text" name="address" placeholder="Direccion">
                                </div>
                                <div class="form-group">
                                    <input class="input" type="text" name="city" placeholder="Ciudad">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Shiping Details -->

                    <!-- Order notes -->
                    <div class="order-notes">
                        <textarea class="input" placeholder="Notas de Pedido"></textarea>
                    </div>
                    <!-- /Order notes -->
                </div>

                <!-- Order Details -->
                <div class="col-md-5 order-details">
                    <div class="section-title text-center">
                        <h3 class="title">Tu Orden</h3>
                    </div>
                    <div class="order-summary">
                        <div class="order-col">
                            <div><strong>PAQUETE</strong></div>
                            <div><strong>TOTAL</strong></div>
                        </div>
                        <div class="order-products">
                            @foreach ($paquetes as $paquete)
                            <div class="order-col">
                                <div>1x {{$paquete->Nombre}}</div>
                                <div><strong>Bs.{{$paquete->Total}}</strong></div>
                            </div>
                            @foreach ($paqueteprod as $item)
                               @if ($paquete->id == $item->paquete_id)
                                 <div class="order-col">
                                 <div>{{$item->cantidad}}x 
                                    @foreach ($productos as $producto)
                                    @if ($item->producto_id == $producto->id)
                                    {{$producto->Nombre}} 
                                    </div>
                                    <div>Bs.{{$producto->Precio*$item->cantidad}}</div>        
                                    @endif
                                    @endforeach
                                </div>
                               @endif     
                            @endforeach

                            @endforeach       
                        </div>
<hr>
                        <div class="order-col">
                            <div><strong>OTROS PRODUCTO</strong></div>
                            <div><strong>TOTAL</strong></div>
                        </div>
                        <div class="order-products">
                            @foreach ($dproductos as $dproducto)
                            <div class="order-col">
                              
                                <div>{{$dproducto->cantidad}}x
                                    @foreach ($productos as $producto)
                                    @if ($dproducto->producto_id == $producto->id)
                                    {{$producto->Nombre}}         
                                    @endif
                                @endforeach 
                                    </div>
                                    <div>Bs.{{$dproducto->Total}}</div>
                                </div>
                            @endforeach
                           
                        </div>
                        <div class="order-col">
                            <div>Envío</div>
                            <div><strong>Gratis</strong></div>
                        </div>
                    <hr>
                        <div class="order-col">
                            <div><strong>TOTAL</strong></div>
                        <div><strong class="order-total">Bs.{{$totales}}</strong></div>
                        </div>
                    </div>

                    <div class="payment-method">
                        <div class="input-radio">
                            <input type="radio" name="payment" value="1" id="payment-1">
                            <label for="payment-1">
                                <span></span>
                                Transferencia Bancaria
                            </label>
                            <div class="caption">
                                <p>Transferencia directa a traves de Numero de cuenta del Banco.</p>
                            </div>
                        </div>
                        <div class="input-radio">
                            <input type="radio" name="payment"  value="2" id="payment-2">
                            <label for="payment-2">
                                <span></span>
                                Tarjeta De Credito
                            </label>
                            <div class="caption">
                                <p>Compras online a traves de tarjeta de credito</p>
                            </div>
                        </div>
                        <div class="input-radio">
                            <input type="radio" name="payment"  value="3" id="payment-3">
                            <label for="payment-3">
                                <span></span>
                                Sistema Paypal
                            </label>
                            <div class="caption">
                                <p>Systema de compras onlines </p>
                               <!--  <form action="{{ url('charge') }}" method="post">-->
                               <!--      <input type="text" name="amount"  hidden="none"/>-->
                                 <!--    <input type="submit" name="submit" hidden="none" value="Pay Now">-->
                              <!--   </form>-->
                         <!--     <a href="{{route('paypal')}}">paypal</a>-->
                            </div>
                        </div>
                    </div>
                    
                    <button type="submit" name="enviar" class="btn btn-light btn-lg btn-block" > <a style="color: white" class="primary-btn order-submit"> Comprar</a></button>
                </div>
                <!-- /Order Details -->
            
            </div>

        </div>
         </form>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

    @endsection      