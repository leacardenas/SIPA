<?php
use App\User;
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
    if(session()->has('idUsuario'))
    {
        session()->forget('orderId');
    }
    return view('welcome');
});

Route::get('/registrar', function () {
    $username = session('idUsuario');
    $user = User::where('sipa_usuarios_identificacion',$username)->get()[0];
    return view('registrar')->with('user',$user);
});

Auth::routes();
Route::post('/userso', 'LoginLdapController@com');
Route::get('/cbbx/{nom}', 'comboboxesController@edificioInfo');
Route::get('/verificar/{id}', 'LoginLdapController@verificar');
Route::resource('users', 'LoginLdapController2');
Route::resource('roles', 'RolesController');
Route::resource('activos', 'registraActController');

Route::get('/rActivo', function(){
    return view('registroActivos');
});

Route::get('/configurarRoles', function(){
    return view('configurarRoles');
});
Route::get('/opcionesConfRoles', function(){
    return view('opcionesConfRoles');
});
Route::get('/crearRol', function () {
    return view('crearRoles');
});

Route::get('/logged', function () {
    return view('logged');
});
Route::get('/sendemail', 'email_controlador@index');
Route::get('/send', 'email_controlador@send');

Route::get('/tester',function(){
    return view('tester');
});

Route::get('/editarActivo', function(){
    return view('editarActivo');
});