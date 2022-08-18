@extends('layouts.appAdmi')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h2>{{ __('Editar Empresa') }}</h2></div>

                <div class="card-body">
                  @include('Custom.mensaje')

                    <form action="{{route('empresa.update', $empresa->id)}}" method="POST">
                      @csrf
                      @method('PUT')
                     <div class="containner">
                       <h3>Requisito de Datos</h3>
                       <div class="form-group">
                        <label for="Nit">Nit</label>
                        <input type="text" class="form-control"
                         value="{{old('Nit', $empresa->Nit)}}" name="Nit" id="Nit" >
                      </div>
                        <label for="Nombre">Nombre</label>
                        <input type="text" class="form-control"
                         value="{{old('Nombre', $empresa->Nombre)}}" name="Nombre" id="Nombre">
                      </div>
                      <div class="form-group">
                        <label for="Direccion">Direccion </label>
                        <input type="text" class="form-control"
                         value="{{old('Direccion',$empresa->Direccion)}}" name="Direccion" id="Direccion">
                      </div>
                      <div class="form-group">
                        <label for="Telefono">Telefono</label>
                        <input type="text" class="form-control"
                         value="{{old('Telefono',$empresa->Telefono)}}" name="Telefono" id="Telefono">
                      </div>
                      <div class="form-group">
                        <label for="Correo">Correo </label>
                        <input type="text" class="form-control"
                         value="{{old('Correo',$empresa->Correo)}}" name="Correo" id="Correo">
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