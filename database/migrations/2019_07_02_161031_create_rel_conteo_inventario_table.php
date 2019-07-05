<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelConteoInventarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('REL_CONTEO_INVENTARIO', function (Blueprint $table) {
            $table->unsignedInteger('CONTEO_FK_PROCUTO');
            $table->foreign('CONTEO_FK_PROCUTO')->references('PRODUCTOS_ID')->on('TIENDAS_PRODUCTOS')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedInteger('CONTEO_FK_ESPACIO');
            $table->foreign('CONTEO_FK_ESPACIO')->references('ESPACIO_ID')->on('TIENDAS_ESPACIOS')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('CONTEO_CANTIDAD');
            
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
        Schema::dropIfExists('REL_CONTEO_INVENTARIO');
    }
}
