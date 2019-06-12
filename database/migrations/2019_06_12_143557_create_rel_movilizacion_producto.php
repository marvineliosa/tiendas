<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelMovilizacionProducto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('REL_MOVILIZACION_PRODUCTO', function (Blueprint $table) {
            $table->unsignedInteger('REL_MOV_FK_MOVILIZACION');
            $table->foreign('REL_MOV_FK_MOVILIZACION')->references('MOVILIZACION_ID')->on('TIENDAS_MOVILIZACION_INVENTARIO')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedInteger('REL_MOV_FK_PROCUTO');
            $table->foreign('REL_MOV_FK_PROCUTO')->references('PRODUCTOS_ID')->on('TIENDAS_PRODUCTOS')->onDelete('cascade')->onUpdate('cascade');

            $table->string('REL_MOV_FK_EMISOR',150);
            $table->foreign('REL_MOV_FK_EMISOR')->references('LOGIN_ID')->on('TIENDAS_LOGIN')->onDelete('cascade')->onUpdate('cascade');

            $table->string('REL_MOV_FK_RECEPTOR',150)->nullable();
            $table->foreign('REL_MOV_FK_RECEPTOR')->references('LOGIN_ID')->on('TIENDAS_LOGIN')->onDelete('cascade')->onUpdate('cascade');//*/
            $table->enum('REL_MOV_ESTATUS',['PENDIENTE','FINALIZADO','CANCELADO']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('REL_MOVILIZACION_PRODUCTO');
    }
}
