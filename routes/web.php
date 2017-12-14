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

Route::get('/maquinarias/{id_maquinaria}/historial', 'MaquinariaHistorialController@index')->name('maquinarias.historial');
Route::get('/maquinarias/{id_maquinaria}/historial/create', 'MaquinariaHistorialController@create')->name('maquinarias.historial.create');
Route::get('/maquinarias/historial/edit/{id}', 'MaquinariaHistorialController@edit')->name('maquinarias.historial.edit');
Route::get('/maquinarias/{id_maquinaria}/historial/delete/{id}', 'MaquinariaHistorialController@delete')->name('maquinarias.historial.delete');
Route::get('/maquinarias/{id_maquinaria}/historial/search', 'MaquinariaHistorialController@index');
Route::post('/maquinarias/historial/store', 'MaquinariaHistorialController@store')->name('maquinarias.historial.store');
Route::post('/maquinarias/historial/update', 'MaquinariaHistorialController@update')->name('maquinarias.historial.update');
Route::post('/maquinarias/{id_maquinaria}/historial/search', 'MaquinariaHistorialController@search')->name('maquinarias.historial.search');

Route::get('/materiales', 'MaterialController@index')->name('materiales');
Route::get('/materiales/create', 'MaterialController@create')->name('materiales.create');
Route::get('/materiales/edit/{id}', 'MaterialController@edit')->name('materiales.edit');
Route::get('/materiales/delete/{id}', 'MaterialController@delete')->name('materiales.delete');
Route::get('/materiales/search', 'MaterialController@index');
Route::post('/materiales/search', 'MaterialController@search')->name('materiales.search');
Route::post('/materiales', 'MaterialController@store')->name('materiales.store');

Route::get('/registros', 'RegistrosController@index')->name('registros');
Route::get('/registros/detalle/{id}', 'RegistrosController@detalle')->name('registros.detalle');
Route::get('/registros/create', 'RegistrosController@create')->name('registros.create');
Route::get('/registros/{id_registro}/material/create', 'RegistrosController@create_material')->name('registros.create.material');
Route::get('/registros/{id_registro}/material/edit/{id}', 'RegistrosController@edit_material')->name('registros.edit.material');
Route::get('/registros/{id_registro}/trabajo/create', 'RegistrosController@create_trabajo')->name('registros.create.trabajo');
Route::get('/registros/{id_registro}/trabajo/edit/{id}', 'RegistrosController@edit_trabajo')->name('registros.edit.trabajo');
Route::get('/registros/edit/{id}', 'RegistrosController@edit')->name('registros.edit');
Route::get('/registros/delete/{id}', 'RegistrosController@delete')->name('registros.delete');
Route::get('/registros/{id_registro}/material/delete/{id}', 'RegistrosController@delete_material')->name('registros.delete.material');
Route::get('/registros/{id_registro}/trabajo/delete/{id}', 'RegistrosController@delete_trabajo')->name('registros.delete.trabajo');
Route::get('/registros/usuario', 'RegistrosController@usuario')->name('registros.usuario');
Route::post('/registros', 'RegistrosController@store')->name('registros.store');
Route::post('/registros/{id_registro}/trabajo/store', 'RegistrosController@store_trabajo')->name('registros.store.trabajo');
Route::post('/registros/{id_registro}/material/store', 'RegistrosController@store_material')->name('registros.store.material');

Route::get('/clientes', 'ClienteController@index')->name('clientes');
Route::get('/clientes/create', 'ClienteController@create')->name('clientes.create');
Route::get('/clientes/edit/{id}', 'ClienteController@edit')->name('clientes.edit');
Route::get('/clientes/delete/{id}', 'ClienteController@delete')->name('clientes.delete');
Route::get('/clientes/search', 'ClienteController@index');
Route::post('/clientes/update', 'ClienteController@update')->name('clientes.update');
Route::post('/clientes', 'ClienteController@store')->name('clientes.store');
Route::post('/clientes/search', 'ClienteController@search')->name('clientes.search');

Route::get('/paginas_rol', 'PaginasPermisoController@index')->name('paginas_rol');
Route::get('/paginas_rol/create', 'PaginasPermisoController@create')->name('paginas_rol.create');
Route::get('/paginas_rol/edit/{id}', 'PaginasPermisoController@edit')->name('paginas_rol.edit');
Route::get('/paginas_rol/search', 'PaginasPermisoController@index');
Route::post('/paginas_rol/search', 'PaginasPermisoController@search')->name('paginas_rol.search');
Route::post('/paginas_rol/store', 'PaginasPermisoController@store')->name('paginas_rol.store');
Route::post('/paginas_rol/update', 'PaginasPermisoController@update')->name('paginas_rol.update');

//BackEnd
Route::post('/maquinarias/getnombre', 'BackendMaquinariaController@getNombre')->name('backmaquinaria.getnombre');
Route::post('/materiales/proveedor', 'BackendMaterialController@storeProveedor')->name('materiales.proveedor');
Route::post('/clientes/GetAll', 'BackendClienteController@GetAll')->name('clientes.getAll');
Route::post('/maquinarias/GetAll', 'BackendMaquinariaController@GetAll')->name('maquinaria.getAll');
Route::post('/personal/GetAll', 'BackendPersonalController@GetAll')->name('personal.getAll');

Route::post('/registros/getHorasMantenimiento', 'BackendRegistrosController@getHorasMantenimiento')->name('registros.getHorasMantenimiento');
Route::post('/registros/getDetalleHorasMantenimiento', 'BackendRegistrosController@getDetalleHorasMantenimiento')->name('registros.getDetalleHorasMantenimiento');
