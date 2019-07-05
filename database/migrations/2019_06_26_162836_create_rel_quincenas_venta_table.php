<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelQuincenasVentaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('REL_QUINCENAS_VENTA', function (Blueprint $table) {
            $table->unsignedInteger('REL_QUINCENAS_FK_VENTA');
            $table->foreign('REL_QUINCENAS_FK_VENTA')->references('VENTAS_ID')->on('TIENDAS_VENTAS')->onDelete('cascade')->onUpdate('cascade');//*/

            $table->unsignedInteger('REL_QUINCENAS_FK_QUINCENA');
            $table->foreign('REL_QUINCENAS_FK_QUINCENA')->references('QUINCENAS_ID')->on('TIENDAS_QUINCENAS')->onDelete('cascade')->onUpdate('cascade');//*/
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
        Schema::dropIfExists('REL_QUINCENAS_VENTA');
    }
}
