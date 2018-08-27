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
    return view('welcome');
});

Auth::routes();

Route::get('/home/{any}', 'HomeController@index')->name('home')->where('any', '.*');
Route::get('/datospermiso', 'HomeController@datospermiso')->name('datospermiso');

//Gestionar estudiantes
Route::resource('estudiante', 'EstudianteController');
Route::post("estudiante.actualizarestudiante/{estudiante}","EstudianteController@actualizarestudiante");
Route::post("estudiante.guardaracudiente","EstudianteController@guardaracudiente");

Route::resource('role', 'RoleController');
Route::resource('usuario', 'UsuarioController');
Route::post("usuario.guardarimagenperfil","UsuarioController@guardarimagenperfil");
Route::resource('institucion', 'InstitucionController');
Route::resource('acudiente', 'AcudienteController');

Route::get('/combos', 'ComboController@index');
Route::post('/savepermisorol', 'RoleController@savepermisorol');
