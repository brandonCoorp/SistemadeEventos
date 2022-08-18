<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detalle_reserva extends Model
{
    //
    protected $fillable = [
        'Precio','cantidad','Total','reserva_id','producto_id','paquete_id',
    ];
}
