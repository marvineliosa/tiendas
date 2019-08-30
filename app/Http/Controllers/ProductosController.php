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

        public function ImprimirCodigo($codigo){
            $producto = ProductosController::ObtenerProductoId($codigo);
            //dd($producto);
            return view('pdf.impresion_codigos') ->with (["producto"=>$producto]);

        }

        public function AlmacenarDevolucion(Request $request){
            $usuario = \Session::get('usuario')[0];
            $mensaje = '';
            $exito = false;
            //dd($usuario);//
            //dd($request);
            //verificamos si el articulo a devolver ya se ha devuelto con anterioridad
            $fl_dev = ProductosController::VerificaDevoluciones1($request['id_venta'],$request['id_producto_devolver'],$request['id_producto_cambio']);
            //dd($fl_dev);
            //recibimos true o false, donde true es que ya existe una devolucion y false significa que podemos continuar con el registro de devolucion
            if(!$fl_dev){
                $id_devolucion = DB::table('TIENDAS_DEVOLUCIONES')->insertGetId(
                    [
                        'DEVOLUCIONES_PROCUTO_ID' => $request['id_producto_devolver'],
                        'DEVOLUCIONES_CANTIDAD' => $request['cantidad_devolucion'],
                        'created_at' => ProductosController::ObtenerFechaHora()
                    ]
                );

                $id_cambio = DB::table('TIENDAS_DEVOLUCIONES')->insertGetId(
                    [
                        'DEVOLUCIONES_PROCUTO_ID' => $request['id_producto_cambio'],
                        'DEVOLUCIONES_CANTIDAD' => $request['cantidad_cambio'],
                        'created_at' => ProductosController::ObtenerFechaHora()
                    ]
                );

                //dd('-> '.$id_devolucion.' -> '.$id_cambio);
                DB::table('REL_DEVOLUCIONES')->insert([
                    [
                        'FK_VENTA' => $request['id_venta'],
                        'FK_DEV_PROD_INICIAL' => $id_devolucion,
                        'FK_DEV_PROD_CAMBIO' => $id_cambio,
                        'FK_USUARIO' => $usuario,
                        'REL_DEV_MOTIVO' => $request['motivo_devolucion'],
                    ]
                ]);
                $mensaje = "La devolución se ha realizado satisfactoriamente";
                $exito = true;
            }else{
                $mensaje = 'El producto seleccionado ya ha sido devuelto con anterioridad';
            }

            $data = array(
                "exito"=>$exito,
                "mensaje"=>$mensaje
            );

            echo json_encode($data);//*/

        }

        public function VerificaDevoluciones1($id_venta,$id_devuelto,$id_cambio){
            $fl_existe = true;
            $rel_devoluciones = DB::table('REL_DEVOLUCIONES')
                ->where([
                            'FK_VENTA'=>$id_venta
                        ])
                ->get();
            if(count($rel_devoluciones) > 0){
                dd($rel_devoluciones);
            }else{
                $fl_existe = false;
            }
            return $fl_existe;
        }

        public function ObtenerDetalleVenta(Request $request){
            //dd($request['id_venta']);
            $id_venta = $request['id_venta'];
            $datos = ProductosController::ObtenerDatosVenta($id_venta);
            //dd($datos);

            $data = array(
                "datos"=>$datos
            );

            echo json_encode($data);//*/
        }

        public function ReiniciarConteo(Request $request){
            //$cantidad = $request['cantidad'];
            $select_bodega = $request['espacio'];
            $id_producto = $request['id_producto'];
            $update = DB::table('REL_CONTEO_INVENTARIO')
                ->where([
                            'CONTEO_FK_PROCUTO' => $id_producto,
                            'CONTEO_FK_ESPACIO' => $select_bodega
                        ])
                ->update([
                    'CONTEO_CANTIDAD' => 0,
                    'created_at' => ProductosController::ObtenerFechaHora(),
                    'updated_at' => null
                ]);
            $data = array(
                "update"=>$update
            );

            echo json_encode($data);//*/
        }

        public function GuardarConteo(Request $request){
            //dd($request);
            $cantidad = $request['cantidad'];
            $espacio = $request['espacio'];
            $producto = $request['id_producto'];

            $nueva_cantidad = ProductosController::AumentarConteo($producto,$espacio,$cantidad);

            //dd($nueva_cantidad);
            $data = array(
                "nueva_cantidad"=>$nueva_cantidad
            );

            echo json_encode($data);//*/
        }

        public function AumentarConteo($id_producto,$select_bodega,$cantidad){
            $nueva_cantidad = $cantidad;
            //verificamos si ya existe un registro en inventario
            $existe_inventario = DB::table('REL_CONTEO_INVENTARIO')
                ->where([
                            'CONTEO_FK_PROCUTO'=> $id_producto,
                            'CONTEO_FK_ESPACIO'=> $select_bodega
                        ])
                ->get();

            //dd($existe_inventario);
            //si no existe la relacion, creamos una nueva
            if(count($existe_inventario)==0){
                DB::table('REL_CONTEO_INVENTARIO')->insert(
                    [
                        'CONTEO_FK_PROCUTO'=> $id_producto,
                        'CONTEO_FK_ESPACIO'=> $select_bodega,
                        'CONTEO_CANTIDAD' => $cantidad,
                        'created_at' => ProductosController::ObtenerFechaHora()
                    ]
                );//*/
            }else{//en caso contrario solo le sumamos la cantidad registrada
                //$nueva_cantidad = $existe_inventario[0]->CONTEO_CANTIDAD + $cantidad;
                //dd($nueva_cantidad);
                DB::table('REL_CONTEO_INVENTARIO')
                    ->where([
                                'CONTEO_FK_PROCUTO' => $id_producto,
                                'CONTEO_FK_ESPACIO' => $select_bodega
                            ])
                    ->update([
                        'CONTEO_CANTIDAD' => $cantidad,
                        'updated_at' => ProductosController::ObtenerFechaHora()
                    ]);
                //dd($nueva_cantidad);
            }
            return $cantidad;
        }

        public function RegresarConteo(Request $request){
            $id_producto = $request['id_producto'];
            $id_espacio = $request['id_espacio'];
            $conteo = ProductosController::ObtenerConteo($id_producto,$id_espacio);
            $producto = ProductosController::ObtenerProductoId($id_producto);
            $data = array(
                "conteo"=>$conteo,
                "producto"=>$producto
            );

            echo json_encode($data);//*/
        }

        public function ObtenerConteo($id_producto,$id_espacio){
            $conteo = DB::table('REL_CONTEO_INVENTARIO')
                ->where(['CONTEO_FK_PROCUTO'=>$id_producto,'CONTEO_FK_ESPACIO'=>$id_espacio])
                ->get();
            return ((count($conteo)>0)?$conteo[0]:$conteo);
            //dd($ventas);
        }

        public function CrearReporteIntervalo(Request $request){
            //dd($request['fecha_fin']);
            $fecha_inicio = str_replace('/', '-', $request['fecha_inicio']);
            //echo date('Y-m-d', strtotime($date));
            $fecha_inicio = date("Y-m-d", strtotime($fecha_inicio));

            $fecha_fin = str_replace('/', '-', $request['fecha_fin']);
            $fecha_fin = date("Y-m-d", strtotime($fecha_fin));
            //$fecha_fin = $request['fecha_fin'];
            //dd($fecha_inicio.'/'.$fecha_fin);
            //date("Y-m-d", strtotime($var) )
            $ventas = DB::table('TIENDAS_VENTAS')
                     //->select('VENTAS_ID')
                     //->whereIn('DATOS_CGA_ESTATUS',$array_estatus)
                     ->whereBetween('created_at', [$fecha_inicio, $fecha_fin])
                     ->orderBy('created_at','desc')
                     ->get();
            //dd($ventas);

            foreach ($ventas as $venta) {
                //dd($venta->created_at);
                $formato = ProductosController::DarFormatoConsecutivo2($venta->VENTAS_CONSECUTIVO_ANUAL, $venta->created_at);
                //$formato = ProductosController::DarFormatoConsecutivo($venta->VENTAS_ID, $venta->created_at);
                $venta->VENTAS_CONSECUTIVO_ANUAL = $formato;
            }
            //dd($ventas);

            $data = array(
                "ventas"=>$ventas
            );

            echo json_encode($data);//*/
        }

        public function ObtenerDatosVenta($id_venta){
            //$id_venta = 1;
            //dd($id_venta);
            $ventas = DB::table('REL_VENTA_PRODUCTO')
                ->join('TIENDAS_VENTAS', function ($join) use($id_venta){
                    $join->on('REL_VENTA_PRODUCTO.REL_VENTA_FK_VENTA','=','TIENDAS_VENTAS.VENTAS_ID')
                        ->where(['REL_VENTA_PRODUCTO.REL_VENTA_FK_VENTA' => $id_venta,'TIENDAS_VENTAS.VENTAS_ID'=>$id_venta]);
                })
                ->select(
                    //'REL_VENTA_PRODUCTO.REL_VENTA_FK_VENTA as FK_VENTA',
                    'REL_VENTA_PRODUCTO.REL_VENTA_FK_PROCUTO as FK_PROCUTO',
                    'REL_VENTA_PRODUCTO.REL_VENTA_FK_ESPACIO as FK_ESPACIO',
                    'REL_VENTA_PRODUCTO.REL_VENTA_FK_USUARIO as FK_USUARIO',
                    'REL_VENTA_PRODUCTO.REL_VENTA_PRECIO as PRECIO_VENTA',
                    'REL_VENTA_PRODUCTO.REL_VENTA_CANTIDAD as CANTIDAD_VENTA',
                    'TIENDAS_VENTAS.VENTAS_ID as ID_VENTA',
                    'TIENDAS_VENTAS.VENTAS_TIPO_PAGO as TIPO_PAGO',
                    'TIENDAS_VENTAS.VENTAS_CONSECUTIVO_DIARIO as CONSECUTIVO_DIARIO',
                    'TIENDAS_VENTAS.VENTAS_CONSECUTIVO_ANUAL as CONSECUTIVO_ANUAL',
                    'REL_VENTA_PRODUCTO.created_at as FECHA_CREACION'
                )
                ->get();//*/

                foreach ($ventas as $venta) {
                    $venta->NOMBRE_PRODUCTO = ProductosController::ObtenerNombreProductoId($venta->FK_PROCUTO);
                }
            return $ventas;
            //dd($ventas);
        }

        public function VistaReporteVentas(){

            return view('reporte_ventas');
        }

        public function VistaRegistrarInventario(){
            //$espacios = array();
            $espacios = EspaciosController::ObtenerListadoEspacios();
            //return view('aceptacion_terminos_titular')->with (["datos"=>$datos]);
            return view('inventario')->with(['espacios'=>$espacios]);
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

            $venta = json_decode($request['venta']);
            //dd($venta->total);
            $total = $venta->total;
            $venta = $venta->venta;
            $fecha = ProductosController::ObtenerFechaHora();
            //dd($total);
            //dd($venta[1]->id_producto);
            //dd($venta);
            $id_venta = ProductosController::InsertarVenta('TARJETA DÉBITO',$venta,$total);

            $consecutivo_formato = ProductosController::DarFormatoConsecutivo($id_venta,$fecha);
            $data = array(
                "id_nota"=>$consecutivo_formato
            );

            echo json_encode($data);//*/
        }

        public function AlmacenarVentaCredito(Request $request){
            //dd($request['venta']);
            $venta = json_decode($request['venta']);
            //dd($venta->venta);
            $total = $venta->total;
            $venta = $venta->venta;
            $fecha = ProductosController::ObtenerFechaHora();
            //dd($venta[1]->id_producto);
            //dd($venta);
            $id_venta = ProductosController::InsertarVenta('TARJETA CRÉDITO',$venta,$total);

            $consecutivo_formato = ProductosController::DarFormatoConsecutivo($id_venta,$fecha);
            $data = array(
                "id_nota"=>$consecutivo_formato
            );

            echo json_encode($data);//*/
        }

        public function AlmacenarVentaEfectivo(Request $request){
            //dd($request['venta']);
            $venta = json_decode($request['venta']);
            //dd($venta->venta);
            $total = $venta->total;
            $venta = $venta->venta;
            $fecha = ProductosController::ObtenerFechaHora();
            //dd($venta[1]->id_producto);
            //dd($venta);
            $id_venta = ProductosController::InsertarVenta('EFECTIVO',$venta,$total);

            $consecutivo_formato = ProductosController::DarFormatoConsecutivo($id_venta,$fecha);
            $data = array(
                "id_nota"=>$consecutivo_formato
            );

            echo json_encode($data);//*/
        }

        public function AlmacenarVentaMixto(Request $request){
            //dd($request['venta']);
            $venta = json_decode($request['venta']);
            //dd($venta);
            $pagos = $venta->pagos;
            $total = $venta->total;
            $venta = $venta->venta;
            $fecha = ProductosController::ObtenerFechaHora();
            //dd($venta[1]->id_producto);
            //dd($pagos->debito);
            $id_venta = ProductosController::InsertarVenta('MIXTO',$venta,$total);
            //ProductosController::InsertarDatosPagoMixto($id_venta,$pagos);
            DB::table('REL_PAGO_MIXTO')->insert(
                [
                    'PAGO_MIXTO_FK_VENTA' => $id_venta,
                    'PAGO_MIXTO_EFECTIVO' => $pagos->efectivo,
                    'PAGO_MIXTO_CREDITO' => $pagos->credito,
                    'PAGO_MIXTO_DEBITO' => $pagos->debito,
                    'created_at' => $fecha
                ]
            );//*/

            $consecutivo_formato = ProductosController::DarFormatoConsecutivo($id_venta,$fecha);
            $data = array(
                "id_nota"=>$consecutivo_formato
            );

            echo json_encode($data);//*/
        }

        public function AlmacenarVentaTransferencia(Request $request){
            //dd($request['venta']);
            $venta = json_decode($request['venta']);
            //dd($venta);
            $operacion = $venta->operacion;
            $total = $venta->total;
            $venta = $venta->venta;
            $fecha = ProductosController::ObtenerFechaHora();
            //dd($venta[1]->id_producto);
            //dd($pagos->debito);
            $id_venta = ProductosController::InsertarVenta('TRANSFERENCIA',$venta,$total);
            //ProductosController::InsertarDatosPagoMixto($id_venta,$pagos);
            DB::table('REL_PAGO_TRANSFERENCIA')->insert(
                [
                    'PAGO_TRANSFERENCIA_FK_VENTA' => $id_venta,
                    'PAGO_TRANSFERENCIA_OPERACION' => $operacion,
                    'created_at' => $fecha
                ]
            );//*/

            $consecutivo_formato = ProductosController::DarFormatoConsecutivo($id_venta,$fecha);
            $data = array(
                "id_nota"=>$consecutivo_formato
            );

            echo json_encode($data);//*/
        }

        public function AlmacenarVentaDeposito(Request $request){
            //dd($request['venta']);
            $venta = json_decode($request['venta']);
            //dd($venta);
            $ficha = $venta->ficha;
            $total = $venta->total;
            $venta = $venta->venta;
            $fecha = ProductosController::ObtenerFechaHora();
            //dd($venta[1]->id_producto);
            //dd($pagos->debito);
            $id_venta = ProductosController::InsertarVenta('DEPÓSITO',$venta,$total);
            //ProductosController::InsertarDatosPagoMixto($id_venta,$pagos);
            DB::table('REL_PAGO_DEPOSITO')->insert(
                [
                    'PAGO_DEPOSITO_FK_VENTA' => $id_venta,
                    'PAGO_DEPOSITO_FICHA' => $ficha,
                    'created_at' => $fecha
                ]
            );//*/

            $consecutivo_formato = ProductosController::DarFormatoConsecutivo($id_venta,$fecha);
            $data = array(
                "id_nota"=>$consecutivo_formato
            );

            echo json_encode($data);//*/
        }

        public function AlmacenarVentaNomina(Request $request){
            //dd($request['venta']);
            $venta = json_decode($request['venta']);
            $id_trabajador = $request['id_trabajador'];
            $nombre_trabajador = $request['nombre_trabajador'];
            $quincenas = $request['quincenas'];
            //dd($quincenas);
            $total = $venta->total;
            $venta = $venta->venta;
            $fecha = ProductosController::ObtenerFechaHora();
            //dd($venta[1]->id_producto);
            //dd($pagos->debito);
            $id_venta = ProductosController::InsertarVenta('NÓMINA',$venta,$total);
            //ProductosController::InsertarDatosPagoMixto($id_venta,$pagos);
            DB::table('REL_PAGO_NOMINA')->insert(
                [
                    'PAGO_NOMINA_FK_VENTA' => $id_venta,
                    'PAGO_NOMINA_ID_TRAB' => $id_trabajador,
                    'PAGO_NOMINA_NOMBRE_TRAB' => $nombre_trabajador,
                    'PAGO_NOMINA_QUINCENAS_TRAB' => $quincenas,
                    'created_at' => $fecha
                ]
            );//*/

            for($i=0; $i<$quincenas; $i++){
                $id_quincena = DB::table('TIENDAS_QUINCENAS')->insertGetId(
                    [
                        'QUINCENAS_ESTATUS' => 'PENDIENTE',
                        'created_at' => $fecha
                    ]
                );
                DB::table('REL_QUINCENAS_VENTA')->insert(
                    [
                        'REL_QUINCENAS_FK_VENTA' => $id_venta,
                        'REL_QUINCENAS_FK_QUINCENA' => $id_quincena
                    ]
                );
            }

            //dd('epale');

            $consecutivo_formato = ProductosController::DarFormatoConsecutivo($id_venta,$fecha);
            $data = array(
                "id_nota"=>$consecutivo_formato
            );

            echo json_encode($data);//*/
        }

        public function InsertarVenta($tipo_pago,$listado_venta,$total){
            $espacio = \Session::get('id_tienda')[0];
            //dd($total);
            //bloqueamos las tablas para que no haya un conflicto al crear alguno de los datos únicos
            DB::raw('lock tables SOLICITUDES_SOLICITUD write');

            //obtenemos el consecutivo anual
            $consecutivo_anual = ProductosController::ObtenerConsecutivoAnual();
            //dd('Consecutivo anual: '.$consecutivo_anual);
            //insertamos la venta en la tabla de ventas
            $id_venta = DB::table('TIENDAS_VENTAS')->insertGetId(
                [
                    'VENTAS_TIPO_PAGO' => $tipo_pago,
                    'VENTAS_CONSECUTIVO_ANUAL' => $consecutivo_anual,
                    'VENTAS_TOTAL' => $total,
                    'created_at' => ProductosController::ObtenerFechaHora()
                ]
            );//*/

            //insertamos cada producto vendido en la tabla de relaciones
            foreach ($listado_venta as $listado) {
                DB::table('REL_VENTA_PRODUCTO')->insert(
                    [
                        'REL_VENTA_FK_VENTA' => $id_venta,
                        'REL_VENTA_FK_PROCUTO' => $listado->id_producto,
                        'REL_VENTA_FK_ESPACIO' => $espacio,
                        'REL_VENTA_FK_USUARIO' => \Session::get('usuario')[0],
                        'REL_VENTA_PRECIO' => $listado->precio_venta,
                        'REL_VENTA_CANTIDAD' => $listado->cantidad,
                        'created_at' => ProductosController::ObtenerFechaHora()
                    ]
                );
                //aqui disminuimos el inventario de los productos que se vendieron en su respectivo espacio
                ProductosController::DisminuirInventario($listado->id_producto,$espacio,$listado->cantidad);
            }
            
            //finalizada la operaición, se desbloquea la tabla
            DB::raw('unlock tables');
            //dd($id_venta);
            
            //return $consecutivo_anual;
            return $id_venta;

        }

        public function DisminuirInventario($id_producto, $id_espacio, $cantidad_venta){
            //DB::raw('lock tables SOLICITUDES_SOLICITUD write');

            //obtenemos el inventario actual
            $inventario_anterior = DB::table('REL_INVENTARIO')
                ->where([
                    'DATOS_VENTA_FK_PROCUTO' => $id_producto,
                    'DATOS_VENTA_FK_ESPACIO' => $id_espacio
                ])
                ->get();

            //dd($inventario_anterior);

            //Solo por seguridad, si existe un inventario actual, entonces se reduce las unidades vendidas
            if(count($inventario_anterior)>0){
                //dd("ACTUALIZANDO");
                $cantidad = $inventario_anterior[0]->DATOS_VENTA_CANTIDAD - $cantidad_venta;
                //dd($cantidad);
                $update = DB::table('REL_INVENTARIO')
                    ->where([
                        'DATOS_VENTA_FK_PROCUTO' => $id_producto,
                        'DATOS_VENTA_FK_ESPACIO' => $id_espacio
                    ])
                    ->update([
                        'DATOS_VENTA_CANTIDAD' => $cantidad
                    ]);//*/   
                //dd($update);
            }
            //DB::raw('unlock tables');
            return $cantidad;
        }

        public function AumentarInventario($id_producto,$select_bodega,$cantidad){
            $nueva_cantidad = $cantidad;
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
            return $nueva_cantidad;
        }

        //esta funcion es solo para las solicitudes recien creadas
        public function DarFormatoConsecutivo($id_venta,$fecha){
            //dd($id_venta);
            $id_espacio = \Session::get('id_tienda')[0];
            $anio = strtotime($fecha);
            //dd(date('Y',$anio));
            $anio = date('Y',$anio);
            $datos_espacio = EspaciosController::ObtenerDatosEspacioId($id_espacio);
            $datos_venta = DB::table('TIENDAS_VENTAS')
                ->select('VENTAS_CONSECUTIVO_ANUAL')
                ->where('VENTAS_ID',$id_venta)
                ->get();
            //dd($datos_venta[0]);
            //dd($datos_espacio);
            //$consecutivo = $datos_espacio->NOMENCLATURA_ESPACIO.'/'.$id_venta.'/'.$anio;
            $consecutivo = $datos_espacio->NOMENCLATURA_ESPACIO.'/'.$datos_venta[0]->VENTAS_CONSECUTIVO_ANUAL.'/'.$anio;
            return $consecutivo;
        }

        //esta funcion es para la consulta dentro de otras funciones
        public function DarFormatoConsecutivo2($consecutivo,$fecha){
            //dd($id_venta);
            $id_espacio = \Session::get('id_tienda')[0];
            $anio = strtotime($fecha);
            //dd(date('Y',$anio));
            $anio = date('Y',$anio);
            $datos_espacio = EspaciosController::ObtenerDatosEspacioId($id_espacio);
            //dd($datos_espacio);
            $consecutivo = $datos_espacio->NOMENCLATURA_ESPACIO.'/'.$consecutivo.'/'.$anio;
            return $consecutivo;
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
                    $anio = date('Y');
                    //$anio = '2015';
                    $join->on('REL_VENTA_PRODUCTO.REL_VENTA_FK_VENTA', '=', 'TIENDAS_VENTAS.VENTAS_ID')
                        ->where(['REL_VENTA_PRODUCTO.REL_VENTA_FK_ESPACIO'=>$id_espacio])
                        ->whereYear('TIENDAS_VENTAS.created_at',$anio);
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
            //dd($consecutivo_anual);
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
            //$consecutivo_inicial = $request['consecutivo_inicial'];
            //$consecutivo_final = $request['consecutivo_final'];

            //insertamos la nota de entrada
            $id_nota = DB::table('TIENDAS_NOTA_ENTRADA')->insertGetId(
                [
                    'NOTA_ENTRADA_PRECIO_COMPRA' => $precio_compra,
                    'NOTA_ENTRADA_CANTIDAD' => $cantidad,
                    //'NOTA_ENTRADA_INICIO' => $consecutivo_inicial,
                    //'NOTA_ENTRADA_FIN' => $consecutivo_final,
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
            return($rel_inventario);
            //dd($rel_inventario);
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
                $producto[0]->CODIGO = $id_producto;

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
                    //'PRODUCTOS_CONSECUTIVO' => $request['consecutivo'],
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
                    //'PRODUCTOS_CONSECUTIVO' => $request['consecutivo'],
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
