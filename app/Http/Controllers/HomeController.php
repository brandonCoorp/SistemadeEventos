<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\permisos\Model\Rol;
use App\User ;
use App\Categoria ;
use App\Servicio;
use App\Paquete;
use App\Carrito;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      //  return auth()->user()->id;
      $user = User::find(auth()->user()->id);     
      if($user->accesoTotal()){
          return view('home');
      }
      $servicios = Servicio::get();
      $categorias= Categoria::get();
      $paquetes = Paquete::get();

      return view('catalogo',compact('categorias','servicios','paquetes'));
    }
}
