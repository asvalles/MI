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
    return view('principal');
});


Route::post('/logear', 'LoginController@logear');
Route::get('/out', 'LoginController@salir');

Route::post('/registrar', 'RegistroController@store');

Route::get('/', 'PuntuacionController@index');

Route::post('/puntuaciones', 'PuntuacionController@addScore');
Route::get('/puntuaciones', 'PuntuacionController@addScore');

Route::post('/image', 'ImagenController@GuardarImg')->name('guardarImagen');

Route::post('/image_2', 'ImagenController@GuardarImg_2')->name('guardarImagen_2');

Route::post('/image_2', 'ImagenController@GuardarImg_2')->name('guardarImagen_3');
