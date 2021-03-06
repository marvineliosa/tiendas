<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelPagoTransferenciaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('REL_PAGO_TRANSFERENCIA', function (Blueprint $table) {
            $table->unsignedInteger('PAGO_TRANSFERENCIA_FK_VENTA');
            $table->foreign('PAGO_TRANSFERENCIA_FK_VENTA')->references('VENTAS_ID')->on('TIENDAS_VENTAS')->onDelete('cascade')->onUpdate('cascade');//*/
            $table->string('PAGO_TRANSFERENCIA_OPERACION');
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
        Schema::dropIfExists('REL_PAGO_TRANSFERENCIA');
    }
}
