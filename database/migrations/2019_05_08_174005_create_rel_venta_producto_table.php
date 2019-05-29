<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelVentaProductoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('REL_VENTA_PRODUCTO', function (Blueprint $table) {
            $table->unsignedInteger('REL_VENTA_FK_VENTA');
            $table->foreign('REL_VENTA_FK_VENTA')->references('VENTAS_ID')->on('TIENDAS_VENTAS')->onDelete('cascade')->onUpdate('cascade');//*/

            $table->unsignedInteger('REL_VENTA_FK_PROCUTO');
            $table->foreign('REL_VENTA_FK_PROCUTO')->references('PRODUCTOS_ID')->on('TIENDAS_PRODUCTOS')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedInteger('REL_VENTA_FK_ESPACIO');
            $table->foreign('REL_VENTA_FK_ESPACIO')->references('ESPACIO_ID')->on('TIENDAS_ESPACIOS')->onDelete('cascade')->onUpdate('cascade');//*/

            $table->integer('REL_VENTA_CANTIDAD');
            $table->integer('REL_VENTA_CONSECUTIVO_DIARIO');

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
        Schema::dropIfExists('REL_VENTA_PRODUCTO');
    }
}
