<?php

use Illuminate\Support\Facades\Route;
use App\User;
use App\permisos\Model\Rol;
use App\permisos\Model\Permiso;
use Illuminate\Support\Facades\Gate;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('user.login');
});

Auth::routes();
Route::post('/','LoginController@login')->name('logine');
Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/rol', 'RolController')->names('rol');
Route::resource('/categoria', 'CategoriaController')->names('categoria');
Route::resource('/promocion', 'PromocionController')->names('promocion');
Route::resource('/promocionProducto', 'PromocionProductoController')->names('promocionproducto');
Route::resource('/carrito', 'CarritoController')->names('carrito');

Route::resource('/empresa', 'EmpresaController')->names('empresa');
Route::resource('/paquete', 'PaqueteController')->names('paquete');
Route::resource('/producto', 'ProductoController')->names('producto');

Route::resource('/servicio','ServicioController')->names('servicio');
Route::get('/servicio/{id}/catalogo', 'ServicioController@catalogo')->name('catalogos');

Route::resource('/user', 'UserController',['except'=>['create','store']])->names('user');

Route::get('/factura/{user}/{venta}','CarritoController@factura')->name('factura');

Route::get('/test', function () {
  $user = User::find(2);
  //$user->roles()->sync([2]);
  Gate::authorize('tieneacceso','rol.destroy');
 //return $user;
 //  return $user->tienePermisos('rol.show');
});

///paypal//////////
Route::get('/paypal/pay', 'PaymentController@payWithPayPal')->name('paypal');
Route::get('/paypal/status', 'PaymentController@payPalStatus');


///otro paypal//
Route::get('payment', 'PaymentController@index');
Route::post('charge', 'PaymentController@charge');
Route::get('paymentsuccess', 'PaymentController@payment_success');
Route::get('paymenterror', 'PaymentController@payment_error');