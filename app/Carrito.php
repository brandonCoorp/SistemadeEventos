<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    //
     protected $fillable = [
        'Estado','Total','user_id','servicio_id',
    ];
    public function seleccionas(){
        return $this->belongsToMany('App\Producto','Cantidad')->withTimesTamps();
    }
}
