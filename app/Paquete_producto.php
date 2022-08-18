<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paquete_producto extends Model
{
    //
    protected $fillable = [
        'estado','cantidad','paquete_id','producto_id'
    ];
}