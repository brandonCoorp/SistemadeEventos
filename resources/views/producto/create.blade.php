@extends('layouts.appAdmi')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h2>{{ __('Crear Producto') }}</h2></div>

                <div class="card-body">
                  @include('Custom.mensaje')

                    <form action="{{route('producto.store')}}" method="POST" enctype="multipart/form-data">
                      @csrf
                     <div class="containner">
                       <h3>Requisito de Datos</h3>

                      <div class="form-group">
                        <label for="Nombre">Nombre</label>
                        <input type="text" class="form-control"
                         value="{{old('Nombre')}}" name="Nombre" id="Nombre" placeholder="Nombre">
                      </div>

                      <div class="form-group">
                        <label for="Descripcion">Descripcion</label>
                        <input type="text" class="form-control"
                         value="{{old('Descripcion')}}" name="Descripcion" id="Descripcion" placeholder="Descripcion">
                      </div>

                      <div class="form-group">
                        <label for="Precio">Precio Unitario</label>
                        <input type="text" class="form-control"
                         value="{{old('Precio')}}" name="Precio" id="Precio" placeholder="Precio">
                      </div>
                      <div class="form-group">
                        <label for="Cantidad">Cantidad</label>
                        <input type="number" class="form-control"
                         value="{{old('Cantidad')}}" name="Cantidad" id="Cantidad" >
                      </div>
      
                      <div class="form-group col-md-4" style="display: inline-block">
                        <label for="">Empresa :</label>
                            <select class="form-control" name="empresa_id">
                              @foreach($empresas as $value)
                                <option value="{{ $value->id }}"->{{ $value->Nombre }}</option>
                              @endforeach
                            </select>
                      </div>
                      <div class="form-group col-md-4" style="display: inline-block">
                        <label for="">Categoria</label>
                            <select class="form-control" name="categoria_id">
                              @foreach($categorias as $value)
                                <option value="{{ $value->id }}"->{{ $value->nombre }}</option>
                              @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-8" style="display: inline-block">
                          <label for="">servicios donde estara disponibles su producto</label>
                              <select class="form-control" id="selectservicio" name="selectservicio">
                            
                                @foreach($servicios as $value)
                                  <option value="{{ $value->id }}"->{{ $value->Nombre }}</option>
                                @endforeach
                              </select>
                          </div>
                          <div class="form-group" >
                            <label for="">Imagen</label>
                            <input type="file" name="Imagen" value="" class="form-control-file">
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
 <script src="{{ asset('js/servicio/productoPromo.js') }}" defer></script>

 @endsection
