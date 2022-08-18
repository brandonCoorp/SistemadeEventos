@extends('layouts.appAdmi')

@section('content')
@extends('layouts.appAdmi')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">

                <div class="card-body">
              @can('tieneacceso', 'empresa.create')
                
                <a href="{{route('empresa.create')}}" 
                class="btn btn-primary float-right">Crear</a>
                <br><br> 
                @endcan
             
                @include('Custom.mensaje')

<table class="table table-hover">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Nit</th> 
        <th scope="col">Nombre</th>
        <th scope="col">Telefono</th>
        <th scope="col">Direcion</th>
        <th scope="col">Correo</th>
        <th colspan="3"></th>
      </tr>
    </thead>
    <tbody>
    
       @foreach ($empresas as $empresa)
       <tr>
       <th scope="row">{{$empresa->id}}</th>
       <td>{{$empresa->Nit}}</td>
       <td>{{$empresa->Nombre}}</td>
       <td>{{$empresa->Telefono}}</td>
       <td>{{$empresa->Direccion}}</td>
       <td>{{$empresa->Correo}}</td>
       <td>
        @can('tieneacceso', 'empresa.show')
        <a class="btn btn-info" href="{{route('empresa.show',$empresa->id)}}">Ver</a>
        @endcan
      </td>  
       <td>
        @can('tieneacceso', 'empresa.edit')
        <a class="btn btn-success" href="{{route('empresa.edit',$empresa->id)}}">Editar</a>
        @endcan</td>  
      <td>
        @can('tieneacceso', 'empresa.destroy')
      <form action="{{route('empresa.destroy',$empresa->id)}}" method="post">
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
 {{ $empresas->links()}}

        </div>
     </div>
  </div>
</div>
@endsection


@endsection