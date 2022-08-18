<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    //
      protected $fillable = [
        'Fecha_Reserva','Estado','Monto','pedido_id',
    ];
}
