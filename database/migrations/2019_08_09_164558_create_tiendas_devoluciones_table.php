<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTiendasDevolucionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TIENDAS_DEVOLUCIONES', function (Blueprint $table) {
            $table->increments('DEVOLUCIONES_ID');
            
            $table->unsignedInteger('DEVOLUCIONES_PROCUTO_ID');
            $table->foreign('DEVOLUCIONES_PROCUTO_ID')->references('PRODUCTOS_ID')->on('TIENDAS_PRODUCTOS')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('DEVOLUCIONES_CANTIDAD');
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
        Schema::dropIfExists('TIENDAS_DEVOLUCIONES');
    }
}
