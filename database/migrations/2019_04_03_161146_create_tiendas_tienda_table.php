<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTiendasTiendaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TIENDAS_ESPACIOS', function (Blueprint $table) {
            $table->increments('ESPACIO_ID');
            $table->string('ESPACIO_NOMBRE');
            $table->string('ESPACIO_UBICACION');
            $table->string('ESPACIO_SIGLAS');
            $table->enum('ESPACIO_TIPO',['BODEGA','TIENDA']);
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
        Schema::dropIfExists('TIENDAS_ESPACIOS');
    }
}
