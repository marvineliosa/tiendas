<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTiendasLoginTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TIENDAS_LOGIN', function (Blueprint $table) {
            $table->string('LOGIN_ID',150)->primary();
            $table->string('LOGIN_CONTRASENIA');
            $table->enum('LOGIN_CATEGORIA',['ADMINISTRADOR','ENCARGADO','CAJERO']);
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
        Schema::dropIfExists('TIENDAS_LOGIN');
    }
}
