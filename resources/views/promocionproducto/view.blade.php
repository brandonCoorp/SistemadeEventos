@extends('layouts.appAdmi')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h2>{{ __('Vista Datos Promocion') }}</h2></div>

                <div class="card-body">
                  @include('Custom.mensaje')

                    <form action="{{route('promocionproducto.update', $promocion->id)}}" method="POST">
                      @csrf
                      @method('PUT')
                     <div class="containner">
                       <h3>Requisito de Datos</h3>
                       <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input disabled type="text" class="form-control"
                         value="{{old('nombre', $promocion->Nombre)}}" name="nombre" id="nombre" placeholder="nombre">
                      </div>
                      <div class="form-group">             
                        <textarea class="form-control" id="Descripcion" disabled
                        name="Descripcion" placeholder="Descripcion"
                       rows="3">{{old('Descripcion',$promocion->Descripcion)}}</textarea>
                      </div>
                      <div class="form-group">
                        <label for="Fecha_inicio">Fecha_inicio</label>
                        <input type="text" class="form-control" disabled 
                        value="{{old('Fecha_inicio',$promocion->Fecha_inicio)}}" name="Fecha_inicio" id="Fecha_inicio">
                      </div>
                      <div class="form-group">
                        <label for="Fecha_fin">Fecha Fin</label>
                        <input type="text" class="form-control" disabled 
                        value="{{old('Fecha_fin',$promocion->Fecha_fin)}}" name="Fecha_fin" id="Fecha_fin">
                      </div>
                      <hr>
                    <a href="{{route('promocionproducto.edit',$promocion->id)}}" class="btn btn-success">Editar</a>
                   
                    <a href="{{route('promocionproducto.index')}}" class="btn btn-danger">volver</a>
                    
                    </div>


           </form>
           
           
           
           
                </div>
            </div>
        </div>
    </div>
</div>
@endsection