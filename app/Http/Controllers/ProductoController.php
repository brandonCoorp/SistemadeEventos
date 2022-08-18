<?php

namespace App\Http\Controllers;

use App\Producto;
use App\Servicio;
use App\Categoria;
use App\Empresa;
use App\Producto_servicio;

use Illuminate\Http\Request;


class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $productos = Producto::orderBy('id', 'DESC')->paginate(2);
        return view('producto.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categorias = Categoria::all();
        $empresas = Empresa::all();
        $servicios = Servicio::all();
        return view('producto.create', compact('categorias','empresas','servicios'));
    }

    /*public function save(Request $request){
        $input = $request>all();
        Producto::create($input);
        return redirect('/productos.in');
    }*/
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'Nombre'=>'required|max:50|unique:productos,nombre',
            'Descripcion'=>'required|max:250',
            'Imagen'=>'image|mimes:jpeg,png,jpg',
            'Cantidad'=>'required|max:250',
            
            ]);
              
            $categ =Categoria::find($request->input('categoria_id')) ;
            $num =Producto::orderby('id','desc')->first();
            $empresa =Empresa::find($request->input('empresa_id'));
          
            if($num){$nume= $num->id +1;}else{$nume= 1;}
            if($request->hasFile('Imagen')){
                $image=$request->file('Imagen');
                $nombre = $empresa->Nombre.$categ->nombre.$nume;
                $ruta=public_path().'/assets/producto/';

                $image->move($ruta,$nombre);
                $url = 'assets/producto/'.$nombre;
            $producto=    Producto::create([
                    'Nombre'=>$request->input('Nombre'),
                    'Descripcion'=>$request->input('Descripcion'),
                    'Precio'=>$request->input('Precio'),
                    'Imagen'=>$url,
                    'Estado'=>1,
                    'Cantidad'=>$request->input('Cantidad'),
                    'empresa_id'=>$request->input('empresa_id'),
                    'categoria_id'=>$request->input('categoria_id'),
                ]);
               
            }
            $j= $request->input("j");
            for ($i=1; $i <$j ; $i++) { 
              if($request->input('servicio'.$i)){
                  Producto_servicio::create([
                    'servicio_id' =>$request->input('servicio'.$i),
                    'producto_id'=>$producto->id,
                  ]);
                   }
            }    
            return redirect()->route('producto.index')->with('status-success','Producto Creado con Exito');
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
        $producto = Producto::findOrfail($id);
       $categorias = Categoria::get();
       $empresas = Empresa::get();
        return view('producto.edit', compact('producto','categorias','empresas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Producto $producto)
    {
        //
        $request->validate([
            'Nombre'=>'required|max:50|unique:productos,Nombre,'.$producto->id,
            'Descripcion'=>'required|max:250',
            'Imagen'=>'image|mimes:jpg,jpeg,bmp,png',
            'Cantidad'=>'required|max:250',
            ]);
            $categ =Categoria::find($request->input('categoria_id')) ;
            $num =Producto::orderby('id','desc')->first();
            $empresa =Empresa::find($request->input('empresa_id'));
          
            if($request->hasFile('Imagen')){
                $image=$request->file('Imagen');
                $nombre = $empresa->Nombre.$categ->nombre.$producto->id;

                $ruta=public_path().'/assets/producto/';
                $image_path=public_path().'/'.$producto->Imagen;
                unlink($image_path);
                $image->move($ruta,$nombre);
                $url = 'assets/producto/'.$nombre;

                $producto->update([
                    'Nombre'=>$request->input('Nombre'),
                    'Descripcion'=>$request->input('Descripcion'),
                    'Precio'=>$request->input('Precio'),
                    'Cantidad'=>$request->input('Cantidad'),
                    'Imagen'=>$url,
                    'empresa_id'=>$request->input('empresa_id'),
                    'categoria_id'=>$request->input('categoria_id'),
                ]);

            }
            $producto->update([
                'Nombre'=>$request->input('Nombre'),
                'Descripcion'=>$request->input('Descripcion'),
                'Precio'=>$request->input('Precio'),
                'Cantidad'=>$request->input('Cantidad'),
               
                'empresa_id'=>$request->input('empresa_id'),
                'categoria_id'=>$request->input('categoria_id'),
            ]);
            return redirect()->route('producto.index')->with('status-success','Producto Modificado con Exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto $producto)
    {
        //
        $image_path=public_path().'/'.$producto->Imagen;
        unlink($image_path);
        $producto->delete();
        return redirect()->route('producto.index')->with('status-success','Producto Eliminado con Exito');
    }
    public function getproductoCategoria($id)
    {
        //
        $producto = Producto::get();
        $productos[]=Producto::where('categoria_id',0)->first();
        foreach ($producto as $key => $value) {
            if($value->categoria_id==$id)
         $productos[]=$value;
        } 
        return $productos;
    }
    public function getproducto($id)
    {
        //
        $producto = Producto::find($id);
        return $producto;
    }
    public function getproductoEmpresa($id)
    {
        $productos=Producto::select('*')->where('empresa_id',$id)->get();
       
        return $productos;
    }
    public function getproductoServicio($id)
    {
        $prodId=Producto_servicio::select('producto_id')->where('servicio_id',$id)->get();
        $productos = Producto::find($prodId);
        return $productos;
    }
}
