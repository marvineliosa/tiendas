<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelProductoNotaEntradaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('REL_PRODUCTO_NOTA_ENTRADA', function (Blueprint $table) {
            $table->unsignedInteger('FK_PROCUTO');
            $table->foreign('FK_PROCUTO')->references('PRODUCTOS_ID')->on('TIENDAS_PRODUCTOS')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedInteger('FK_NOTA_ENTRADA');
            $table->foreign('FK_NOTA_ENTRADA')->references('NOTA_ENTRADA_ID')->on('TIENDAS_NOTA_ENTRADA')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('REL_PRODUCTO_NOTA_ENTRADA');
    }
}
