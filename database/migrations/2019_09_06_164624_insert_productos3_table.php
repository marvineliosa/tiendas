<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertProductos3Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $productos = array("Chamarra Elite","Chamarra Watta","Mariconera Mod. 1","Pulsera Silicon BUAP","Pulsera Silicon BUAP","Sudadera Envolvente","Sudadera Envolvente","Sudadera Gorro","Sudadera Minerva","Sudadera Minerva","USB Lobo Tienda","USB Rectangular");

        $color = array("REY","N/A","CAFÉ","MARINO","TURQUESA","MARINO","MARINO","MARINO","N/A","N/A","N/A","N/A");

        $genero = array("DAMA","UNISEX","UNISEX","UNISEX","UNISEX","UNISEX","UNISEX","UNISEX","UNISEX","UNISEX","UNISEX","UNISEX");

        $talla = array("XS","XXS","CHICA","SIN TALLA","SIN TALLA","L","XL","XXL","XL","XXL","SIN TALLA","SIN TALLA");

        for($i=0; $i<count($productos); $i++){
            //dd($talla[$i]);
            $id_producto = DB::table('TIENDAS_PRODUCTOS')->insertGetId(
                [
                    'PRODUCTOS_NOMBRE' => $productos[$i],
                    'PRODUCTOS_COLOR' => $color[$i],
                    'PRODUCTOS_GENERO' => $genero[$i],
                    'PRODUCTOS_TALLA' => $talla[$i],
                    'PRODUCTOS_OBSERVACIONES' => 'SIN OBSERVACIONES',
                    'created_at' => date('Y-m-d H:i:s')//*/
                ]
            );

            DB::table('TIENDAS_DATOS_VENTA_PRODUCTO')->insert(
                [
                    'DATOS_VENTA_FK_PROCUTO' => $id_producto,
                    'DATOS_VENTA_PRECIO' => 0,
                    'DATOS_VENTA_DESCUENTO' => 0
                ]
            );
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
