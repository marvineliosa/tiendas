<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTiendasQuincenasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TIENDAS_QUINCENAS', function (Blueprint $table) {
            $table->increments('QUINCENAS_ID');
            $table->char('QUINCENAS_ESTATUS',10);
            $table->date('QUINCENAS_FECHA_ESTIMADA')->nullable();
            $table->datetime('QUINCENAS_FECHA_PAGO')->nullable();
            $table->text('QUINCENAS_OBSERVACIONES')->nullable();
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
        Schema::dropIfExists('TIENDAS_QUINCENAS');
    }
}
