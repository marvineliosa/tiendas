<?php
  namespace App\Http\Controllers;

    use App\User;
    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request; //indispensable para usar Request de los JSON
    use Illuminate\Http\Response;
    use Illuminate\Support\Facades\Storage;//gestion de archivos
    use Illuminate\Support\Facades\DB;//consulta a la base de datos

    class UsuariosController extends Controller
    {
        /**
         * Show the profile for the given user.
         *
         * @param  int  $id
         * @return Response
         */

        public static function ObtenerNombreUsuario($usuario){
            //dd($usuario);
            $nombre = DB::table('TIENDAS_LOGIN')
                ->where('LOGIN_ID',$usuario)
                ->select(
                            'LOGIN_RESPONSABLE as NOMBRE_RESPONSABLE'
                        )
                ->get();
            //dd($espacio);
            if(count($nombre)>0){
                return $nombre[0]->NOMBRE_RESPONSABLE;
            }else{
                return null;
            }
        }

        public function ValidarLogin(Request $request){
            \Session::forget('usuario');
            \Session::forget('categoria');
            \Session::forget('id_tienda');
            \Session::forget('responsable');
            //dd($request);
            $usruario = $request['usuario'];
            $contrasena = $request['contrasena'];
            $fl = false;
            $existe = DB::table('TIENDAS_LOGIN')
                ->where(['LOGIN_ID'=> $usruario, 'LOGIN_CONTRASENIA' => $contrasena])
                ->get();
            //dd($existe);
            if(count($existe)>0){
                $fl = true;
                \Session::push('usuario',$existe[0]->LOGIN_ID);
                \Session::push('categoria',$existe[0]->LOGIN_CATEGORIA);
                \Session::push('responsable',$existe[0]->LOGIN_RESPONSABLE);
                \Session::push('id_tienda',UsuariosController::ObtenerTiendaUsuario($existe[0]->LOGIN_ID));

            }

            $data = array(
                "usuario"=>\Session::get('usuario')[0],
                "categoria"=>\Session::get('categoria')[0],
                "id_tienda"=>\Session::get('id_tienda')[0],
                "responsable"=>\Session::get('responsable')[0],
                "exito" => $fl
            );

            echo json_encode($data);//*/
        }

        public function CerrarSesion(){
            \Session::forget('usuario');
            \Session::forget('categoria');
            \Session::forget('id_tienda');
            \Session::forget('responsable');
            return redirect('/');
        }

        public static function ObtenerTiendaUsuario($id_usuario){
            $tienda = DB::table('REL_USUARIO_ESPACIO')
                ->where(['FK_USUARIO'=> $id_usuario])
                ->get();
            if(count($tienda)>0){
                return $tienda[0]->FK_ESPACIO;
            }else{
                return null;
            }
        }


    }

/*

insert into TIENDAS_LOGIN(LOGIN_ID,LOGIN_CONTRASENIA,LOGIN_CATEGORIA,LOGIN_RESPONSABLE) values('administrador','123456','ADMINISTRADOR','USUARIO ADMINISTRADOR');

insert into TIENDAS_LOGIN(LOGIN_ID,LOGIN_CONTRASENIA,LOGIN_CATEGORIA,LOGIN_RESPONSABLE) values('encargado','123456','ENCARGADO','USUARIO ENCARGADO');

insert into TIENDAS_LOGIN(LOGIN_ID,LOGIN_CONTRASENIA,LOGIN_CATEGORIA,LOGIN_RESPONSABLE) values('cajero','123456','CAJERO','USUARIO CAJERO');

insert into REL_USUARIO_ESPACIO(FK_USUARIO,FK_ESPACIO) values('cajero','2');

insert into TIENDAS_LOGIN(LOGIN_ID,LOGIN_CONTRASENIA,LOGIN_CATEGORIA,LOGIN_RESPONSABLE) values('marvineliosa','123456','CAJERO','Marvin Eliosa Abaroa');

insert into REL_USUARIO_ESPACIO(FK_USUARIO,FK_ESPACIO) values('marvineliosa','3');

//*/