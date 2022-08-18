<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    //
    protected $fillable = [
        'user_id','Fecha','Direccion','reserva_id','Total',
    ];
}
