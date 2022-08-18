@extends('layouts.appAdmi')

@section('content')
@extends('layouts.appAdmi')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">

                <div class="card-body">
              @can('tieneacceso', 'promocion.create')
                
                <a href="{{route('promocion.create')}}" 
                class="btn btn-primary float-right">Crear</a>
                <br><br> 
                @endcan
             
                @include('Custom.mensaje')

<table class="table table-hover">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Nombre</th>
        <th scope="col">Descripcion</th>
        <th scope="col">Fecha Inicio</th>
        <th scope="col">Fecha Fin</th>
        <th colspan="3"></th>
      </tr>
    </thead>
    <tbody>
    
       @foreach ($promocions as $promocion)
       <tr>
       <th scope="row">{{$promocion->id}}</th>
       <td>{{$promocion->Nombre}}</td>
       <td>{{$promocion->Descripcion}}</td>
       <td>{{$promocion->Fecha_inicio}}</td>
       <td>{{$promocion->Fecha_fin}}</td>
       
       <td>
        @can('tieneacceso', 'promocion.edit')
        <a class="btn btn-success" href="{{route('promocion.edit',$promocion->id)}}">Editar</a>
        @endcan</td>  
      <td>
        @can('tieneacceso', 'promocion.destroy')
      <form action="{{route('promocion.destroy',$promocion->id)}}" method="post">
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
 
        </div>
     </div>
  </div>
</div>
@endsection


@endsection