@extends('layouts.appAdmi')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h2>{{ __('Crear Paquete') }}</h2></div>

                    <div class="card-body">
                        @include('Custom.mensaje')

                        <form action="{{route('paquete.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="containner">
                                <h3>Requisito de Datos</h3>
                                <div class="form-group">
                                    <label for="Nombre">Nombre</label>
                                    <input type="text" class="form-control"
                                           value="{{old('Nombre')}}" name="Nombre" id="Nombre" placeholder="Nombre">

                                </div>
                                <div class="form-group">
                                        <textarea class="form-control" id="Descripcion"
                                                  name="Descripcion" placeholder="Descripcion"
                                                  rows="3">{{old('Descripcion')}}</textarea>
                                    </label>
                                </div>
                                <div class="form-group" >
                                    <label for="">Imagen</label>
                                    <input type="file" name="Imagen" value="" class="form-control-file">
                                </div>
                                <div class="form-group">
                                        <label for="servicio">servicio : </label>  
                                        <select class="form-control"name="servicio_id" id="servicio"> 
                                          @foreach ($servicios as $servicio)
                                             <option value="{{$servicio->id}}">{{$servicio->Nombre}}</option>
                                         @endforeach
                                        </select>
                                    </div>
                                <div class="form-group col-md-4" style="display: inline-block">
                                        <label for="Categoria">Categoria : </label>  
                                        <select  class="form-control"name="Categoria" id="Categoria"> 
                                          @foreach ($categorias as $categoria)
                                             <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                                         @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group divprod col-md-4" style="display: inline-block" id="divprod">
                                
                                    </div>
                                    <div class="form-group">
                                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Nombre</th>
                                                <th scope="col">Precio</th>
                                                <th colspan="3"></th>
                                            </tr>
                                            </thead>
                                            <tbody id="TbodyProductos">

                                            </tbody>
                                        </table>
                                    </div>
                                    <input type="hidden" id="j" name="j" value="0" />
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
 @section('script')
 <script src="{{ asset('js/servicio/paquete.js') }}" defer></script>

 @endsection