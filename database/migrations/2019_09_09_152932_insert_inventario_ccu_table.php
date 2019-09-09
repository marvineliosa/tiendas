<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertInventarioCcuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $productos = array("1010","1011","1012","1013","1014","1015","1184","1025","1027","1028","1029","1030","1031","1032","1033","1034","1035","1036","1037","1041","1043","1185","1046","1048","1051","1062","1067","1068","1186","1076","1077","1078","1079","1087","1089","1099","1187","1188","1103","1104","1105","1110","1114","1115","1116","1118","1189","1190","1126","1191","1127","1128","1129","1192","1193","1131","1132","1133","1134","1135","1136","1138","1194","1139","1195","1140");

        $inventario = array(61,96,33,63,21,47,0,5,4,3,8,6,4,24,11,17,26,3,1,0,5,0,19,13,1,19,12,18,0,1,1,3,2,1,21,38,0,0,48,55,4,50,29,7,1,1,0,0,10,0,10,26,5,0,0,14,29,31,16,4,8,9,0,1,0,164);

        for($i=0; $i<count($productos); $i++){
            //dd($talla[$i]);
            $id_producto = DB::table('REL_INVENTARIO')->insertGetId(
                [
                    'DATOS_VENTA_FK_PROCUTO' => $productos[$i],
                    'DATOS_VENTA_FK_ESPACIO' => 3,
                    'DATOS_VENTA_CANTIDAD' => $inventario[$i]//*/
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
        DB::table('REL_INVENTARIO')->delete();
    }
}
