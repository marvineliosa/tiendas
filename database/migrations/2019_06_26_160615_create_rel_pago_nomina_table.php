<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelPagoNominaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('REL_PAGO_NOMINA', function (Blueprint $table) {
            $table->unsignedInteger('PAGO_NOMINA_FK_VENTA');
            $table->foreign('PAGO_NOMINA_FK_VENTA')->references('VENTAS_ID')->on('TIENDAS_VENTAS')->onDelete('cascade')->onUpdate('cascade');//*/
            $table->string('PAGO_NOMINA_ID_TRAB');
            $table->string('PAGO_NOMINA_NOMBRE_TRAB');
            $table->string('PAGO_NOMINA_QUINCENAS_TRAB');
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
        Schema::dropIfExists('REL_PAGO_NOMINA');
    }
}
