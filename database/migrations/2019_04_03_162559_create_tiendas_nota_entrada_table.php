<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTiendasNotaEntradaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TIENDAS_NOTA_ENTRADA', function (Blueprint $table) {
            $table->increments('NOTA_ENTRADA_ID');
            $table->integer('NOTA_ENTRADA_PRECIO_COMPRA');
            $table->integer('NOTA_ENTRADA_CANTIDAD');
            //$table->integer('NOTA_ENTRADA_INICIO')->nullable();
            //$table->integer('NOTA_ENTRADA_FIN')->nullable();
            $table->text('NOTA_ENTRADA_OBSERVACIONES')->nullable();
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
        Schema::dropIfExists('TIENDAS_NOTA_ENTRADA');
    }
}
