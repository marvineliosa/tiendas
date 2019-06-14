<?php
  namespace App\Http\Controllers;

    use App\User;
    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request; //indispensable para usar Request de los JSON
    use Illuminate\Http\Response;
    use Illuminate\Support\Facades\Storage;//gestion de archivos
    use Illuminate\Support\Facades\DB;//consulta a la base de datos

    class ProductosController extends Controller
    {
        /**
         * Show the profile for the given user.
         *
         * @param  int  $id
         * @return Response
         */

        public function VistaReporteVentas(){
            return view('reporte_ventas');
        }

        public function AlmacenarVenta(Request $request){
            //dd($request['venta']);
            $venta = json_decode($request['venta']);
            //dd($venta->venta);
            $venta = $venta->venta;
            //dd('hola');
            dd($venta);
            foreach ($venta as $obj){
                dd($obj);
            }
            //print_r($venta);
            dd($venta);
        }

        public function AlmacenarVentaDebito(Request $request){
            //dd($request['venta']);
            //dd('DEBITO');
            $venta = json_decode($request['venta']);
            //dd($venta->venta);
            $venta = $venta->venta;
            //dd($venta[1]->id_producto);

            //dd($venta);
            //$tipo_pago = 'DEBITO';
            $id_venta = ProductosController::InsertarVenta('TARJETA DÉBITO',$venta);
            foreach ($venta as $obj){
                dd($obj);
            }
            //print_r($venta);
            dd($venta);
        }

        public function InsertarVenta($tipo_pago,$listado_venta){
            $espacio = \Session::get('id_tienda')[0];
            DB::raw('lock tables SOLICITUDES_SOLICITUD write');
            $consecutivo_anual = ProductosController::ObtenerConsecutivoAnual();
            //dd('Consecutivo anual: '.$consecutivo_anual);
            $id_venta = DB::table('TIENDAS_VENTAS')->insertGetId(
                [
                    'VENTAS_TIPO_PAGO' => $tipo_pago,
                    'VENTAS_CONSECUTIVO_ANUAL' => $consecutivo_anual,
                    'created_at' => ProductosController::ObtenerFechaHora()
                ]
            );//*/

            foreach ($listado_venta as $listado) {
                DB::table('REL_VENTA_PRODUCTO')->insert(
                    [
                        'REL_VENTA_FK_VENTA' => $id_venta,
                        'REL_VENTA_FK_PROCUTO' => $listado->id_producto,
                        'REL_VENTA_FK_ESPACIO' => $espacio,
                        'REL_VENTA_PRECIO' => $listado->precio_venta,
                        'REL_VENTA_CANTIDAD' => $listado->cantidad,
                        'created_at' => ProductosController::ObtenerFechaHora()
                    ]
                );
            }
            
            DB::raw('unlock tables');
            //dd($id_venta);

        }

        public function ObtenerConsecutivoAnual(){
            $id_espacio = \Session::get('id_tienda')[0];
            /*$rel_ventas = DB::table('REL_VENTA_PRODUCTO')
                ->select('name', 'email as user_email')
                ->get();//*/

            $rel_ventas = DB::table('REL_VENTA_PRODUCTO')
                ->join('TIENDAS_VENTAS', function ($join) use($id_espacio) {
                    //dd($id_espacio);
                    //$dia_uno = date(date('Y').'-01-01');
                    //dd($dia_uno);
                    $join->on('REL_VENTA_PRODUCTO.REL_VENTA_FK_VENTA', '=', 'TIENDAS_VENTAS.VENTAS_ID')
                        ->where(['REL_VENTA_PRODUCTO.REL_VENTA_FK_ESPACIO'=>$id_espacio])
                        ->whereYear('TIENDAS_VENTAS.created_at',date('Y'));
                })
                ->orderBy('TIENDAS_VENTAS.created_at', 'desc')
                ->get();//*/
            //dd($rel_ventas);
            if(count($rel_ventas)==0){
                $consecutivo_anual = 1;
            }else{
                $consecutivo_actual = $rel_ventas[0]->VENTAS_CONSECUTIVO_ANUAL;
                $consecutivo_anual = $consecutivo_actual + 1;
            }
            return $consecutivo_anual;
        }

        public function CancelarMovilizacion(Request $request){
            $id_movilizacion = $request['id_movilizacion'];

            $movilizacion = ProductosController::ObtenerDatosMovilizacion($id_movilizacion);
            //dd($movilizacion);

            /*$movilizacion = DB::table('TIENDAS_MOVILIZACION_INVENTARIO')
                ->where('MOVILIZACION_ID',$id_movilizacion)
                ->get();//*/
            $tienda_origen = EspaciosController::ObtenerNombreEspacio($movilizacion[0]->MOVILIZACION_ORIGEN);
            //dd($movilizacion);
            $id_producto = $movilizacion[0]->REL_MOV_FK_PROCUTO;
            //dd($movilizacion);
            //obtenemos los datos del inventario
            $inventario_anterior = DB::table('REL_INVENTARIO')
                ->where([
                    'DATOS_VENTA_FK_PROCUTO' => $id_producto,
                    'DATOS_VENTA_FK_ESPACIO' => $movilizacion[0]->MOVILIZACION_ORIGEN
                ])
                ->get();

            //dd($inventario_anterior);

            //dd("ACTUALIZANDO");
            $cantidad = $inventario_anterior[0]->DATOS_VENTA_CANTIDAD + $movilizacion[0]->MOVILIZACION_CANTIDAD;
            //dd($cantidad);
            $update = DB::table('REL_INVENTARIO')
                ->where([
                    'DATOS_VENTA_FK_PROCUTO' => $id_producto,
                    'DATOS_VENTA_FK_ESPACIO' => $movilizacion[0]->MOVILIZACION_ORIGEN
                ])
                ->update([
                    'DATOS_VENTA_CANTIDAD' => $cantidad
                ]);//*/   
            //dd($update);

            //le cambiamos el estatus a la relacion de movilizacion
            $update = DB::table('REL_MOVILIZACION_PRODUCTO')
                ->where('REL_MOV_FK_MOVILIZACION', $id_movilizacion)
                ->update([
                    //'MOVILIZACION_FECHA_CANCELACION' => ProductosController::ObtenerFechaHora(),
                    'REL_MOV_ESTATUS' => 'CANCELADO'
                ]);

            //agregamos la fecha de cancelacion de la movilizacion
            $update2 = DB::table('TIENDAS_MOVILIZACION_INVENTARIO')
                ->where('MOVILIZACION_ID', $id_movilizacion)
                ->update([
                    'MOVILIZACION_FECHA_CANCELACION' => ProductosController::ObtenerFechaHora(),
                    //'MOVILIZACION_ESTATUS' => 'CANCELADO'
                ]);

            $mensaje = 'Se ha marcado como CANCELADO la movilización de inventario. La cantidad de productos que se encontraba en espera ha sido sumada nuevamente al inventario de '.$tienda_origen;
            $texto_historial = 'Se ha cancelado la movilizacion de inventario de '.$movilizacion[0]->MOVILIZACION_CANTIDAD.' unidades del producto '.$movilizacion[0]->REL_MOV_FK_PROCUTO.' que tenían como destino '. $tienda_origen.'.';
            ProductosController::RegistraHistorialProducto($id_producto,$texto_historial);

            $data = array(
                "update"=>$update,
                "update_fecha"=>$update2,
                "mensaje"=>$mensaje
            );
            echo json_encode($data);//*/
        }

        public function AprobarMovilizacion(Request $request){
            $id_movilizacion = $request['id_movilizacion'];

            $movilizacion = ProductosController::ObtenerDatosMovilizacion($id_movilizacion);
            //dd($movilizacion);
            /*$movilizacion = DB::table('TIENDAS_MOVILIZACION_INVENTARIO')
                ->where('MOVILIZACION_ID',$id_movilizacion)
                ->get();//*/

            $tienda_destino = EspaciosController::ObtenerNombreEspacio($movilizacion[0]->MOVILIZACION_DESTINO);
            //$id_producto = $movilizacion[0]->MOVILIZACION_FK_PROCUTO;

            //$tienda_origen = EspaciosController::ObtenerNombreEspacio($movilizacion[0]->MOVILIZACION_ORIGEN);
            //dd($movilizacion);
            $id_producto = $movilizacion[0]->REL_MOV_FK_PROCUTO;
            //dd($movilizacion);
            //obtenemos los datos del inventario
            $inventario_anterior = DB::table('REL_INVENTARIO')
                ->where([
                    'DATOS_VENTA_FK_PROCUTO' => $id_producto,
                    'DATOS_VENTA_FK_ESPACIO' => $movilizacion[0]->MOVILIZACION_DESTINO
                ])
                ->get();

            //dd($inventario_anterior);

            if(count($inventario_anterior)>0){
                //dd("ACTUALIZANDO");
                $cantidad = $inventario_anterior[0]->DATOS_VENTA_CANTIDAD + $movilizacion[0]->MOVILIZACION_CANTIDAD;
                //dd($cantidad);
                $update = DB::table('REL_INVENTARIO')
                    ->where([
                        'DATOS_VENTA_FK_PROCUTO' => $id_producto,
                        'DATOS_VENTA_FK_ESPACIO' => $movilizacion[0]->MOVILIZACION_DESTINO
                    ])
                    ->update([
                        'DATOS_VENTA_CANTIDAD' => $cantidad
                    ]);//*/   
                //dd($update);
            }else{
                //dd("NUEVO");
                DB::table('REL_INVENTARIO')->insert(
                    [
                        'DATOS_VENTA_FK_PROCUTO' => $id_producto,
                        'DATOS_VENTA_FK_ESPACIO' => $movilizacion[0]->MOVILIZACION_DESTINO,
                        'DATOS_VENTA_CANTIDAD' => $movilizacion[0]->MOVILIZACION_CANTIDAD 
                    ]
                );//*/
            }
            //dd('Aumentado');

            /*$update = DB::table('TIENDAS_MOVILIZACION_INVENTARIO')
                ->where('MOVILIZACION_ID', $id_movilizacion)
                ->update([
                    'MOVILIZACION_FECHA_RECEPCION' => ProductosController::ObtenerFechaHora(),
                    'MOVILIZACION_FK_RECEPTOR' => \Session::get('usuario')[0],
                    'MOVILIZACION_ESTATUS' => 'FINALIZADO'
                ]);//*/

            //le cambiamos el estatus a la relacion de movilizacion
            $update = DB::table('REL_MOVILIZACION_PRODUCTO')
                ->where('REL_MOV_FK_MOVILIZACION', $id_movilizacion)
                ->update([
                    //'MOVILIZACION_FECHA_CANCELACION' => ProductosController::ObtenerFechaHora(),
                    'REL_MOV_FK_RECEPTOR' => \Session::get('usuario')[0],
                    'REL_MOV_ESTATUS' => 'FINALIZADO'
                ]);

            //agregamos la fecha de cancelacion de la movilizacion
            $update2 = DB::table('TIENDAS_MOVILIZACION_INVENTARIO')
                ->where('MOVILIZACION_ID', $id_movilizacion)
                ->update([
                    'MOVILIZACION_FECHA_RECEPCION' => ProductosController::ObtenerFechaHora(),
                    //'MOVILIZACION_ESTATUS' => 'CANCELADO'
                ]);

            $mensaje = 'Se ha marcado como FINALIZADA la movilización de inventario. Se ha registrado exitosamente '.$movilizacion[0]->MOVILIZACION_CANTIDAD.' unidades al inventario de '.$tienda_destino.'.';

            $texto_historial = 'Recepción de inventario exitosa en '. $tienda_destino .' de '.$movilizacion[0]->MOVILIZACION_CANTIDAD .' unidades del producto '.$movilizacion[0]->REL_MOV_FK_PROCUTO;
            ProductosController::RegistraHistorialProducto($id_producto,$texto_historial);

            $data = array(
                "update"=>$update,
                "mensaje"=>$mensaje
            );
            echo json_encode($data);//*/
        }

        public function TraerMovilizacionesUsuario(Request $request){
            $id_producto = $request['id_producto'];
            //$movilizaciones = ProductosController::ObtenerMovilizaciones($id_producto);
            $categoria_usuario = \Session::get('categoria')[0];
            $espacio_usuario = \Session::get('id_tienda')[0];
            //dd($espacio_usuario);
            //dd($categoria_usuario);
            if(strcmp($categoria_usuario, 'CAJERO')==0){
            //dd($espacio_usuario);
                $movilizaciones = ProductosController::ObtenerMovilizacionesEspacio($id_producto,$espacio_usuario);
            }else{
                $movilizaciones = ProductosController::ObtenerMovilizaciones($id_producto);
            }
            $data = array(
                "movilizaciones"=>$movilizaciones
            );

            echo json_encode($data);//*/
        }

        public function TraerMovilizacionInventario(Request $request){
            $id_producto = $request['id_producto'];
            $movilizaciones = ProductosController::ObtenerMovilizaciones($id_producto);
            //dd($movilizaciones);
            $data = array(
                "movilizaciones"=>$movilizaciones
            );

            echo json_encode($data);//*/
        }

        public function ObtenerMovilizaciones($id_producto){
            /*$movilizaciones = DB::table('REL_MOVILIZACION_PRODUCTO')
                ->join('TIENDAS_MOVILIZACION_INVENTARIO', 'REL_MOVILIZACION_PRODUCTO.REL_MOV_FK_MOVILIZACION', '=', 'TIENDAS_MOVILIZACION_INVENTARIO.MOVILIZACION_ID')
                //->where(['MOVILIZACION_FK_PROCUTO'=>$id_producto,'MOVILIZACION_DESTINO'=>$id_espacio])
                ->where(['REL_MOVILIZACION_PRODUCTO.REL_MOV_FK_PROCUTO'=>$id_producto])
                ->select(
                    'TIENDAS_MOVILIZACION_INVENTARIO.MOVILIZACION_ID as ID_MOVILIZACION',
                    'TIENDAS_MOVILIZACION_INVENTARIO.MOVILIZACION_ORIGEN as ESPACIO_ORIGEN',
                    'TIENDAS_MOVILIZACION_INVENTARIO.MOVILIZACION_DESTINO as ESPACIO_DESTINO',
                    'TIENDAS_MOVILIZACION_INVENTARIO.MOVILIZACION_CANTIDAD as CANTIDAD_UNIDADES',
                    'TIENDAS_MOVILIZACION_INVENTARIO.MOVILIZACION_FECHA_MOVIMIENTO as FECHA_MOVIMIENTO',
                    'TIENDAS_MOVILIZACION_INVENTARIO.MOVILIZACION_FECHA_RECEPCION as FECHA_RECEPCION',
                    'TIENDAS_MOVILIZACION_INVENTARIO.MOVILIZACION_FECHA_CANCELACION as FECHA_CANCELACION',
                    
                    'REL_MOVILIZACION_PRODUCTO.REL_MOV_FK_EMISOR as EMISOR',
                    'REL_MOVILIZACION_PRODUCTO.REL_MOV_FK_RECEPTOR as RECEPTOR',
                    'REL_MOVILIZACION_PRODUCTO.REL_MOV_ESTATUS as ESTATUS'
                )
                ->get();//*/

            $movilizaciones = DB::table('REL_MOVILIZACION_PRODUCTO')
                ->join('TIENDAS_MOVILIZACION_INVENTARIO', function ($join) use($id_producto) {
                    //dd($id_producto);
                    $join->on('REL_MOVILIZACION_PRODUCTO.REL_MOV_FK_MOVILIZACION', '=', 'TIENDAS_MOVILIZACION_INVENTARIO.MOVILIZACION_ID')
                        ->where(['REL_MOVILIZACION_PRODUCTO.REL_MOV_FK_PROCUTO'=>$id_producto]);
                })
                ->select(
                    'TIENDAS_MOVILIZACION_INVENTARIO.MOVILIZACION_ID as ID_MOVILIZACION',
                    'TIENDAS_MOVILIZACION_INVENTARIO.MOVILIZACION_ORIGEN as ESPACIO_ORIGEN',
                    'TIENDAS_MOVILIZACION_INVENTARIO.MOVILIZACION_DESTINO as ESPACIO_DESTINO',
                    'TIENDAS_MOVILIZACION_INVENTARIO.MOVILIZACION_CANTIDAD as CANTIDAD_UNIDADES',
                    'TIENDAS_MOVILIZACION_INVENTARIO.MOVILIZACION_FECHA_MOVIMIENTO as FECHA_MOVIMIENTO',
                    'TIENDAS_MOVILIZACION_INVENTARIO.MOVILIZACION_FECHA_RECEPCION as FECHA_RECEPCION',
                    'TIENDAS_MOVILIZACION_INVENTARIO.MOVILIZACION_FECHA_CANCELACION as FECHA_CANCELACION',
                    
                    'REL_MOVILIZACION_PRODUCTO.REL_MOV_FK_EMISOR as EMISOR',
                    'REL_MOVILIZACION_PRODUCTO.REL_MOV_FK_RECEPTOR as RECEPTOR',
                    'REL_MOVILIZACION_PRODUCTO.REL_MOV_ESTATUS as ESTATUS'
                )
                ->get();//*/

            foreach ($movilizaciones as $movilizacion) {
                $movilizacion->NOMBRE_ORIGEN = EspaciosController::ObtenerNombreEspacio($movilizacion->ESPACIO_ORIGEN);
                $movilizacion->NOMBRE_DESTINO = EspaciosController::ObtenerNombreEspacio($movilizacion->ESPACIO_DESTINO);
                $movilizacion->NOMBRE_EMISOR = UsuariosController::ObtenerNombreUsuario($movilizacion->EMISOR);
                $movilizacion->NOMBRE_RECEPTOR = UsuariosController::ObtenerNombreUsuario($movilizacion->RECEPTOR);
                $movilizacion->FECHA_MOVIMIENTO = date("d/m/Y", strtotime($movilizacion->FECHA_MOVIMIENTO));
                $movilizacion->FECHA_RECEPCION = (($movilizacion->FECHA_RECEPCION)?date("d/m/Y", strtotime($movilizacion->FECHA_RECEPCION)):"");
                $movilizacion->FECHA_CANCELACION = (($movilizacion->FECHA_CANCELACION)?date("d/m/Y", strtotime($movilizacion->FECHA_CANCELACION)):"");
            }
            return $movilizaciones;
        }

        public function ObtenerMovilizacionesEspacio($id_producto,$id_espacio){
            //dd($id_espacio);
            $movilizaciones = array();
            $tmp_movilizaciones = DB::table('REL_MOVILIZACION_PRODUCTO')
                ->join('TIENDAS_MOVILIZACION_INVENTARIO', function ($join) use($id_producto,$id_espacio) {
                    //dd($id_producto);
                    $join->on('REL_MOVILIZACION_PRODUCTO.REL_MOV_FK_MOVILIZACION', '=', 'TIENDAS_MOVILIZACION_INVENTARIO.MOVILIZACION_ID')
                        ->where(['REL_MOVILIZACION_PRODUCTO.REL_MOV_FK_PROCUTO'=>$id_producto,'TIENDAS_MOVILIZACION_INVENTARIO.MOVILIZACION_DESTINO'=>$id_espacio]);
                })
                ->select(
                    'TIENDAS_MOVILIZACION_INVENTARIO.MOVILIZACION_ID as ID_MOVILIZACION',
                    'TIENDAS_MOVILIZACION_INVENTARIO.MOVILIZACION_ORIGEN as ESPACIO_ORIGEN',
                    'TIENDAS_MOVILIZACION_INVENTARIO.MOVILIZACION_DESTINO as ESPACIO_DESTINO',
                    'TIENDAS_MOVILIZACION_INVENTARIO.MOVILIZACION_CANTIDAD as CANTIDAD_UNIDADES',
                    'TIENDAS_MOVILIZACION_INVENTARIO.MOVILIZACION_FECHA_MOVIMIENTO as FECHA_MOVIMIENTO',
                    'TIENDAS_MOVILIZACION_INVENTARIO.MOVILIZACION_FECHA_RECEPCION as FECHA_RECEPCION',
                    'TIENDAS_MOVILIZACION_INVENTARIO.MOVILIZACION_FECHA_CANCELACION as FECHA_CANCELACION',
                    
                    'REL_MOVILIZACION_PRODUCTO.REL_MOV_FK_EMISOR as EMISOR',
                    'REL_MOVILIZACION_PRODUCTO.REL_MOV_FK_RECEPTOR as RECEPTOR',
                    'REL_MOVILIZACION_PRODUCTO.REL_MOV_ESTATUS as ESTATUS'
                )
                ->get();//*/
            //dd($tmp_movilizaciones);
            foreach ($tmp_movilizaciones as $movilizacion) {
                $movilizacion->NOMBRE_ORIGEN = EspaciosController::ObtenerNombreEspacio($movilizacion->ESPACIO_ORIGEN);
                $movilizacion->NOMBRE_DESTINO = EspaciosController::ObtenerNombreEspacio($movilizacion->ESPACIO_DESTINO);
                $movilizacion->NOMBRE_EMISOR = UsuariosController::ObtenerNombreUsuario($movilizacion->EMISOR);
                $movilizacion->NOMBRE_RECEPTOR = UsuariosController::ObtenerNombreUsuario($movilizacion->RECEPTOR);
                $movilizacion->FECHA_MOVIMIENTO = date("d/m/Y", strtotime($movilizacion->FECHA_MOVIMIENTO));
                $movilizacion->FECHA_RECEPCION = (($movilizacion->FECHA_RECEPCION)?date("d/m/Y", strtotime($movilizacion->FECHA_RECEPCION)):"");
                $movilizacion->FECHA_CANCELACION = (($movilizacion->FECHA_CANCELACION)?date("d/m/Y", strtotime($movilizacion->FECHA_CANCELACION)):"");
                $movilizaciones[] = $movilizacion;
            }
            return $movilizaciones;
        }

        public function RegistrarMovilizacionInventario(Request $request){
            $id_producto = $request['id_producto'];
            $tienda_origen = $request['id_tienda_origen'];
            $tienda_destino = $request['id_tienda_destino'];
            $cantidad_traspaso = $request['cantidad_traspaso'];
            $cantidad_origen = $request['cantidad_origen'];
            $usuario = \Session::get('usuario')[0];

            $nueva_cantidad = $cantidad_origen - $cantidad_traspaso;
            //dd($nueva_cantidad);
            $insert = DB::table('TIENDAS_MOVILIZACION_INVENTARIO')->insertGetId(
                [
                    //'MOVILIZACION_FK_PROCUTO' => $id_producto,
                    'MOVILIZACION_ORIGEN' => $tienda_origen,
                    'MOVILIZACION_DESTINO' => $tienda_destino,
                    'MOVILIZACION_CANTIDAD' => $cantidad_traspaso,
                    'MOVILIZACION_FECHA_MOVIMIENTO' => ProductosController::ObtenerFecha(),
                    //'MOVILIZACION_FK_EMISOR' => $usuario
                ]
            );//

            //dd($insert);


            $insert_rel = DB::table('REL_MOVILIZACION_PRODUCTO')->insert(
                [
                    //'MOVILIZACION_FK_PROCUTO' => $id_producto,
                    'REL_MOV_FK_MOVILIZACION' => $insert,
                    'REL_MOV_FK_PROCUTO' => $id_producto,
                    'REL_MOV_FK_EMISOR' => $usuario,
                    'REL_MOV_ESTATUS' => 'PENDIENTE'
                    //'MOVILIZACION_FECHA_MOVIMIENTO' => ProductosController::ObtenerFecha(),
                    //'MOVILIZACION_FK_EMISOR' => $usuario
                ]
            );//
            //dd($insert_rel);

            $update = DB::table('REL_INVENTARIO')
                ->where([
                    'DATOS_VENTA_FK_PROCUTO' => $id_producto, 
                    'DATOS_VENTA_FK_ESPACIO' => $tienda_origen
                ])
                ->update(['DATOS_VENTA_CANTIDAD' => $nueva_cantidad]);//*/

            $nombre_origen = EspaciosController::ObtenerNombreEspacio($tienda_origen);
            $nombre_destino = EspaciosController::ObtenerNombreEspacio($tienda_destino);

            $texto_historial = 'Movilización de inventario del producto '.$id_producto.', de '.$nombre_origen.' a '.$nombre_destino.'. Unidades movilizadas: '.$cantidad_traspaso;
            ProductosController::RegistraHistorialProducto($id_producto,$texto_historial);

            $data = array(
                "insert"=>$insert,
                "update"=>$update,
                "texto_historial"=>$texto_historial
            );

            echo json_encode($data);//*/
        }

        public function ObtenerDatosMovilizacion($id_movilizacion){
            $movilizacion = DB::table('REL_MOVILIZACION_PRODUCTO')
                ->join('TIENDAS_MOVILIZACION_INVENTARIO', 'REL_MOVILIZACION_PRODUCTO.REL_MOV_FK_MOVILIZACION', '=', 'TIENDAS_MOVILIZACION_INVENTARIO.MOVILIZACION_ID')
                //->where(['MOVILIZACION_FK_PROCUTO'=>$id_producto,'MOVILIZACION_DESTINO'=>$id_espacio])
                ->where(['REL_MOVILIZACION_PRODUCTO.REL_MOV_FK_MOVILIZACION'=>$id_movilizacion])
                /*->select(
                    'TIENDAS_MOVILIZACION_INVENTARIO.MOVILIZACION_ID as ID_MOVILIZACION',
                    'TIENDAS_MOVILIZACION_INVENTARIO.MOVILIZACION_ORIGEN as ESPACIO_ORIGEN',
                    'TIENDAS_MOVILIZACION_INVENTARIO.MOVILIZACION_DESTINO as ESPACIO_DESTINO',
                    'TIENDAS_MOVILIZACION_INVENTARIO.MOVILIZACION_CANTIDAD as CANTIDAD_UNIDADES',
                    'TIENDAS_MOVILIZACION_INVENTARIO.MOVILIZACION_FECHA_MOVIMIENTO as FECHA_MOVIMIENTO',
                    'TIENDAS_MOVILIZACION_INVENTARIO.MOVILIZACION_FECHA_RECEPCION as FECHA_RECEPCION',
                    'TIENDAS_MOVILIZACION_INVENTARIO.MOVILIZACION_FECHA_CANCELACION as FECHA_CANCELACION',
                    
                    'REL_MOVILIZACION_PRODUCTO.REL_MOV_FK_EMISOR as EMISOR',
                    'REL_MOVILIZACION_PRODUCTO.REL_MOV_FK_RECEPTOR as RECEPTOR',
                    'REL_MOVILIZACION_PRODUCTO.REL_MOV_ESTATUS as ESTATUS'
                )//*/
                ->get();//*/

                return $movilizacion;
        }

        public function ObtenerHistoriaId($id){
            $historial = DB::table('TIENDAS_HISTORIAL')
                ->where('HISTORIAL_ID',$id)
                ->select(
                    'HISTORIAL_ID as ID_HISTORIAL',
                    'HISTORIAL_TEXTO as TEXTO_HISTORIAL',
                    'created_at as FECHA_HISTORIAL'
                )
                ->get();

            if(count($historial)){
                return $historial[0];
            }else{
                return null;
            }
        }

        public function ObtenerHistorialProductos(Request $request){
            $historial = array();
            $id_producto = $request['id_producto'];
            $rel_historial = DB::table('REL_HISTORIAL_PRODUCTO')
            ->where('FK_PROCUTO',$id_producto)
            ->get();
            foreach ($rel_historial as $relacion) {
                $historial[
                ] = ProductosController::ObtenerHistoriaId($relacion->FK_HISTORIAL);
            }
            $data = array(
                "historial"=>$historial
            );

            echo json_encode($data);//*/

        }

        public static function RegistraHistorialProducto($id_producto,$texto_historial){
            $usuario = \Session::get('usuario')[0];
            $fecha = ProductosController::ObtenerFechaHora();
            $texto = $usuario.' - '.$texto_historial;
            $id_historial = DB::table('TIENDAS_HISTORIAL')->insertGetId([
                    'HISTORIAL_TEXTO'=>$texto,
                    'created_at' => $fecha
                ]);

            if($id_historial){
                DB::table('REL_HISTORIAL_PRODUCTO')
                    ->insert([
                        'FK_PROCUTO' => $id_producto,
                        'FK_HISTORIAL' => $id_historial
                    ]);
            }

        }

        public function RegistrarNotaVenta(Request $request){
            //dd($request);
            $id_producto = $request['id_producto'];
            $cantidad = $request['cantidad'];
            $precio_compra = $request['precio_compra'];
            $select_bodega = $request['select_bodega'];
            $observaciones = $request['observaciones'];

            //insertamos la nota de entrada
            $id_nota = DB::table('TIENDAS_NOTA_ENTRADA')->insertGetId(
                [
                    'NOTA_ENTRADA_PRECIO_COMPRA' => $precio_compra,
                    'NOTA_ENTRADA_CANTIDAD' => $cantidad,
                    'NOTA_ENTRADA_OBSERVACIONES' => $observaciones,
                    'created_at' => ProductosController::ObtenerFechaHora(),
                    
                ]
            );

            //insertamos la relacion de nota de entrada
            DB::table('REL_PRODUCTO_NOTA_ENTRADA')->insert(
                [
                    'FK_PROCUTO' => $id_producto,
                    'FK_NOTA_ENTRADA' => $id_nota
                ]
            );

            //verificamos si ya existe un registro en inventario
            $existe_inventario = DB::table('REL_INVENTARIO')
                ->where([
                            'DATOS_VENTA_FK_PROCUTO'=> $id_producto,
                            'DATOS_VENTA_FK_ESPACIO'=> $select_bodega
                        ])
                ->get();

            //dd($existe_inventario);
            //si no existe la relacion, creamos una nueva
            if(count($existe_inventario)==0){
                DB::table('REL_INVENTARIO')->insert(
                    [
                        'DATOS_VENTA_FK_PROCUTO' => $id_producto,
                        'DATOS_VENTA_FK_ESPACIO' => $select_bodega,
                        'DATOS_VENTA_CANTIDAD' => $cantidad
                    ]
                );//*/
            }else{//en caso contrario solo le sumamos la cantidad registrada
                $nueva_cantidad = $existe_inventario[0]->DATOS_VENTA_CANTIDAD + $cantidad;
                //dd($nueva_cantidad);
                DB::table('REL_INVENTARIO')
                    ->where([
                                'DATOS_VENTA_FK_PROCUTO' => $id_producto,
                                'DATOS_VENTA_FK_ESPACIO' => $select_bodega
                            ])
                    ->update(['DATOS_VENTA_CANTIDAD' => $nueva_cantidad]);
                //dd($nueva_cantidad);
            }

            $texto_historial = 'Se ha registrado la nota de venta '.$id_nota.'. La nota de venta se ha enlazado al producto '.$id_producto;
            ProductosController::RegistraHistorialProducto($id_producto,$texto_historial);
            
            $data = array(
                "id_nota"=>$id_nota
            );

            echo json_encode($data);//*/
        }

        public function RegresarDatosProducto(Request $request){
            $id_producto = $request['id_producto'];
            $producto = ProductosController::ObtenerProductoId($id_producto);
            //dd($producto);
            $data = array(
                "producto"=>$producto
            );

            echo json_encode($data);//*/
        }

        //la siguiente función regresa el inventario de productos de una tienda por su ID
        public static function ObtenerInventarioEspacioId($id_espacio){
            $inventario = array();
            $rel_inventario = DB::table('REL_INVENTARIO')
                ->where('DATOS_VENTA_FK_ESPACIO',$id_espacio)
                ->get();
            foreach ($rel_inventario as $relacion) {
                //$id_espacio = $relacion->DATOS_VENTA_FK_ESPACIO;
                $id_producto = $relacion->DATOS_VENTA_FK_PROCUTO;
                $nombre_producto = ProductosController::ObtenerNombreProductoId($id_producto);
                $relacion->NOMBRE_PRODUCTO = $nombre_producto;
                //dd($nombre_producto);
            }
            dd($rel_inventario);
        }

        //esta funcion solo regresa las existencias en espacios que tengan productos, es decir, si una tienda no cuenta con el producto, esta no aparecerá en la lista
        public function ObtenerExistenciasCompletas($id_producto){
            $inventario = DB::table('REL_INVENTARIO')
                ->where('DATOS_VENTA_FK_PROCUTO',$id_producto)
                ->select(
                            'DATOS_VENTA_FK_ESPACIO as ESPACIO_EXISTENCIAS',
                            'DATOS_VENTA_CANTIDAD as CANTIDAD_EXISTENCIAS',
                            'DATOS_VENTA_INVENTARIO_MINIMO as MINIMO_EXISTENCIAS'
                        )
                ->get();
            //dd($inventario);
            foreach ($inventario as $producto) {
                //dd($producto->ESPACIO_EXISTENCIAS);
                $producto->ESPACIO_EXISTENCIAS = EspaciosController::ObtenerNombreEspacio($producto->ESPACIO_EXISTENCIAS);
            }
            //dd($inventario);
            return $inventario;
        }

        //esta función obtendrá todas las tiendas que existen y si una de ellas no tiene el producto, aparecerá pero en existencias regresará 0
        public function ObtenerExistenciasCompletasTodasTiendas($id_producto){
            $inventario = array();
            $espacios = DB::table('TIENDAS_ESPACIOS')->get();

            foreach ($espacios as $espacio) {
                $tmp_existencias = DB::table('REL_INVENTARIO')
                    ->where([
                                'DATOS_VENTA_FK_PROCUTO'=>$id_producto,
                                'DATOS_VENTA_FK_ESPACIO'=>$espacio->ESPACIO_ID
                            ])
                    ->get();
                //dd($tmp_existencias);
                $tmp = array();
                if(count($tmp_existencias)>0){
                    $tmp['ID_ESPACIO'] = $espacio->ESPACIO_ID;
                    $tmp['CANTIDAD_EXISTENCIAS'] = $tmp_existencias[0]->DATOS_VENTA_CANTIDAD;
                    $tmp['MINIMO_EXISTENCIAS'] = $tmp_existencias[0]->DATOS_VENTA_INVENTARIO_MINIMO;
                    $tmp['ESPACIO_EXISTENCIAS'] = $espacio->ESPACIO_NOMBRE;
                }else{
                    $tmp['ID_ESPACIO'] = $espacio->ESPACIO_ID;
                    $tmp['CANTIDAD_EXISTENCIAS'] = 0;
                    $tmp['MINIMO_EXISTENCIAS'] = 0;
                    $tmp['ESPACIO_EXISTENCIAS'] = $espacio->ESPACIO_NOMBRE;
                }
                $inventario[]=$tmp;
            }
            //$inventario = (object) $inventario;
            //dd($inventario);
            return $inventario;
        }

        //la siguiente funcion recibe el id de un producto y verifica el inventario con el id del espacio almacenado en las variables de sesión
        public function ObtenerExistenciasProductoId($id_producto){
            $id_espacio = \Session::get('id_tienda')[0];
            $rel_inventario = DB::table('REL_INVENTARIO')
                ->where([
                            'DATOS_VENTA_FK_ESPACIO'=>$id_espacio,
                            'DATOS_VENTA_FK_PROCUTO'=>$id_producto
                        ])
                ->get();
            //dd($rel_inventario);
            if(count($rel_inventario)>0){
                /*if($rel_inventario[0]->DATOS_VENTA_CANTIDAD>0){
                    dd('HAY DE DONDE');

                }else{
                    dd('YA SE ACABARON ::O');
                }//*/
                return $rel_inventario[0]->DATOS_VENTA_CANTIDAD;
            }else{
                return 0;
            }

        }

        public function RegresarInventarioTiendas(Request $request){
            $id_producto = $request['id_producto'];
            $inventario = ProductosController::ObtenerExistenciasCompletasTodasTiendas($id_producto);

            $data = array(
                "inventario"=>$inventario
            );
            echo json_encode($data);//*/
        }

        public function ObtenerNotasEntrada($id_producto){
            $notas = array();
            //dd($id_producto);
            $rel_notas = DB::table('REL_PRODUCTO_NOTA_ENTRADA')
                ->where('FK_PROCUTO',$id_producto)
                ->get();
            //dd($rel_notas);
            foreach ($rel_notas as $nota) {
                $tmp_nota = DB::table('TIENDAS_NOTA_ENTRADA')
                    ->where('NOTA_ENTRADA_ID',$nota->FK_NOTA_ENTRADA)
                    ->get();
                //dd($tmp_nota[0]);
                $notas[] = $tmp_nota[0];
            }
            //dd($notas);
            return $notas;
        }

        public static function ObtenerNombreProductoId($id_producto){
            //dd('epale');
            $producto = DB::table('TIENDAS_PRODUCTOS')
                ->where('PRODUCTOS_ID',$id_producto)
                ->select(
                    'PRODUCTOS_NOMBRE as NOMBRE_PRODUCTO'
                )
                ->get();
            if(count($producto)>0){
                return $producto[0]->NOMBRE_PRODUCTO;
            }else{
                return null;
            }
        }

        public function ObtenerProductoId($id_producto){
            //$id_producto = 5000;
            $producto = DB::table('TIENDAS_PRODUCTOS')
                ->where('PRODUCTOS_ID',$id_producto)
                ->select(
                    'PRODUCTOS_NOMBRE as NOMBRE_PRODUCTO',
                    'PRODUCTOS_COLOR as COLOR_PRODUCTO',
                    'PRODUCTOS_GENERO as GENERO_PRODUCTO',
                    'PRODUCTOS_TALLA as TALLA_PRODUCTO',
                    'PRODUCTOS_OBSERVACIONES as OBSERVACIONES_PRODUCTO',
                    'created_at as FECHA_REGISTRO'
                )
                ->get();
            
            //dd($producto);
            if(count($producto)>0){
                $datos = DB::table('TIENDAS_DATOS_VENTA_PRODUCTO')
                ->where('DATOS_VENTA_FK_PROCUTO',$id_producto)
                ->get();
                $producto[0]->FECHA_REGISTRO = date("d/m/Y", strtotime($producto[0]->FECHA_REGISTRO));
                $producto[0]->PRECIO_SIN_DESCUENTO = $datos[0]->DATOS_VENTA_PRECIO;
                $producto[0]->DESCUENTO_PRODUCTO = $datos[0]->DATOS_VENTA_DESCUENTO;
                $producto[0]->PRECIO_VENTA = $datos[0]->DATOS_VENTA_PRECIO - (($datos[0]->DATOS_VENTA_DESCUENTO/100) * $datos[0]->DATOS_VENTA_PRECIO);
                //dd($producto);
                //obenemos existencias en tiendas
                $producto[0]->INVENTARIO = ProductosController::ObtenerExistenciasCompletas($id_producto);
                $producto[0]->INVENTARIO_SESION = ProductosController::ObtenerExistenciasProductoId($id_producto);
                //dd($producto[0]->INVENTARIO_SESION);
                //$producto[0]->EXTISTENCIAS_ESPACIO = 
                //$producto[0]->INVENTARIO = ProductosController::ObtenerExistenciasCompletasTodasTiendas($id_producto);
                $producto[0]->TOTAL_NOTAS_ENTRADA = count(ProductosController::ObtenerNotasEntrada($id_producto));

                return $producto[0];
            }else{
                return null;
            }
        }

        public function ObtenerProductos(){
            $productos = array();
            $id_productos = DB::table('TIENDAS_PRODUCTOS')
                ->select('PRODUCTOS_ID')
                ->get();
            foreach ($id_productos as $producto) {
                $productos[] =  ProductosController::ObtenerProductoId($producto->PRODUCTOS_ID);
            }
        }

        public function VistaListadoProductos(){
            $productos = DB::table('TIENDAS_PRODUCTOS')->get();
            $bodegas = DB::table('TIENDAS_ESPACIOS')->where('ESPACIO_TIPO','BODEGA')->get();
            //dd($productos);
            return view('listado_productos') ->with (["productos"=>$productos,"bodegas"=>$bodegas]);
            /*

            categoria = \Session::get('categoria')[0];
            if(in_array($categoria, ['ADMINISTRADOR_CGA','ANALISTA_CGA'])){
                $solicitudes = SolicitudesController::ObtenerSolicitudesEstatus('VALIDACION DE INFORMACION');
                return view('listado_revision_informacion') ->with ("solicitudes",$solicitudes);
            }else{
                return view('errors.505');
            }
            */
        }

        public function ActualizarDatosVenta(Request $request){
            //dd($request['precio']);
            $update = DB::table('TIENDAS_DATOS_VENTA_PRODUCTO')
                ->where('DATOS_VENTA_FK_PROCUTO', $request['id_producto'])
                ->update([
                    'DATOS_VENTA_PRECIO' => $request['precio'],
                    'DATOS_VENTA_DESCUENTO' => $request['descuento']
                ]);

            $texto_historial = 'Se ha actualizado los datos de venta del producto '.$request['producto']." Precio: $".$request['precio'].", Descuento: ".$request['descuento']."%";
            ProductosController::RegistraHistorialProducto($request['id_producto'],$texto_historial);

            $data = array(
                "update"=>$update
            );
            echo json_encode($data);//*/
        }

        public function ActualizarDatosProducto(Request $request){
            $update = DB::table('TIENDAS_PRODUCTOS')
                ->where('PRODUCTOS_ID', $request['id_producto'])
                ->update([
                    'PRODUCTOS_NOMBRE' => $request['producto'],
                    'PRODUCTOS_COLOR' => $request['color'],
                    'PRODUCTOS_GENERO' => $request['genero'],
                    'PRODUCTOS_TALLA' => $request['talla'],
                    'PRODUCTOS_OBSERVACIONES' => $request['observaciones'],
                    'updated_at' => ProductosController::ObtenerFechaHora()
                ]);

            $texto_historial = 'Se ha editado los datos del producto '.$request['producto'];
            ProductosController::RegistraHistorialProducto($request['id_producto'],$texto_historial);

            $data = array(
                "update"=>$update
            );

            echo json_encode($data);//*/
        }

        public function RegistrarProducto(Request $request){
            //dd($request);
            $id_producto = DB::table('TIENDAS_PRODUCTOS')->insertGetId(
                [
                    'PRODUCTOS_NOMBRE' => $request['producto'],
                    'PRODUCTOS_COLOR' => $request['color'],
                    'PRODUCTOS_GENERO' => $request['genero'],
                    'PRODUCTOS_TALLA' => $request['talla'],
                    'PRODUCTOS_OBSERVACIONES' => $request['observaciones'],
                    'created_at' => ProductosController::ObtenerFechaHora()

                ]
            );
            $texto_historial = 'Se ha creado el producto '.$request['producto'].'. El codigo asignado por el sistema es '.$id_producto;
            ProductosController::RegistraHistorialProducto($id_producto,$texto_historial);
            //dd($id_producto);
            DB::table('TIENDAS_DATOS_VENTA_PRODUCTO')->insert(
                [
                    'DATOS_VENTA_FK_PROCUTO' => $id_producto,
                    'DATOS_VENTA_PRECIO' => $request['precio'],
                    'DATOS_VENTA_DESCUENTO' => 0
                ]
            );
            $data = array(
                "id_producto"=>$id_producto
            );

            echo json_encode($data);//*/
        }

        public static function ObtenerFechaHora(){
            date_default_timezone_set('America/Mexico_City');
            return date('Y-m-d H:i:s');
        }

        public static function ObtenerFecha(){
            date_default_timezone_set('America/Mexico_City');
            return date('Y-m-d');
        }

    }
