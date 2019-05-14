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
            $table->enum('VENTAS_TIPO_PAGO',['EFECTIVO','TARJETA','MIXTO','NÓMINA']);
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
