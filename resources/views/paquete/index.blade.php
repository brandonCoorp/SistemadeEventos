@extends('layouts.appAdmi')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">

                    <div class="card-body">
                        @can('tieneacceso', 'categoria.create')

                            <a href="{{route('paquete.create')}}"
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
                                <th scope="col">Servicio</th>
                                <th colspan="3"></th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($paquetes as $paquete)
                                <tr>
                                    <th scope="row">{{$paquete->id}}</th>
                                    <td>{{$paquete->Nombre}}</td>
                                    <td>{{$paquete->Descripcion}}</td>
                                    @foreach ($servicios as $servicio)
                                        @if ($servicio->id == $paquete->servicio_id)
                                        <td>{{$servicio->Nombre}}</td>          
                                        @endif
                                    @endforeach
                                    <td>
                                        @can('tieneacceso', 'rol.edit')
                                            <a class="btn btn-success" href="{{route('paquete.edit',$paquete->id)}}">Editar</a>
                                        @endcan</td>
                                    <td>
                                        @can('tieneacceso', 'rol.destroy')
                                            <form action="{{route('paquete.destroy',$paquete->id)}}" method="post">
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
                        {{ $paquetes->links()}}

                    </div>
                </div>
            </div>
        </div>
@endsection

