<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelHistorialProductoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('REL_HISTORIAL_PRODUCTO', function (Blueprint $table) {
            $table->unsignedInteger('FK_PROCUTO');
            $table->foreign('FK_PROCUTO')->references('PRODUCTOS_ID')->on('TIENDAS_PRODUCTOS')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedInteger('FK_HISTORIAL');
            $table->foreign('FK_HISTORIAL')->references('HISTORIAL_ID')->on('TIENDAS_HISTORIAL')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('REL_HISTORIAL_PRODUCTO');
    }
}
