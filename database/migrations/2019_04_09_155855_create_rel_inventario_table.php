<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelInventarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('REL_INVENTARIO', function (Blueprint $table) {
            $table->unsignedInteger('DATOS_VENTA_FK_PROCUTO');
            $table->foreign('DATOS_VENTA_FK_PROCUTO')->references('PRODUCTOS_ID')->on('TIENDAS_PRODUCTOS')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedInteger('DATOS_VENTA_FK_ESPACIO');
            $table->foreign('DATOS_VENTA_FK_ESPACIO')->references('ESPACIO_ID')->on('TIENDAS_ESPACIOS')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('DATOS_VENTA_CANTIDAD');
            $table->integer('DATOS_VENTA_INVENTARIO_MINIMO')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('REL_INVENTARIO');
    }
}
