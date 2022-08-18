@extends('layouts.app2')

@section('contenido')


<div class="container-sm" id="contenedorCatalogo">
  <div class="catalogo" id="catalogo">
  <div id="carouselExampleCaptions" class="carousel slide " data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
    <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
  </ol>
  
  <div class="carousel-inner">
           <div class="carousel-item active">
             <img src="{{asset('assets/img/evento1.jpg')}}"style="width: 1200px; height=500px;" class="d-block" alt="...">
             <div class="carousel-caption d-none d-md-block">
             <h5>Coca-Cola</h5>
           </div>
         </div>

          @foreach ($paquetes as $paquete)
         <div class="carousel-item " >
           <img src="{{$paquete->Imagen}}"  style="width: 1200px; height=600px;"class="d-block" alt="...">
           <div class="carousel-caption d-none d-md-block">
             <h5>{{$paquete->Nombre}}</h5>
             <p>{{$paquete->Descripcion}}</p>
            </div>
          </div>
         @endforeach
   </div>
        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
  </div>
</div>
</div>
@endsection                       
