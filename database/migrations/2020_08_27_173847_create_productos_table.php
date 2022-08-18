<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
              $table->string('Nombre');
            $table->string('Descripcion');
            $table->double('Precio');
            $table->integer('Estado');
            $table->integer('Cantidad');
            $table->string('Imagen');
            $table->foreignId('categoria_id')->constrained('categorias')->onDelete('cascade'); 
            $table->foreignId('empresa_id')->constrained('empresas')->onDelete('cascade'); 
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
        Schema::dropIfExists('productos');
    }
}
