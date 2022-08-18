@extends('layouts.appAdmi')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h2>{{ __('Crear Empresa') }}</h2></div>

                <div class="card-body">
                  @include('Custom.mensaje')

                    <form action="{{route('empresa.store')}}" method="POST">
                      @csrf
                          <div class="containner">
                             <h3>Requisito de Datos</h3>
                             <div class="form-group">
                                <label for="Nit">Nit</label>
                                <input type="text" class="form-control"
                                 value="{{old('Nit')}}" name="Nit" id="Nit" placeholder="">
                            </div>
                             <div class="form-group">
                                 <label for="Nombre">Nombre</label>
                                 <input type="text" class="form-control"
                                  value="{{old('Nombre')}}" name="Nombre" id="Nombre" placeholder="nombre">
                             </div>
                             <div class="form-group">
                                <label for="Direccion">Direccion</label>
                                <input type="text" class="form-control"
                                 value="{{old('Direccion')}}" name="Direccion" id="Direccion" >
                            </div>
                             <div class="form-group">
                                <label for="Telefono">Telefono</label>
                                <input type="text" class="form-control"
                                 value="{{old('Telefono')}}" name="Telefono" id="Telefono" placeholder="xxxx00">
                            </div>
                            <div class="form-group">
                                 <label for="Correo">Correo</label>
                                 <input type="text" class="form-control"
                                  value="{{old('Correo')}}" name="Correo" id="Correo" placeholder="example@gmail.com">
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