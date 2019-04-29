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