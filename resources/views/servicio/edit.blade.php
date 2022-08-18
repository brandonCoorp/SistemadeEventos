@extends('layouts.appAdmi')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h2>{{ __('Editar Servicio') }}</h2></div>

                <div class="card-body">
                  @include('Custom.mensaje')

                    <form action="{{route('servicio.update', $servicio->id)}}" method="POST" enctype="multipart/form-data">
                      @csrf
                      @method('PUT')
                     <div class="containner">
                       <h3>Requisito de Datos</h3>
                       <div class="form-group">
                        <label for="Nombre">Nombre</label>
                        <input type="text" class="form-control"
                         value="{{old('Nombre', $servicio->Nombre)}}" name="Nombre" id="Nombre" placeholder="nombre">
                      </div>
                        <textarea class="form-control" id="Descripcion"
                        name="Descripcion" placeholder="Descripcion"
                       rows="3">{{old('Descripcion',$servicio->Descripcion)}}</textarea>
                      </div>
                      <div class="form-group">
                        <label for="Imagen">Cambiar Imagen</label>
                        <input type="file" class="form-control"
                         name="Imagen" id="Imagen" >
                      </div>
                      
                      <hr>
                      <button type="submit" class="btn btn-primary" >Guardar</button> 
                    </div>


           </form>
           
           
           
           
                </div>
            </div>
        </div>
    </div>
</div>
@endsection