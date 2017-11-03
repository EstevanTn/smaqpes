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

/*Route::get('/', function () {
    return view('welcome');
});
*/
Route::get('/', 'HomeController@index');

Auth::routes();

//Route::get('/login/users', 'Auth\\LoginController@users');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/roles', 'RolController@index')->name('roles');
Route::post('/roles', 'RolController@store')->name('roles.store');
Route::get('/roles/create', 'RolController@create')->name('roles.crear');
Route::get('/roles/edit/{id}', 'RolController@edit')->name('roles.editar');
Route::get('/roles/delete/{id}', 'RolController@delete')->name('roles.eliminar');

Route::get('/usuarios', 'UsuarioController@index')->name('usuarios');
Route::get('/usuarios/create', 'UsuarioController@create')->name('usuarios.create');
Route::get('/usuarios/edit/{id}', 'UsuarioController@edit')->name('usuarios.edit');
Route::get('/usuarios/delete/{id}', 'UsuarioController@delete')->name('usuarios.delete');
Route::post('/usuarios/updatePassword}', 'UsuarioController@updatePassword')->name('usuarios.updatePassword');
Route::post('/usuarios', 'UsuarioController@store')->name('usuarios.store');

Route::get('/areas', 'AreaController@index')->name('areas');
Route::get('/areas/create', 'AreaController@create')->name('areas.create');
Route::get('/areas/edit/{id}', 'AreaController@edit')->name('areas.edit');
Route::get('/areas/delete/{id}', 'AreaController@delete')->name('areas.delete');
Route::post('/areas', 'AreaController@store')->name('areas.store');

Route::get('/personal', 'PersonalController@index')->name('personal');
Route::get('/personal/create', 'PersonalController@create')->name('personal.create');
Route::get('/personal/edit/{id}', 'PersonalController@edit')->name('personal.edit');
Route::get('/personal/delete/{id}', 'PersonalController@delete')->name('personal.delete');
Route::post('/personal', 'PersonalController@store')->name('personal.store');
Route::get('/personal/search', 'PersonalController@index');
Route::post('/personal/search', 'PersonalController@search')->name('personal.search');

Route::get('/maquinarias', 'MaquinariaController@index')->name('maquinarias');
Route::get('/maquinarias/create', 'MaquinariaController@create')->name('maquinarias.create');
Route::get('/maquinarias/edit/{id}', 'MaquinariaController@edit')->name('maquinarias.edit');
Route::get('/maquinarias/delete/{id}', 'MaquinariaController@delete')->name('maquinarias.delete');
Route::post('/maquinarias', 'MaquinariaController@store')->name('maquinarias.store');
Route::post('/maquinarias/search', 'MaquinariaController@search')->name('maquinarias.search');
Route::get('/maquinarias/search', 'MaquinariaController@index');

Route::get('/materiales', 'MaterialController@index')->name('materiales');
Route::get('/materiales/create', 'MaterialController@create')->name('materiales.create');
Route::get('/materiales/edit/{id}', 'MaterialController@edit')->name('materiales.edit');
Route::get('/materiales/delete/{id}', 'MaterialController@delete')->name('materiales.delete');
Route::post('/materiales', 'MaterialController@store')->name('materiales.store');

