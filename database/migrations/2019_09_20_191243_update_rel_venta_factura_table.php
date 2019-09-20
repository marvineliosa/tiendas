<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateRelVentaFacturaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       DB::statement('ALTER TABLE REL_VENTA_FACTURA MODIFY COLUMN REL_FACTURA_NUMERO CHAR(20) NOT NULL');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('ALTER TABLE REL_VENTA_FACTURA MODIFY COLUMN REL_FACTURA_NUMERO INTEGER');
    }
}
