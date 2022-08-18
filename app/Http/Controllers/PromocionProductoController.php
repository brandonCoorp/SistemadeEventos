<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Promocion;
use App\Producto;
use App\Producto_promocion;
use App\Empresa;
use App\permisos\Model\Permiso;
use Illuminate\Support\Facades\Gate;
class PromocionProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        Gate::authorize('tieneacceso','promocion.index');
   //   $promocionss = Promocion::orderby('id','Desc')->paginate(2);
      $promoid = Producto_promocion::select('promocion_id')->get();
   $promocions=Promocion::find($promoid);
   //$promo::orderby('id','Desc');
  // $promo->paginate(2);
   //dd($promo);
 
     return view('promocionproducto.index',compact('promocions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        Gate::authorize('tieneacceso','promocion.create');
        $productos=Producto::get();
        $empresas =Empresa::get();
        return view('promocionproducto.create',compact('empresas'));
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
            'Nombre'=>'required|max:100|unique:promocions,Nombre',
            'Descripcion'=>'required',
            'Fecha_inicio'=>'required',
            'Fecha_fin'=>'required',
            'Porcentaje'=>'required|integer',
            ]);
            
        $promo=Promocion::create($request->all());

        $j= $request->input("j");
        for ($i=1; $i <$j ; $i++) { 
          if($request->input('producto'.$i)){
              Producto_promocion::create([
                'porcentaje'=>$request->input('Porcentaje'),
                'promocion_id' =>$promo->id,
                'producto_id'=>$request->input('producto'.$i),
              ]);
               }
        }    
       return redirect()->route('promocionproducto.index')->with('status_success','Promocion Creada con Exito');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Promocion $promocion)
    {
        //
        $this->authorize('tieneacceso','promocion.show');
        return view('promocion.view', compact('promocion'));
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
        $this->authorize('tieneacceso','promocion.edit');
        $promocion=Promocion::findorfail($id);
        return view('promocion.edit',compact('promocion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Promocion $promocion)
    {
        //
        $request->validate([
            'Nombre'=>'required|max:100|unique:promocions,Nombre,'.$promocion->id,
            'Descripcion'=>'required',
            'Fecha_inicio'=>'required',
            'Fecha_fin'=>'required',
            'Porcentaje'=>'required|integer',
            ]);
            $promocion->update($request->all());
    return redirect()->route('promocion.index')->with('status_success','Promocion Modificada con Exito');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Promocion $promocion)
    {
        //
        $this->authorize('tieneacceso','promocion.destroy');
        $promocion->delete();
        return redirect()->route('promocionproducto.index')->with('status_success','Promocion Eliminada con Exito');

    }
  
}
