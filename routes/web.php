<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('login');
});


Route::get('/codigo', function () {
    return view('codigo');
});



Route::get('/codigo/imprimir', function () {
    return view('pdf.impresion_codigos');
});

Route::get('/venta', function () {
    return view('venta');
});

//usuarios
Route::post('/usuarios/validar', 'UsuariosController@ValidarLogin');
Route::get('/salir', 'UsuariosController@CerrarSesion');

//espacios
Route::get('/espacios', 'EspaciosController@VistaListadoEspacios');
Route::post('/espacios/registrar', 'EspaciosController@RegistrarEspacio');
Route::get('/espacios/{id_espacio}/inventario', 'EspaciosController@VerInventarioEspacio');



//Productos
Route::get('/productos', 'ProductosController@VistaListadoProductos');
Route::post('/productos/registrar', 'ProductosController@RegistrarProducto');
Route::post('/productos/actualizar_datos', 'ProductosController@ActualizarDatosProducto');
Route::post('/productos/actualizar_datos_venta', 'ProductosController@ActualizarDatosVenta');
Route::post('/productos/obtener_datos', 'ProductosController@RegresarDatosProducto');
Route::post('/productos/agregar_nota', 'ProductosController@RegistrarNotaVenta');
Route::post('/productos/ver_historial', 'ProductosController@ObtenerHistorialProductos');
Route::post('/productos/obtener_inventario_tiendas', 'ProductosController@RegresarInventarioTiendas');
Route::post('/productos/registrar_movilizacion_inventario', 'ProductosController@RegistrarMovilizacionInventario');
Route::post('/productos/traer_movilizaciones', 'ProductosController@TraerMovilizacionInventario');
Route::post('/productos/traer_movilizaciones_usuarios', 'ProductosController@TraerMovilizacionesUsuario');
Route::post('/productos/aprobar_movilizaciones', 'ProductosController@AprobarMovilizacion');
Route::post('/productos/cancelar_movilizaciones', 'ProductosController@CancelarMovilizacion');

Route::post('/venta/almacenar_venta', 'ProductosController@AlmacenarVenta');
Route::post('/venta/almacenar_venta/debito', 'ProductosController@AlmacenarVentaDebito');
Route::post('/venta/almacenar_venta/credito', 'ProductosController@AlmacenarVentaCredito');
Route::post('/venta/almacenar_venta/efectivo', 'ProductosController@AlmacenarVentaEfectivo');
Route::post('/venta/almacenar_venta/mixto', 'ProductosController@AlmacenarVentaMixto');
Route::post('/venta/almacenar_venta/transferencia', 'ProductosController@AlmacenarVentaTransferencia');
Route::post('/venta/almacenar_venta/deposito', 'ProductosController@AlmacenarVentaDeposito');
Route::post('/venta/almacenar_venta/nomina', 'ProductosController@AlmacenarVentaNomina');

Route::get('/reportes/ventas', 'ProductosController@VistaReporteVentas');
Route::post('/reportes/reporte_intervalo', 'ProductosController@CrearReporteIntervalo');
Route::post('/reportes/obtner_detalle', 'ProductosController@ObtenerDetalleVenta');


Route::get('/inventario', 'ProductosController@VistaRegistrarInventario');
Route::post('/inventario/conteo_actual', 'ProductosController@RegresarConteo');
Route::post('/inventario/guardar_conteo', 'ProductosController@GuardarConteo');
Route::post('/inventario/reiniciar_conteo', 'ProductosController@ReiniciarConteo');
Route::post('/inventario/agregar_existencias', 'ProductosController@InsertarInventarioDirecto');
//Route::post('/inventario/agregar_inventario', 'ProductosController@AgregarInventario');

Route::post('/devolucion/almacenar', 'ProductosController@AlmacenarDevolucion');

Route::get('/codigo/{codigo}/imprimir', 'ProductosController@ImprimirCodigo');