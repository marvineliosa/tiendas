<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelUsuarioEspacioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('REL_USUARIO_ESPACIO', function (Blueprint $table) {
            $table->string('FK_USUARIO',150);
            $table->foreign('FK_USUARIO')->references('LOGIN_ID')->on('TIENDAS_LOGIN')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedInteger('FK_ESPACIO');
            $table->foreign('FK_ESPACIO')->references('ESPACIO_ID')->on('TIENDAS_ESPACIOS')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('REL_USUARIO_ESPACIO');
    }
}
