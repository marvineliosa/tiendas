<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelDatosRemisionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('REL_DATOS_REMISION', function (Blueprint $table) {
            $table->unsignedInteger('REL_REMISION_FK_VENTA');
            $table->foreign('REL_REMISION_FK_VENTA')->references('VENTAS_ID')->on('TIENDAS_VENTAS')->onDelete('cascade')->onUpdate('cascade');//*/

            $table->string('REL_DATOS_NOMBRE')->nullable();
            $table->string('REL_DATOS_CORREO')->nullable();
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
        Schema::dropIfExists('REL_DATOS_REMISION');
    }
}
