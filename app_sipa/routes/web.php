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

Route::get('/', 'PaginasController@index');
Route::get('/users', 'UsuariosController@index');
Route::get('/lea', 'UsuariosController@create');

Route::resource('sipa_usuarios','UsuariosController');
Route::resource('sipa_roles','RolesController');
Route::resource('sipa_permisos_roles','PermisosRolesController');
Route::resource('sipa_opciones_menu','OpcionesMenusController');