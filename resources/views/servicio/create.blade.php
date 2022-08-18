@extends('layouts.appAdmi')
@section('content')
<form action="{{route('servicio.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <label for="exampleInputPassword1">Nombre</label>
      <input type="text" class="form-control" name="Nombre"id="exampleInputPassword1">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Descripcion</label>
        <input type="text" class="form-control" name="Descripcion" id="exampleInputPassword1">
      </div>

      <div class="form-group">
        <label for="exampleInputPassword1">Imagen</label>
        <input type="file" class="form-control-file" name="Imagen" id="exampleInputPassword1">
      </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>    

@endsection