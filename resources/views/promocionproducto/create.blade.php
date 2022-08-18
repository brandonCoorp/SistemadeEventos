@extends('layouts.appAdmi')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h2>{{ __('Crear Promocion Producto') }}</h2></div>

                <div class="card-body">
                  @include('Custom.mensaje')

                    <form action="{{route('promocionproducto.store')}}" method="POST">
                      @csrf
                          <div class="containner">
                             <h3>Requisito de Datos</h3>
                             <div class="form-group">
                                 <label for="nombre">Nombre</label>
                                 <input type="text" class="form-control"
                                  value="{{old('Nombre')}}" name="Nombre" id="Nombre" placeholder="nombre">
                             </div>
                             <div class="form-group"> 
                                  <textarea class="form-control" id="Descripcion"
                                  name="Descripcion" placeholder="descripcion"
                                  rows="3">{{old('Descripcion')}}</textarea>
                             </div>  
                             <div class="form-group">
                                <label for="Porcentaje">Porcentaje %</label>
                                <input type="text" class="form-control"
                                 value="{{old('Porcentaje')}}" name="Porcentaje" id="Porcentaje" placeholder="0">
                            </div>
                            <div class="form-group col-md-4" style="display: inline-block">
                                <label for="empresa">empresa : </label>  
                                <select  class="form-control"name="empresa" id="empresa"> 
                                  @foreach ($empresas as $empresa)
                                     <option value="{{$empresa->id}}">{{$empresa->Nombre}}</option>
                                 @endforeach
                                </select>
                            </div>
                            <div class="form-group divprod col-md-4" style="display: inline-block" id="divprod">
                                
                            </div> 
                             <div class="form-group"> 
                                  <input type="date" class="form-control"
                                   value="{{old('Fecha_inicio')}}" name="Fecha_inicio" id="Fecha_inicio" >
                              </div>
                              <div class="form-group"> 
                                   <input type="date" class="form-control"
                                    value="{{old('Fecha_fin')}}" name="Fecha_fin" id="Fecha_fin">
                              </div>                    
                         <div class="form-group">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nombre</th>
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