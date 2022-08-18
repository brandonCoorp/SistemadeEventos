@extends('layouts.appAdmi')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">

                <div class="card-body">
              @can('tieneacceso', 'producto.create')

                <a href="{{route('producto.create')}}"
                class="btn btn-primary float-right">Crear</a>
                <br><br>
                @endcan

                @include('Custom.mensaje')

<table class="table table-hover">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Imagen</th>
        <th scope="col">Nombre</th>
        <th scope="col">Descripcion</th>
        <th scope="col">Precio</th>
        <th scope="col">Categoria</th>
        <th colspan="3"></th>
      </tr>
    </thead>
    <tbody>

       @foreach ($productos as $producto)
       <tr>
       <th scope="row">{{$producto->id}}</th>
       <td><img src="{{asset($producto->Imagen)}}" style="width: 100px; height: 70px;" alt=""></td>
       <td>{{$producto->Nombre}}</td>
       <td>{{$producto->Descripcion}}</td>
       <td>{{$producto->Precio}}</td>
       <td>{{$producto->categoria_id}}</td>
      <td>
        @can('tieneacceso', 'producto.edit')
        <a class="btn btn-success" href="{{route('producto.edit',$producto->id)}}">Editar</a>
        @endcan</td>
      <td>
        @can('tieneacceso', 'producto.destroy')
      <form action="{{route('producto.destroy',$producto->id)}}" method="post">
      @csrf
      @method('DELETE')
        <button class="btn btn-danger">Eliminar</button>

      </form>
      @endcan
      </td>

      </tr>
       @endforeach

    </tbody>
  </table>
 {{ $productos->links()}}

        </div>
     </div>
  </div>
</div>
@endsection
