<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Carrito;
use App\Detalle_carrito;
use App\Paquete;
use App\Producto;
use App\Categoria;
use App\Servicio;
use App\User;
use App\Persona;
use App\Paquete_producto;
use App\Pedido;
use App\Reserva;
use App\Factura;

use App\Detalle_Pedido;
use App\Detalle_reserva;
use App\Detalle_factura;

use App\Mail\facturacorreo;
use Illuminate\Support\Facades\Mail;
//use Mail;
use PDF;
class CarritoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $productos = Producto::get();
        $servicios = Servicio::get();
        $categorias = Categoria::get();
        $user = auth()->user()->id;
        $users = User::find($user);
        $persona = Persona::select('*')->where('Ci',$users->Ci)->first();

   $carrito = Carrito::select('*')->where('user_id',$user)->first();
   $detallecarrito = Detalle_carrito::select('*')->where('carrito_id',$carrito->id )->get();

$c1 =0;
$c2=0;
$totales =0;
$dproductos[]=null;
$paquetes[]=null;
foreach ($detallecarrito as $key => $value) {
      if($value->paquete_id == 0){
        
          $dproductos[]=$value;
          $c1=1;
          $totales =$totales + $value->Total;
      }else{
          $paquetes[]=Paquete::find($value->paquete_id);
          $c2=1;
          $totales =$totales + $value->Total;
      }
}
unset($dproductos[0]);
  unset($paquetes[0]);
          $paqueteprod = Paquete_producto::get();
  //dd($paquetes);
        return view('carrito.detalle',compact('productos','servicios','categorias','users','persona','dproductos','paquetes','paqueteprod','totales'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'Fecha_inicio'=>'required',
            'payment'=>'required',
            ]);
            $direccion ="";
            if ($request->input('address')==null) {
                $direccion = $request->input('Direccion');
            }else{
                $direccion = $request->input('address')    ;
            }

     $pedido=  Pedido::create([
        'Ci'=>auth()->user()->Ci,
        'Fecha_pedido'=>date('Y-m-d'),
        'Fecha_entrega'=>$request->input('Fecha_inicio'),
        'Direccion'=>$direccion,
        'Monto'=>$request->input('total'),
        'forma_pago_id'=>$request->input('payment'),
       ]);

       //reserva estado 1 en espera 2 entregado 3 finalizado 4 rechazado
     $reserva=  Reserva::create([
        'Estado'=>1,
        'Fecha_Reserva'=>$request->input('Fecha_inicio'),
        'Monto'=>$request->input('total'),
        'pedido_id'=>$pedido->id,
       ]);

       $factura=Factura::create([
        'user_id'=>auth()->user()->id,
        'Fecha'=>$request->input('Fecha_inicio'),
        'Total'=>$request->input('total'),
        'Direccion'=>$direccion,
        'reserva_id'=>$reserva->id,
       ]);

       $carrito = Carrito::select('*')->where('user_id',auth()->user()->id)->get();
       $detallecarrito = Detalle_carrito::select('*')->where('carrito_id',$carrito[0]->id)->get();
        foreach ($detallecarrito as $key => $value) {
            # code...
            if($value->paquete_id == 0){  //si entra es producto                          
            Detalle_reserva::create([
            'Precio'=>$value->Precio,
            'cantidad'=>$value->cantidad,
            'Total'=>$value->Total,
            'reserva_id'=>$reserva->id,
            'producto_id'=>$value->producto_id,
            'paquete_id'=>0,
              ]);    
              Detalle_factura::create([
                'Nombre'=>auth()->user()->name,
                'Precio'=>$value->Precio,
                'cantidad'=>$value->cantidad,
                'Total'=>$value->Total,
                'factura_id'=>$factura->id,
                'producto_id'=>$value->producto_id,
                'paquete_id'=>0,
                  ]);   
              
            }else{    //aca es paquete
                Detalle_reserva::create([
                    'Precio'=>$value->Precio,
                    'cantidad'=>$value->cantidad,
                    'Total'=>$value->Total,
                    'reserva_id'=>$reserva->id,
                    'producto_id'=>0,
                    'paquete_id'=>$value->paquete_id,
                      ]);    
                      Detalle_factura::create([
                        'Nombre'=>auth()->user()->name,
                        'Precio'=>$value->Precio,
                        'cantidad'=>$value->cantidad,
                        'Total'=>$value->Total,
                        'factura_id'=>$factura->id,
                        'producto_id'=>0,
                        'paquete_id'=>$value->paquete_id,
                          ]);   
            }
        }
       ///enviar correo
//       dd(auth()->user()->email);
       Mail::to(auth()->user()->email)->send(new facturacorreo(auth()->user()->id,$factura->id));
  //dd($factura->id);
  //$carrito->delete();
  Carrito::destroy($carrito[0]->id);
        return redirect()->route('home'); 
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
    }
    public function getcarritoAñadirPaquete($id, $user_id)
    {
        //
     $carrito = Carrito::select('id')->where('user_id',$user_id)->get();
     $paquete = Paquete::find($id);
        Detalle_carrito::create([
            'Precio'=>$paquete->Total,
            'cantidad'=>1,
            'Total'=>$paquete->Total,
            'carrito_id'=>$carrito[0]->id,
            'producto_id'=>0,
            'paquete_id'=>$paquete->id,

        ]);
    return $paquete ;
    }
    public function getcarritoAñadirProducto($id, $user_id, $cant)
    {
        //
       
     $carrito = Carrito::select('id')->where('user_id',$user_id)->get();
     $producto = Producto::find($id);
     //dd($cant);
     $total = $producto->Precio * $cant;
        Detalle_carrito::create([
            'Precio'=>$producto->Precio,
            'cantidad'=>$cant,
            'Total'=>$total,
            'carrito_id'=>$carrito[0]->id,
            'paquete_id'=>0,
            'producto_id'=>$producto->id,

        ]);
    return $producto;
    }

    public function factura($usuario,$venta){
        $dfactura= Detalle_factura::where('factura_id',$venta)->get();
       $factura = Factura::find($venta); 
       $persona = User::Find($usuario);
      $productos = Producto::get();
$c1 =0;
$c2=0;
$totales =$factura->Total;
$dproductos[]=null;
$paquetes[]=null;
foreach ($dfactura as $key => $value) {
      if($value->paquete_id == 0){        
          $dproductos[]=$value;
          $c1=1;
      }else{
          $paquetes[]=Paquete::find($value->paquete_id);
          $c2=1;      
      }
}
unset($dproductos[0]);
  unset($paquetes[0]);
          $paqueteprod = Paquete_producto::get();     
   
        $pdf = PDF::loadView('mail.factura',['factura'=> $factura,'productos'=> $productos,'persona'=> $persona,'dproductos'=> $dproductos,'paquetes'=> $paquetes,'paqueteprod'=> $paqueteprod,'totales'=> $totales]);
        return $pdf->stream();
    }

}
