<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelPagoMixtoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('REL_PAGO_MIXTO', function (Blueprint $table) {
            $table->unsignedInteger('PAGO_MIXTO_FK_VENTA');
            $table->foreign('PAGO_MIXTO_FK_VENTA')->references('VENTAS_ID')->on('TIENDAS_VENTAS')->onDelete('cascade')->onUpdate('cascade');//*/

            $table->float('PAGO_MIXTO_EFECTIVO');
            $table->float('PAGO_MIXTO_CREDITO');
            $table->float('PAGO_MIXTO_DEBITO');
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
        Schema::dropIfExists('REL_PAGO_MIXTO');
    }
}
