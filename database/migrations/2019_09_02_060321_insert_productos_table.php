<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;//consulta a la base de datos

class InsertProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        date_default_timezone_set('America/Mexico_City');

        $productos = array('Alcancía Lobos','APLAUDIDORES','AUDIFONOS BOBINA','AUDIFONOS LLAVERO','Balones Lobos','Bandera 1.45 x 0.95 cm Providencia Lobos','BOCINA ','BOCINA ','Bolígrafo Lobos','BOLSA','BOLSA','BOLSA','BOLSA','BOLSA','BOLSA','BOLSA','BUFANDA','Bufanda 1.00 x 0.15 cm Providencia Lobos ','Bufanda Lobos','Bufanda Lobos','Bufanda Lobos','CHAMARRA DOBLE CIERRE','CHAMARRA DOBLE CIERRE','CHAMARRA ELITE ','CHAMARRA ELITE ','CHAMARRA MEDIO CIERRE','CHAMARRA MEDIO CIERRE','CHAMARRA MEDIO CIERRE','CHAMARRA MEDIO CIERRE','CHAMARRA MEDIO CIERRE','CHAMARRA MEDIO CIERRE','CHAMARRA MEDIO CIERRE','CHAMARRA MEDIO CIERRE','CHAMARRA MEDIO CIERRE','CHAMARRA MEDIO CIERRE','CHAMARRA MEDIO CIERRE','CHAMARRA MEDIO CIERRE','CHAMARRA UNIVERSITARIA ','CHAMARRA UNIVERSITARIA ','CHAMARRA UNIVERSITARIA ','CHAMARRA UNIVERSITARIA ','CHAMARRA UNIVERSITARIA ','CHAMARRA WATTA','CHAMARRA WATTA','CHAMARRA WATTA','CILINDRO INFUSOR ','CORBATA BUAP','ESTUCHE NOTAS ADHESIVAS','GORRA BUAP','GORRA BUAP','GORRA BUAP','GORRA BUAP','IMPERMEABLE BOLA','IMPERMEABLE BOLA','JERSEY AFICIONADO LOBOS','JERSEY AFICIONADO LOBOS','JERSEY AFICIONADO LOBOS','JERSEY HISTORICO LOBOS','JERSEY HISTORICO LOBOS','JERSEY HISTORICO LOBOS','JERSEY JUGADOR LOBOS','JERSEY JUGADOR LOBOS','LAPIZ','LATA ','LATA ','LATA FENIX','LENTES','LIBRETA BICOLOR','LIBRETA BUAP','LIBRETA CURPIEL GRABADO EN LASER','Llavero Gol Lobos','LLAVERO LOBOS','MARICONERA MOD. 1','MARICONERA MOD. 1','MARICONERA MOD. 1','MARICONERA MOD. 1','MARICONERA MOD. 3','MARICONERA MOD. 3','MARICONERA MOD. 3','MARICONERA MOD. 3','MARICONERA MOD. 4','MARICONERA MOD. 4','MARICONERA MOD. 4','MARICONERA MOD. 5 PORTA LAP','MARICONERA MOD. 5 PORTA LAP','MASCADA CUADRADA','Pelota Anti stres Lobos','PIN CHICO','PIN MEDIANO','Pisacobarta Niquel','Playera Algodón Campeón Lobos','Playera Compacta Lobos','Playera Compacta Lobos','Playera Compacta Lobos','Playera Compacta Lobos','Porta ipad','Poulsera Silicon Lobos','Poulsera Silicon Lobos','Poulsera Silicon Lobos','Pulsera Silicon BUAP','Pulsera Silicon BUAP','Pulsera Silicon BUAP','Pulsera Silicon BUAP','Pulsera Tela Modelo 1 BUAP','Pulsera Tela Modelo 2 BUAP','Pulsera Tela Modelo 3 BUAP','Pulsera Tela Modelo 4 Lobos','Pulsera Tela Modelo 5 Lobos','Pulsera Tela Modelo 6 Lobos','Pulsera Tela Modelo 7 Lobos','Pulsera Tela Modelo 8 Lobos','Reloj Gigante con correa','Reloj Lobos','Reloj Metálico con Números Romanos','Separador Niquel','Separador Plata','Set Escolar','Set Fan Pack Providencia Lobos','Sombrilla','Spinner Lobos','Square Pillow 40 x 40 cm Providencia Lobos','Sticker Cuadrado Lobos','Sticker Largo Lobos','Sticker Vínil ','Sticker Vínil Pequeño','Sticker Vínil Pequeño','Sudadera Envolvente ','Sudadera Gorro','Sudadera Gorro','Sudadera Minerva ','Tank Top ','Tank Top ','Tank Top ','Tank Top ','Tank Top ','Tank Top ','Tarro Cervecero','Toalla Facial Lobos BUAP','USB','USB en contenedor Chico','USB Redonda','Vaso Lobos','Vaso Lobos');

        $color = array('Blanco / Negra','BLANCO','ROJO','ROJO','Bicolor','Bicolor','AZUL','ROJA','Bicolor','MARINO','MARINO','TURQUESA','BLANCA','MARINO','TURQUESA','BLANCA','ROJA','Bicolor','Roja','Gris','Negra','MARINO','MARINO','REY','REY','NEGRA','NEGRA','NEGRA','NEGRA','NEGRA','NEGRA','TURQUESA','TURQUESA','TURQUESA','TURQUESA','TURQUESA','TURQUESA','MARINO/BLANCA','MARINO/BLANCA','MARINO/BLANCA','MARINO/BLANCA','MARINO/BLANCA','MARINO','MARINO','MARINO','MARINO','MARINO','NEGRO','GRIS','GRIS/MARINO','GRIS/NEGRO','GRIS/TURQUESA','BLANCA','ROJA','NEGRO','NEGRO','NEGRO','BLANCO','BLANCO','BLANCO','ROJO','ROJO','MARINO','ALUMINIO','BLANCA','AZUL','ROJOS','AZUL','MARINO','MARINO','Blanco','BLANCO','NEGRA','CAFÉ','NEGRA','CAFÉ','CAFÉ','NEGRA','CAFÉ','NEGRA','CAFÉ','GRIS','NEGRA','CAFÉ','NEGRA','MARINO','Blanco / Negra','PLATA','PLATA','Plata','Blanca','Blanca','Blanca','Blanca','Blanca','Negro','Gris','Negra','Roja','Blanca','Negra','Turquesa','Marino','varios','varios','varios','varios','varios','varios','varios','varios','Azul','Negra','Plata','Plata','Plata','Transparente','Bicolor','Blanca','Blanco','Bicolor','Bicolor','Bicolor','Bicolor','Negro','Blanco','Marino ','Turquesa','Turquesa','Turquesa','Gris','Gris','Gris','Gris','Gris','Gris','Transparente','Bicolor','Gris','Negro','Marino','Negro','Rojo');

        $genero = array('UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','DAMA','DAMA','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','CABALLERO','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','Caballero','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','Caballero','Caballero','Caballero','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','Dama','Dama','Dama','Dama','Dama','Dama','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX','UNISEX');

        $talla = array('N/A','N/A','N/A','N/A','N/A','N/A','N/A','N/A','N/A','CHICA','GRANDE','GRANDE','MEDIANA','MEDIANA','MEDIANA','MINI','N/A','N/A','N/A','N/A','N/A','XL','XXL','L','XL','XS','S','M','L','XL','XXL','XS','S','M','L','XL','XXL','S','M','L','XL','XXL','M','L','XL','N/A','N/A','N/A','N/A','N/A','N/A','N/A','N/A','N/A','S','M','UNITALLA','S','M','L','XS','S','N/A','N/A','N/A','N/A','N/A','N/A','N/A','N/A','N/A','N/A','CHICA','MEDIANA','MEDIANA','GRANDE','CHICA','CHICA','MEDIANA','MEDIANA','N/A','N/A','N/A','N/A','N/A','N/A','N/A','N/A','N/A','N/A','Unitalla','32','36','40','44','N/A','N/A','N/A','N/A','N/A','N/A','N/A','N/A','N/A','N/A','N/A','N/A','N/A','N/A','N/A','N/A','N/A','N/A','N/A','N/A','N/A','N/A','N/A','N/A','N/A','N/A','N/A','N/A','N/A','N/A','N/A','XXL','XL','XXL','L','XS','S','M','L','XL','XXL','N/A','N/A','N/A','N/A','N/A','N/A','N/A');

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
        DB::table('TIENDAS_DATOS_VENTA_PRODUCTO')->truncate();
        DB::table('TIENDAS_PRODUCTOS')->truncate();
    }
}
