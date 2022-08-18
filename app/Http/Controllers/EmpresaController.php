<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empresa;
use App\Producto;
use App\Empresa_producto;
use Illuminate\Support\Facades\Gate;
class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    $empresas= Empresa::orderby('id','Asc')->paginate(2);
        return view('empresa.index',compact('empresas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('empresa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        
        Gate::authorize('tieneacceso','promocion.create');
        $request->validate([
            'Nombre'=>'required|max:100|unique:empresas,Nombre',
            'Nit'=>'required|integer',
            'Direccion'=>'required',
            'Telefono'=>'required|integer',
            'Correo'=>'required|email',
            ]);
       Empresa::create($request->all());
      return redirect()->route('empresa.index')->with('status_success','Empresa Creada con Exito');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $empresa =Empresa::findorfail($id);
        
       
      return view('empresa.view',compact('empresa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $this->authorize('tieneacceso','empresa.edit');
        $empresa=Empresa::findorfail($id);
        return view('empresa.edit',compact('empresa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Empresa $empresa)
    {
        //
        Gate::authorize('tieneacceso','empresa.create');
        $request->validate([
            'Nombre'=>'required|max:100|unique:empresas,Nombre',
            'Nit'=>'required|integer',
            'Direccion'=>'required',
            'Telefono'=>'required|integer',
            'Correo'=>'required|email',
            ]);
       $empresa->update($request->all());
      return redirect()->route('empresa.index')->with('status_success','Empresa Modificada con Exito');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empresa $empresa)
    {
        //
        Gate::authorize('tieneacceso','empresa.destroy');
        $empresa_prod = Empresa_producto::get();
        foreach ($empresa_prod as $key => $value) {
            if($empresa->id==$value->empresa_id){
               $prod_id = $value->producto_id;
                $value->delete();
                $producto= Empresa_producto::where('producto_id',$prod_id)->first();
                if (!$producto){
                     $produ =Producto::find($prod_id);
                     $produ->delete();
                }
            }
        }
        $empresa->delete();
      return redirect()->route('empresa.index')->with('status_success','Empresa Eliminada con Exito');
   
    }
}
