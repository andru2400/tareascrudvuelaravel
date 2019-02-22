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
    return view('home');
});

Route::get('mis-tareas','TareaController@getTareas');
Route::post('guardar-tareas','TareaController@store');
Route::put('actualizar-tareas/{id}','TareaController@update');
Route::delete('eliminar-tareas/{id}','TareaController@destroy');

