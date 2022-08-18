<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    //
     protected $fillable = [
        'Ci','Fecha_pedido','Fecha_entrega','Direccion','forma_pago_id','Monto',
    ];
}
