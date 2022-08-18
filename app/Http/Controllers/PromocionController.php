<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Promocion;
use App\permisos\Model\Permiso;
use App\Paquete;
use App\Paquete_promocion;
use Illuminate\Support\Facades\Gate;
class PromocionController extends Controller
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
 //     $promocions = Promocion::orderby('id','Desc')->paginate(2);
      $promoid = Paquete_promocion::select('promocion_id')->get();
      $promocions=Promocion::find($promoid);
    
     return view('promocion.index',compact('promocions'));
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
     $paquetes=Paquete::get();
        return view('promocion.create',compact('paquetes'));
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
            'Paquete'=> 'required',
            ]);
        //dd($request->input('Paquete'));
        $promo=Promocion::create($request->all());
        Paquete_promocion::create([
            'porcentaje'=>$request->input('Porcentaje'),
            'paquete_id' => $request->input('Paquete'),
            'promocion_id' =>$promo->id,
        ]);
       return redirect()->route('promocion.index')->with('status_success','Promocion Creada con Exito');

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
        return redirect()->route('promocion.index')->with('status_success','Promocion Eliminada con Exito');

    }
  
}
