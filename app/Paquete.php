<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paquete extends Model
{
    //
    protected $fillable = [
        'Nombre','Descripcion','servicio_id','Imagen','Total',
    ];
}
