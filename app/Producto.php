<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    //
 protected $fillable = [
        'Nombre','Descripcion', 'Precio','Cantidad', 'Estado','Imagen',
        'categoria_id','empresa_id',
    ];
    public function seleccionas(){
        return $this->belongsToMany('App\Carrito','Cantidad')->withTimesTamps();
    } 
}
           