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

        public function RegistrarUsuario(Request $request){
            //dd($request);
            $mensaje = '';
            $existe_usuario = DB::table('TIENDAS_LOGIN')
                ->where('LOGIN_ID',$request['usuario'])
                ->get();
            if(count($existe_usuario)>0){
                $mensaje = "El usuario ".$request['usuario']." ya se encuentra registrado en el sistema, es necesario eliminarlo para realizar alguna modificación.";
            }else{
                DB::table('TIENDAS_LOGIN')->insert(
                    [
                        'LOGIN_ID' => $request['usuario'],
                        'LOGIN_CONTRASENIA' => UsuariosController::randomPassword(),
                        'LOGIN_CATEGORIA' => $request['categoria'],
                        'LOGIN_RESPONSABLE' => $request['nombre'],
                        'created_at' => ProductosController::ObtenerFechaHora()
                    ]
                );
                if(strcmp($request['espacio'], 'NADA')!=0){
                    DB::table('REL_USUARIO_ESPACIO')->insert(
                        [
                            'FK_USUARIO' => $request['usuario'],
                            'FK_ESPACIO' => $request['espacio']
                        ]
                    );
                }
                if(strpos($request['usuario'], '@')){
                    //enviar contraseña por mail
                }
                $mensaje = 'Se ha registrado satisfactoriamente al usuario '.$request['usuario'];
            }

            $data = array(
                "mensaje" => $mensaje
            );

            echo json_encode($data);//*/
        }

        public function ObtenerListadoUsuarios(){
            $usuarios = DB::table('TIENDAS_LOGIN')
                ->select(
                            'LOGIN_ID as UAURIO',
                            'LOGIN_RESPONSABLE as RESPONSABLE',
                            'LOGIN_CATEGORIA as CATEGORIA'
                        )
                ->get();
            return $usuarios;
        }

        public function VistaListadoUsuarios(){
            //dd('Vista usuarios');
            $usuarios = UsuariosController::ObtenerListadoUsuarios();
            $espacios = EspaciosController::ObtenerListadoEspacios();
            //dd($usuarios);
            return view('listado_usuarios')->with(['usuarios'=>$usuarios,'espacios'=>$espacios]);
        }

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
            \Session::forget('nombre_tienda');
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
                \Session::push('nombre_tienda',EspaciosController::ObtenerNombreEspacio(\Session::get('id_tienda')[0]));

            }

            $data = array(
                "usuario"=>\Session::get('usuario')[0],
                "categoria"=>\Session::get('categoria')[0],
                "id_tienda"=>\Session::get('id_tienda')[0],
                "nombre_tienda"=>\Session::get('nombre_tienda')[0],
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

        public static function randomPassword() {
            $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890._@';
            $pass = array(); //remember to declare $pass as an array
            $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
            for ($i = 0; $i < 10; $i++) {
                $n = rand(0, $alphaLength);
                $pass[] = $alphabet[$n];
            }
            return implode($pass); //turn the array into a string
        }


    }

/*

insert into TIENDAS_LOGIN(LOGIN_ID,LOGIN_CONTRASENIA,LOGIN_CATEGORIA,LOGIN_RESPONSABLE) values('administrador','123456','ADMINISTRADOR','USUARIO ADMINISTRADOR');

insert into TIENDAS_LOGIN(LOGIN_ID,LOGIN_CONTRASENIA,LOGIN_CATEGORIA,LOGIN_RESPONSABLE) values('encargado','123456','ENCARGADO','USUARIO ENCARGADO');

insert into TIENDAS_LOGIN(LOGIN_ID,LOGIN_CONTRASENIA,LOGIN_CATEGORIA,LOGIN_RESPONSABLE) values('cajero','123456','CAJERO','USUARIO CAJERO');

insert into TIENDAS_LOGIN(LOGIN_ID,LOGIN_CONTRASENIA,LOGIN_CATEGORIA,LOGIN_RESPONSABLE) values('omarhernandez_cu','omarhernandezcu','CAJERO','OMAR HERNÁNDEZ');

insert into TIENDAS_LOGIN(LOGIN_ID,LOGIN_CONTRASENIA,LOGIN_CATEGORIA,LOGIN_RESPONSABLE) values('omarhernandez_ccu','omarhernandezccu','CAJERO','OMAR HERNÁNDEZ');

insert into REL_USUARIO_ESPACIO(FK_USUARIO,FK_ESPACIO) values('cajero','2');
insert into REL_USUARIO_ESPACIO(FK_USUARIO,FK_ESPACIO) values('omarhernandez_cu','2');
insert into REL_USUARIO_ESPACIO(FK_USUARIO,FK_ESPACIO) values('omarhernandez_ccu','3');

insert into TIENDAS_LOGIN(LOGIN_ID,LOGIN_CONTRASENIA,LOGIN_CATEGORIA,LOGIN_RESPONSABLE) values('marvineliosa','123456','CAJERO','Marvin Eliosa Abaroa');

insert into REL_USUARIO_ESPACIO(FK_USUARIO,FK_ESPACIO) values('marvineliosa','3');

//*/