<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTiendasMovilizacionInventarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TIENDAS_MOVILIZACION_INVENTARIO', function (Blueprint $table) {
            $table->increments('MOVILIZACION_ID');
            $table->unsignedInteger('MOVILIZACION_FK_PROCUTO');
            $table->foreign('MOVILIZACION_FK_PROCUTO')->references('PRODUCTOS_ID')->on('TIENDAS_PRODUCTOS')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedInteger('MOVILIZACION_ORIGEN');
            $table->foreign('MOVILIZACION_ORIGEN')->references('ESPACIO_ID')->on('TIENDAS_ESPACIOS')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedInteger('MOVILIZACION_DESTINO');
            $table->foreign('MOVILIZACION_DESTINO')->references('ESPACIO_ID')->on('TIENDAS_ESPACIOS')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('MOVILIZACION_CANTIDAD');

            $table->date('MOVILIZACION_FECHA_MOVIMIENTO');
            $table->date('MOVILIZACION_FECHA_RECEPCION')->nullable();
            $table->date('MOVILIZACION_FECHA_CANCELACION')->nullable();

            $table->string('MOVILIZACION_FK_EMISOR',150);
            $table->foreign('MOVILIZACION_FK_EMISOR')->references('LOGIN_ID')->on('TIENDAS_LOGIN')->onDelete('cascade')->onUpdate('cascade');
            $table->string('MOVILIZACION_FK_RECEPTOR',150)->nullable();
            $table->foreign('MOVILIZACION_FK_RECEPTOR')->references('LOGIN_ID')->on('TIENDAS_LOGIN')->onDelete('cascade')->onUpdate('cascade');

            $table->enum('MOVILIZACION_ESTATUS',['PENDIENTE','FINALIZADO','CANCELADO']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TIENDAS_MOVILIZACION_INVENTARIO');
    }
}
