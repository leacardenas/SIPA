<?php

Route::get('/', function () {
    return view('welcome');
});


Route::get('/index','UsuariosController@index');

Route::resource('sipa_usuarios','UsuariosController');
Route::resource('sipa_roles','RolesController');
Route::resource('sipa_permisos_roles','PermisosRolesController');
Route::resource('sipa_opciones_menu','OpcionesMenuController');