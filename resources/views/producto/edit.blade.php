@extends('layouts.appAdmi')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h2>{{ __('Editar Producto') }}</h2></div>

                <div class="card-body">
                  @include('Custom.mensaje')

                    <form action="{{route('producto.update', $producto->id)}}" method="POST" enctype="multipart/form-data">
                      @csrf
                      @method('PUT')
                    <div class="containner">
                       <h3>Requisito de Datos</h3>

                      <div class="form-group">
                        <label for="Nombre">Nombre</label>
                        <input type="text" class="form-control"
                         value="{{old('Nombre', $producto->Nombre)}}" name="Nombre" id="Nombre" placeholder="Nombre">
                      </div>

                      <div class="form-group">
                        <label for="Descripcion">Descripcion</label>
                        <input type="text" class="form-control"
                         value="{{old('Descripcion', $producto->Descripcion)}}" name="Descripcion" id="Descripcion" placeholder="Descripcion">
                      </div>

                      <div class="form-group">
                        <label for="Precio">Precio</label>
                        <input type="text" class="form-control"
                         value="{{old('Precio', $producto->Precio)}}" name="Precio" id="Precio" placeholder="Precio">
                      </div>

                      <div class="form-group">
                        <label for="Cantidad">Cantidad</label>
                        <input type="text" class="form-control"
                         value="{{old('Cantidad', $producto->Cantidad)}}" name="Cantidad" id="Cantidad" >
                      </div>

                      <div class="form-group col-md-4" style="display: inline-block">
                        <label for="nombre">Categoria : </label>
                            <select name="categoria_id"class="form-control" id="categorias">
                              @foreach ($categorias as $categoria)
                                 <option value="{{$categoria->id}}"
                                      @if ($categoria->id == $producto->categoria_id)
                                          selected
                                      @endif
                                  >{{$categoria->nombre}}</option>
                             @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-4" style="display: inline-block">
                          <label for="Empresa">Empresa : </label>
                              <select class="form-control" name="empresa_id" id="Empresa">
                                @foreach ($empresas as $empresa)
                                   <option value="{{$empresa->id}}"
                                        @if ($empresa->id == $producto->empresa_id)
                                            selected
                                        @endif
                                    >{{$empresa->Nombre}}</option>
                               @endforeach
                              </select>
                          </div>
                          <div class="form-group">
                          <img src="{{asset($producto->Imagen)}}" style="width: 100px; height : 70px;" alt="">
                            <label for="Imagen">Cambiar Imagen</label>
                            <input type="file" class="form-control-file"
                              name="Imagen" id="Imagen" >
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
