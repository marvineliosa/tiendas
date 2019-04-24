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
