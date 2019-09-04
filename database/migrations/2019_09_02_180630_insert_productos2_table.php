<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertProductos2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $productos = array("PLAYERA CUELLO REDONDO","PLAYERA CUELLO REDONDO","PLAYERA CUELLO REDONDO","PLAYERA CUELLO REDONDO","PLAYERA CUELLO REDONDO","PLAYERA CUELLO REDONDO","PLAYERA CUELLO REDONDO","PLAYERA CUELLO REDONDO","PLAYERA CUELLO REDONDO","PLAYERA CUELLO REDONDO","PLAYERA CUELLO REDONDO","PLAYERA CUELLO REDONDO","PLAYERA POLO BICOLOR","PLAYERA POLO BICOLOR","PLAYERA POLO BICOLOR","PLAYERA POLO BICOLOR","PLAYERA POLO BICOLOR","PLAYERA POLO BICOLOR","PLAYERA POLO BICOLOR","PLAYERA POLO BICOLOR","SUDADERA MANGA LARGA CON GORRO","SUDADERA MANGA LARGA CON GORRO","SUDADERA MANGA LARGA CON GORRO","SUDADERA MANGA LARGA CON GORRO","GORRA FENIX","GORRA BUAP","SUDADERA MANGA LARGA CUELLO REDONDO","SUDADERA MANGA LARGA CUELLO REDONDO","SUDADERA MANGA LARGA CUELLO REDONDO","SUDADERA MANGA LARGA CUELLO REDONDO","SUDADERA MANGA LARGA CUELLO REDONDO","SUDADERA MANGA LARGA CUELLO REDONDO","SUDADERA MANGA LARGA CUELLO REDONDO","SUDADERA MANGA LARGA CUELLO REDONDO","LAPICERA","MOCHILA BUAP","RELOJ DE PARED","RELOJ DE PARED","TAZA ALUMINIO","TAZA ALUMINIO","LIBRETA ESPIRAL RAYADA");

        $color = array("BLANCA","BLANCA","BLANCA","BLANCA","AZUL","AZUL","AZUL","AZUL","MARINO","MARINO","MARINO","MARINO","BLANCA","BLANCA","BLANCA","BLANCA","MARINO","MARINO","MARINO","MARINO","MARINO","MARINO","MARINO","MARINO","MARINO","AZUL","BLANCA","BLANCA","BLANCA","BLANCA","MARINO","MARINO","MARINO","MARINO","N/A","N/A","BLANCO","AZUL","AZUL","BLANCA","N/A");

        $genero = array("UNISEX","UNISEX","UNISEX","UNISEX","UNISEX","UNISEX","UNISEX","UNISEX","UNISEX","UNISEX","UNISEX","UNISEX","UNISEX","UNISEX","UNISEX","UNISEX","UNISEX","UNISEX","UNISEX","UNISEX","UNISEX","UNISEX","UNISEX","UNISEX","UNISEX","UNISEX","UNISEX","UNISEX","UNISEX","UNISEX","UNISEX","UNISEX","UNISEX","UNISEX","UNISEX","UNISEX","UNISEX","UNISEX","UNISEX","UNISEX","UNISEX");

        $talla = array("S","M","L","XL","S","M","L","XL","S","M","L","XL","S","M","L","XL","S","M","L","XL","S","M","L","XL","SIN TALLA","SIN TALLA","S","M","L","XL","S","M","L","XL","SIN TALLA","SIN TALLA","SIN TALLA","SIN TALLA","SIN TALLA","SIN TALLA","SIN TALLA");

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
