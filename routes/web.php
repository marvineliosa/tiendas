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

Route::get('/productos', function () {
    return view('listado_productos');
});

Route::get('/codigo/imprimir', function () {
    return view('pdf.impresion_codigos');
});

Route::get('/venta', function () {
    return view('venta');
});
