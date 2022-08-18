@extends('layouts.appAdmi')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h2>{{ __('Editar Promocion') }}</h2></div>

                <div class="card-body">
                  @include('Custom.mensaje')

                    <form action="{{route('promocionproducto.update', $promocion->id)}}" method="POST">
                      @csrf
                      @method('PUT')
                     <div class="containner">
                       <h3>Requisito de Datos</h3>
                       <div class="form-group">
                        <label for="Nombre">Nombre</label>
                        <input type="text" class="form-control"
                         value="{{old('Nombre', $promocion->Nombre)}}" name="Nombre" id="Nombre" placeholder="nombre">
                      </div>
                      <div class="form-group">
                      <textarea class="form-control" id="Descripcion"
                        name="Descripcion" placeholder="Descripcion"
                       rows="3">{{old('Descripcion',$promocion->Descripcion)}}</textarea>
                      </div>
                      <div class="form-group">
                        <label for="Porcentaje">Porcentaje %</label>
                        <input type="text" class="form-control"
                         value="{{old('Porcentaje')}}" name="Porcentaje" id="Porcentaje">
                      </div>
                    
                      <div class="form-group">
                        <label for="Fecha_inicio">Fecha de Inicio</label>
                        <input type="Date" class="form-control"
                         value="{{old('Fecha_inicio', $promocion->Fecha_inicio)}}" name="Fecha_inicio" id="Fecha_inicio">
                      </div>
                      
                      <div class="form-group">
                        <label for="Fecha_fin">Fecha  Fin</label>
                        <input type="Date" class="form-control"
                         value="{{old('Fecha_fin', $promocion->Fecha_fin)}}" name="Fecha_fin" id="Fecha_fin">
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