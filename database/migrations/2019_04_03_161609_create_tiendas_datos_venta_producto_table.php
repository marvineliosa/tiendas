<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTiendasDatosVentaProductoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TIENDAS_DATOS_VENTA_PRODUCTO', function (Blueprint $table) {
            $table->unsignedInteger('DATOS_VENTA_FK_PROCUTO');
            $table->foreign('DATOS_VENTA_FK_PROCUTO')->references('PRODUCTOS_ID')->on('TIENDAS_PRODUCTOS')->onDelete('cascade')->onUpdate('cascade');
            $table->float('DATOS_VENTA_PRECIO')->nullable();
            $table->integer('DATOS_VENTA_DESCUENTO')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TIENDAS_DATOS_VENTA_PRODUCTO');
    }
}
