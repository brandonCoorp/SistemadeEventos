<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Servicio;
use App\Categoria;
use App\Paquete;

class ServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $servicios = Servicio::orderby('id','Desc')->paginate(3);
        return view('servicio.index',compact('servicios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('servicio.create');
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
        $request->validate([
            'Nombre'=>'required|max:50|unique:servicios,nombre',
            'Descripcion'=>'required|max:250',
            'Imagen'=>'required|mimes:jpg,jpeg,bmp,png',
            ]);
             $prod =Servicio::orderby('id','desc')->first();
            if($prod)
            {
                $servi = $prod->id + 1;
            }else{
               $servi=1; 
            }
            if($request->hasfile('Imagen')){
                $image=$request->file('Imagen');
                $nombre ='marilizie'.'Prod'.$servi;
                           
                $ruta=public_path().'/assets/servicio/';
              
                $image-> move($ruta,$nombre);
             $url ='assets/servicio/'.$nombre;
            }     
  
            Servicio::create([
                'Nombre'=>$request->input('Nombre'),
                'Descripcion' => $request->input('Descripcion'),
                'Imagen' =>$url,
            ]);
            return redirect()->route('servicio.index')->with('status_success','Servicio Creado con Exito'); 
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
       $servicio= Servicio::findorfail($id);
        return view('servicio.edit',compact('servicio'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Servicio $servicio)
    {
        //
        $request->validate([
            'Nombre'=>'required|max:50|unique:servicios,nombre,'.$servicio->id,
            'Descripcion'=>'required|max:250',
            
            ]);
            
            if($request->hasfile('Imagen')){
                $image=$request->file('Imagen');
                $nombre ='marilizie'.'Prod'.$servicio->id;
                           
                $ruta=public_path().'/assets/servicio/';
                $image_path=public_path().'/'.$servicio->Imagen;
                unlink($image_path);
                $image-> move($ruta,$nombre);
                $url ='assets/servicio/'.$nombre;
               
                $servicio->update([
                    'Nombre'=>$request->input('Nombre'),
                    'Descripcion' => $request->input('Descripcion'),
                    'Imagen' =>$url,    
            ]);
            }    

            $servicio->update([
                    'Nombre'=>$request->input('Nombre'),
                    'Descripcion' => $request->input('Descripcion'),   
            ]);
            return redirect()->route('servicio.index')->with('status_success','Servicio Modificado con Exito');      

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Servicio $servicio)
    {
        //
        $servicio->delete();
        return redirect()->route('servicio.index')->with('status_success','Servicio Eliminado con Exito');      

    }
    public function catalogo($id)
    {
        //
        $servicio =Servicio::find($id);
      
    //dd($servicio);
    $servicios = Servicio::get();
    $categorias= Categoria::get();
    $paquetes = Paquete::where('servicio_id','1')->get();
    //dd($categorias);
    return view('servicio.servicioSelec',compact('categorias','servicios','paquetes'));
  
    //return view('servicio.servicioSelec',compact('servicio'));
    }
    public function getservicio($id)
    {
        //
        $servicio = Servicio::find($id);
        return $servicio;
    }
}
