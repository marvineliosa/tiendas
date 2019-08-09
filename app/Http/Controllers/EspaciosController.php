<?php
  namespace App\Http\Controllers;

    use App\User;
    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request; //indispensable para usar Request de los JSON
    use Illuminate\Http\Response;
    use Illuminate\Support\Facades\Storage;//gestion de archivos
    use Illuminate\Support\Facades\DB;//consulta a la base de datos

    class EspaciosController extends Controller
    {
        /**
         * Show the profile for the given user.
         *
         * @param  int  $id
         * @return Response
         */

        public function VerInventarioEspacio($id_espacio){
            //dd($id_espacio);
            //dd('EPALE');
            $inventario = ProductosController::ObtenerInventarioEspacioId($id_espacio);
            //dd($inventario);
            return view('listado_inventario')->with(['productos'=>$inventario]);
        }

        public static function ObtenerDatosEspacioId($id_espacio){
            $espacio = DB::table('TIENDAS_ESPACIOS')
                ->select(
                            'ESPACIO_NOMBRE as NOMBRE_ESPACIO',
                            'ESPACIO_UBICACION as UBICACION_ESPACIO',
                            'ESPACIO_SIGLAS as NOMENCLATURA_ESPACIO',
                            'ESPACIO_TIPO as TIPO_ESPACIO'
                        )
                ->orderBy('ESPACIO_TIPO', 'desc')
                ->get();
            if(count($espacio)>0){
                return $espacio[0];
            }else{
                return null;
            }
        }

        public static function ObtenerNombreEspacio($id_espacio){
            //dd($id_espacio);
            $espacio = DB::table('TIENDAS_ESPACIOS')
                ->where('ESPACIO_ID',$id_espacio)
                ->select(
                            'ESPACIO_NOMBRE as NOMBRE_ESPACIO'
                        )
                ->get();
            //dd($espacio);
            if(count($espacio)>0){
                return $espacio[0]->NOMBRE_ESPACIO;
            }else{
                return null;
            }
        }

        public static function ObtenerListadoEspacios(){
            $espacios = DB::table('TIENDAS_ESPACIOS')
            ->select(
                        'ESPACIO_ID as ID_ESPACIO',
                        'ESPACIO_NOMBRE as NOMBRE_ESPACIO',
                        'ESPACIO_UBICACION as UBICACION_ESPACIO',
                        'ESPACIO_SIGLAS as NOMENCLATURA_ESPACIO',
                        'ESPACIO_TIPO as TIPO_ESPACIO'
                    )
            ->orderBy('TIPO_ESPACIO','asc')
            ->get();
            return $espacios;
        }

        public function VistaListadoEspacios(){
            /*$espacios = DB::table('TIENDAS_ESPACIOS')
            ->select(
                        'ESPACIO_ID as ID_ESPACIO',
                        'ESPACIO_NOMBRE as NOMBRE_ESPACIO',
                        'ESPACIO_UBICACION as UBICACION_ESPACIO',
                        'ESPACIO_SIGLAS as NOMENCLATURA_ESPACIO',
                        'ESPACIO_TIPO as TIPO_ESPACIO'
                    )
            ->get();//*/
            $espacios = EspaciosController::ObtenerListadoEspacios();
            return view('listado_espacios') ->with ("espacios",$espacios);
        }

        public function RegistrarEspacio(Request $request){
            $nombre = $request['nombre'];
            $ubicacion = $request['ubicacion'];
            $tipo = $request['tipo'];
            $nomenclatura = $request['nomenclatura'];

            $id_espacio = DB::table('TIENDAS_ESPACIOS')->insertGetId(
                [
                    'ESPACIO_NOMBRE' => $nombre, 
                    'ESPACIO_UBICACION' => $ubicacion,
                    'ESPACIO_SIGLAS' => $nomenclatura,
                    'ESPACIO_TIPO' => $tipo,
                    'created_at' => ProductosController::ObtenerFechaHora()
                ]
            );

            $data = array(
                "id_espacio"=>$id_espacio
            );

            echo json_encode($data);//*/
        }
    }