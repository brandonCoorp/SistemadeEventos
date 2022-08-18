<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto_promocion extends Model
{
    //
    protected $fillable = [
        'promocion_id','producto_id','porcentaje',
    ];
}
