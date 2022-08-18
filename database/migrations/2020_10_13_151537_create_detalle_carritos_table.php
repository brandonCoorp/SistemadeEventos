<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleCarritosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_carritos', function (Blueprint $table) {
            $table->id();
            $table->float('Precio',10,2);
            $table->integer('cantidad');
            $table->float('Total',10,2);
            $table->foreignId('carrito_id')->constrained('carritos')->onDelete('cascade');
            $table->integer('producto_id');
            $table->integer('paquete_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_carritos');
    }
}
