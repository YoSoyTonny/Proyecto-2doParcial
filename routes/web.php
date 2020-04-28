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


//misitio.com/noticias/8



//Atajo para establecer las 7 rutas básicas
//de un recurso
//index, show, create, store
//edit, update, destroy
Route::resource('/produccion',
    'ProduccionController');

    Route::resource('/postproduccion',
    'postproduccioncontroller');

Route::resource('/admin/usuarios',
    'Admin\UsuarioController');


Auth::routes(['register' => false]);


Auth::routes();

Route::get('/', 'ProduccionController@index')->name('index');