<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/productos/get/{id}','ProductoController@getproductoCategoria');
Route::get('/servicio/get/{id}','ServicioController@getservicio');
Route::get('/paquete/get/{id}','PaqueteController@getpaquete');
Route::get('/carritoAñadir/get/{id}/{userid}','CarritoController@getcarritoAñadirPaquete');
Route::get('/carritoAñadirProd/get/{id}/{userid}/{cant}','CarritoController@getcarritoAñadirProducto');

Route::get('/producto/get/{id}','ProductoController@getproducto');
Route::get('/productosEmpresa/get/{id}','ProductoController@getproductoEmpresa');

Route::get('/Serviciopaquetes/get/{id}/{userid}','PaqueteController@getpaqueteServicio');
Route::get('/Servicioproductos/get/{id}','ProductoController@getproductoServicio');
