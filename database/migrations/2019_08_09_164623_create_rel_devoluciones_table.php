<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelDevolucionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('REL_DEVOLUCIONES', function (Blueprint $table) {
            $table->unsignedInteger('FK_VENTA');
            $table->foreign('FK_VENTA')->references('VENTAS_ID')->on('TIENDAS_VENTAS')->onDelete('cascade')->onUpdate('cascade');//*/

            $table->unsignedInteger('FK_DEV_PROD_INICIAL');
            $table->foreign('FK_DEV_PROD_INICIAL')->references('DEVOLUCIONES_ID')->on('TIENDAS_DEVOLUCIONES')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedInteger('FK_DEV_PROD_CAMBIO');
            $table->foreign('FK_DEV_PROD_CAMBIO')->references('DEVOLUCIONES_ID')->on('TIENDAS_DEVOLUCIONES')->onDelete('cascade')->onUpdate('cascade');

            $table->string('FK_USUARIO',150);
            $table->foreign('FK_USUARIO')->references('LOGIN_ID')->on('TIENDAS_LOGIN')->onDelete('cascade')->onUpdate('cascade');

            $table->text('REL_DEV_MOTIVO')->nullable();

            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('REL_DEVOLUCIONES');
    }
}
