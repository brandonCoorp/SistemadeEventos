<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paquete_promocion extends Model
{
    //
    protected $fillable = [
        'promocion_id','paquete_id','porcentaje',
    ];
}