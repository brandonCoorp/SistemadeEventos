<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detalle_carrito extends Model
{
    //
    protected $fillable = [
        'Precio','cantidad','Total','carrito_id','producto_id','paquete_id',
    ];
    
}
