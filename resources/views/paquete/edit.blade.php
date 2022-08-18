@extends('layouts.appAdmi')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h2>{{ __('Editar Paquete') }}</h2></div>

                    <div class="card-body">
                        @include('Custom.mensaje')

                        <form action="{{route('paquete.update', $paquete->id)}}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="containner">
                                <h3>Requisito de Datos</h3>
                                <div class="form-group">
                                    <label for="Nombre">Nombre</label>
                                    <input type="text" class="form-control"
                                           value="{{old('Nombre', $paquete->Nombre)}}" name="Nombre" id="Nombre" placeholder="nombre">
                                </div>
                                <textarea class="form-control" id="Descripcion"
                                          name="Descripcion" placeholder="Descripcion"
                                          rows="3">{{old('Descripcion',$paquete->Descripcion)}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="servicio">servicio : </label>  
                                <select class="form-control"name="servicio_id" id="servicio"> 
                                  @foreach ($servicios as $servicio)
                                     <option value="{{old('Nombre',$servicio->id)}}"
                                        @if ($servicio->id == $paquete->servicio_id)
                                            selected
                                        @endif
                                         >
                                        {{$servicio->Nombre}}</option>
                                 @endforeach
                                </select>
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
