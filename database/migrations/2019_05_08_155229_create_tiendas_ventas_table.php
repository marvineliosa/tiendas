<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTiendasVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TIENDAS_VENTAS', function (Blueprint $table) {
            $table->increments('VENTAS_ID');
            $table->enum('VENTAS_TIPO_PAGO',['EFECTIVO','TARJETA DÉBITO','TARJETA CRÉDITO','MIXTO','NÓMINA','TRANSFERENCIA','DEPÓSITO']);
            $table->integer('VENTAS_CONSECUTIVO_DIARIO')->nullable();
            $table->integer('VENTAS_CONSECUTIVO_ANUAL');
            $table->float('VENTAS_TOTAL');
            /*$table->unsignedInteger('VENTAS_FK_ESPACIO');
            $table->foreign('VENTAS_FK_ESPACIO')->references('ESPACIO_ID')->on('TIENDAS_ESPACIOS')->onDelete('cascade')->onUpdate('cascade');//*/
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
        Schema::dropIfExists('TIENDAS_VENTAS');
    }
}
