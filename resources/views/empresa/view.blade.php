@extends('layouts.appAdmi')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2>{{ __('Vista Datos Empresa') }}</h2>
                    </div>

                    <div class="card-body">
                        @include('Custom.mensaje')

                        <form action="{{ route('empresa.update', $empresa->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="containner">

                                <h3>Requisito de Datos</h3>
                                <div class="form-group">
                                    <label for="Nit">Nit</label>
                                    <input type="text" class="form-control" disabled value="{{ old('Nit', $empresa->Nit) }}"
                                        name="Nit" id="Nit">
                                </div>
                                <div class="form-group">
                                    <label for="Nombre">Nombre</label>
                                    <input type="text" class="form-control" disabled
                                        value="{{ old('Nombre', $empresa->Nombre) }}" name="Nombre" id="Nombre">
                                </div>
                                <div class="form-group">
                                    <label for="Direccion">Direccion</label>
                                    <input type="text" class="form-control" disabled
                                        value="{{ old('Direccion', $empresa->Direccion) }}" name="Direccion" id="Direccion">
                                </div>
                                <div class="form-group">
                                    <label for="Telefono">Telefono</label>
                                    <input type="text" class="form-control" disabled
                                        value="{{ old('Telefono', $empresa->Telefono) }}" name="Telefono" id="Telefono">
                                </div>
                                <div class="form-group">
                                    <label for="Correro">Correro</label>
                                    <input type="text" class="form-control" disabled
                                        value="{{ old('Correro', $empresa->Correro) }}" name="Correro" id="Correro">
                                </div>
                                <hr>
                                <a href="{{ route('empresa.edit', $empresa->id) }}" class="btn btn-success">Editar</a>
                                <a href="{{ route('empresa.index') }}" class="btn btn-danger">volver</a>

                            </div>


                        </form>




                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
