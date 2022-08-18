<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Paquete;
use App\Servicio;
use App\Producto;
use App\Categoria;
use App\Paquete_producto;
use App\Carrito;
class PaqueteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        //
        $paquetes =Paquete::orderby('id','Desc')->paginate(2);
        $servicios = Servicio::get();
        return view('paquete.index',compact('paquetes','servicios'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        //
      //  dd(auth()->user()->id);
        $servicios= Servicio::get();
        $productos = Producto::get();
        $categorias = Categoria::get();
        return view('paquete.create', compact('servicios','productos','categorias'));

        //return view('paquete.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

        $request->validate([
            'Nombre'=>'required|max:50|unique:paquetes,Nombre',
            'Descripcion'=>'required|max:250',
            'servicio_id'=>'required',
            'Imagen'=>'image|mimes:jpeg,png,jpg',
        ]);
        $servi =Servicio::find($request->input('servicio_id')) ;
        $num =Paquete::orderby('id','desc')->first();
        if($num){$nume= $num->id +1;}else{$nume= 1;}
        if($request->hasFile('Imagen')){
            $image=$request->file('Imagen');
            $nombre = 'paquete'.$servi->Nombre.$nume;
            $ruta=public_path().'/assets/paquete/';

            $image->move($ruta,$nombre);
            $url = 'assets/paquete/'.$nombre;
            $paquete= Paquete::create([
                'Nombre'=>$request->input('Nombre'),
                'Descripcion'=>$request->input('Descripcion'),
                'servicio_id'=>$request->input('servicio_id'),
                'Imagen'=>$url,
                'Total'=>0,
               ]);
               
        }

            //dd($request->all());
        $j= $request->input("j");
        $paquete_producto=Paquete_producto::get();
        $total =0;
        for ($i=1; $i <$j ; $i++) { 
          if($request->input('producto'.$i)){
          $prod = Producto::find($request->input('producto'.$i));
           $tot =$prod->Precio *$request->input('Cantidad'.$i);
          $total = $total + $tot;
           Paquete_producto::create([
                'estado'=>1,
                'cantidad'=>$request->input('Cantidad'.$i),
                'paquete_id'=>$paquete->id,
                'producto_id'=>$request->input('producto'.$i),
              ]);
               }
        }   
        $paquete->update([
            'Total'=>$total,
        ]);  
    return redirect()->route('paquete.index')->with('status_success','Paquete Creado con Exito');
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
        $this->authorize('tieneacceso','rol.edit');
        $paquete =Paquete::find($id);
       $servicios =Servicio::get();
        return view('paquete.edit', compact('paquete','servicios'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->authorize('tieneacceso','paquete.edit');
        $request->validate([
            'Nombre'=>'required|max:50|unique:paquetes,Nombre,'.$id,
            'Descripcion'=>'required|max:250',
            'servicio_id'=>'required',
            
        ]);
        $paquetes =Paquete::find($id);
        $paquetes->update($request->all());
        return redirect()->route('paquete.index')->with('status_success','Paquete Modificado con Exito');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $this->authorize('tieneacceso','paquete.destroy');
        $paquete= Paquete::find($id);
        $paquete_producto = Paquete_producto::get();
        foreach ($paquete_producto as $key => $value) {
            if($value->paquete_id == $paquete->id){
                $value->delete();
            }
        }
        $paquete->delete();
        return redirect()->route('paquete.index')->with('status_success','Paquete Eliminado con Exito');

    }

    public function getpaqueteServicio($id, $user_id)
    {
        $paquetes=Paquete::select('*')->where('servicio_id',$id)->get();
        $carrito = Carrito::select('id')->where('user_id',$user_id)->get();
        if(sizeof($carrito)>0){
        Carrito::destroy($carrito[0]->id);
         }
          Carrito::create([
              'Estado'=>1,
              'Total'=>0,
              'user_id'=>$user_id,
              'servicio_id'=>1,
          ]);  
        return $paquetes;
    }
    public function getpaquete($id)
    {
        //
        $paquete = Paquete::find($id);
        return $paquete;
    }
}
