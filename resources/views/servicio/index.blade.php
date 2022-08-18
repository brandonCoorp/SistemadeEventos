@extends('layouts.appAdmi')
@section('content')
    
@extends('layouts.appAdmi')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">

                <div class="card-body">
              @can('tieneacceso', 'categoria.create')
                
                <a href="{{route('servicio.create')}}" 
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
        <th colspan="3"></th>
      </tr>
    </thead>
    <tbody>
    
       @foreach ($servicios as $servicio)
       <tr>
       <th scope="row">{{$servicio->id}}</th>
       <td><img src="{{asset($servicio->Imagen)}}" style="width: 100px; height=30px;" alt=""></td>
       <td>{{$servicio->Nombre}}</td>
       <td>{{$servicio->Descripcion}}</td>
      <td>
        @can('tieneacceso', 'categoria.edit')
        <a class="btn btn-success" href="{{route('servicio.edit',$servicio->id)}}">Editar</a>
        @endcan</td>  
      <td>
        @can('tieneacceso', 'categoria.destroy')
      <form action="{{route('servicio.destroy',$servicio->id)}}" method="post">
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
 {{ $servicios->links()}}

        </div>
     </div>
  </div>
</div>
@endsection
@endsection