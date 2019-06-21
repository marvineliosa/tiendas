<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTiendasProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TIENDAS_PRODUCTOS', function (Blueprint $table) {
            $table->increments('PRODUCTOS_ID');
            $table->string('PRODUCTOS_NOMBRE');
            $table->string('PRODUCTOS_COLOR',100)->nullable();
            $table->enum('PRODUCTOS_GENERO',['DAMA','CABALLERO','UNISEX']);
            $table->char('PRODUCTOS_TALLA',10)->nullable();
            $table->char('PRODUCTOS_CONSECUTIVO',10);
            $table->text('PRODUCTOS_OBSERVACIONES')->nullable();
            $table->timestamps();
        });
        DB::statement("ALTER TABLE TIENDAS_PRODUCTOS AUTO_INCREMENT = 1000;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TIENDAS_PRODUCTOS');
    }
}
