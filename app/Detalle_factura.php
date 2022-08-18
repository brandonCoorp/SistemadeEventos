<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detalle_factura extends Model
{
    //
    protected $fillable = [
       'Nombre', 'Precio','cantidad','Total','factura_id','producto_id','paquete_id',
    ];
} 
