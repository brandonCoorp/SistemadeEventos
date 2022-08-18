<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductoPromocionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producto_promocions', function (Blueprint $table) {
            $table->id();
            $table->integer('porcentaje');
            $table->foreignId('promocion_id')->constrained('promocions')->onDelete('cascade');
            $table->foreignId('producto_id')->constrained('productos')->onDelete('cascade');       
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
        Schema::dropIfExists('producto_promocions');
    }
}
