<?php

use App\Activo;
use App\User;
use App\Rol;
use App\Permiso;
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
})->name('welcome');


Route::get('/correo',function(){
    return view('enviar');
});

Route::get('/inventarioSalasBlade', function(){
    return view('menus/inventarioSalas');
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
Route::get('/verificarAct/{id}', 'editarActController@verificar');
Route::get('/traspasoMasiv/{lista}/{idEnc}','editarActController@trasladoMasivo');
Route::get('/verificarExist/{exitencia}/{id}','insumosController@verificarExistencia');
Route::resource('users', 'LoginLdapController2');
Route::resource('roles', 'RolesController');
Route::resource('activos', 'registraActController');
Route::post('/editaNomRol','editarRolController@editarNombreRol');
Route::post('/eliminarRol','editarRolController@eliminarRol');
Route::post('/editaResp', 'editarActController@editarResponsable');
Route::post('/editaEnc', 'editarActController@editarEncargado');
Route::post('/editaEstado', 'editarActController@editarEstado');
Route::post('/editaUbicacion', 'editarActController@editarUbicacion');
Route::post('/darBaja', 'editarActController@darDeBaja');
Route::post('/agregarPdf','editarActController@realizarTraslado');
Route::get('/aceptarUsuario/{id}/{nombre}/{rolNombre}','registroController@actualizarRol');
Route::post('/registroSala','salasController@registrarSala');
Route::post('/editarSala','salasController@editarUbicacionOImagenSala');
Route::post('/darBajaSala','salasController@darBajaSala');
Route::post('/ingresarInsumo','insumosController@ingresarInsumos');
Route::post('/editarExistInsumos','insumosController@editarExistencia');
Route::get('/asignarInsumos/{insumos}/{funcionario}/{observacion}','insumosController@asignarInsumo');

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

Route::get('/principal', function () {
    return view('menus.modulos');
});
Route::get('/sendemail', 'email_controlador@index');
Route::get('/send', 'email_controlador@send');

Route::get('/tester',function(){
    return view('tester');
});

Route::get('/editarActivo', function(){
    return view('activos/editar');
});

Route::get('/inicioAdministrador', function(){
    return view('inicioAdministrador');
});

Route::get('/inicioFuncionario', function(){
    return view('inicioFuncionario');
});

Route::get('/reportesActivosFuncionario', function(){
    return view('reportesActivosFuncionarios');
});

Route::get('/reportesActivosSuperAdministrador', function(){
    return view('reportesActivosSuperAdmin');
});

Route::get('/reservarActivo', function(){
    return view('reservaActivo');
});

Route::get('/reservarSala', function(){
    return view('salas/reservar');
});

Route::get('/informacionSalas', function(){
    return view('salas/informacion');
});

Route::get('/registrarSala', function(){
    return view('salas/registrar');
});

Route::get('/editarSala', function(){
    return view('salas/editar');
});

Route::get('/inventarioSala', function(){
    return view('inventarioSalas');
});

Route::get('/darBajaSala', function(){
    return view('salas/darDeBajaSala');
});

Route::get('/inventarioInsumos', function(){
    return view('inventario/insumos');
});

Route::get('/editarEncargado', function(){
    return view('activos/editarEncargado');
});

Route::get('/editarEstado', function(){
    return view('activos/editarEstado');
});

Route::get('/editarResponsable', function(){
    return view('activos/editarResponsable');
});

Route::get('/editarUbicacion', function(){
    return view('activos/editarUbicacion');
});

Route::get('/darBajaActivo', function(){
    return view('activos/darBaja');
});

Route::get('/trasladoMasivo', function(){
    return view('activos/trasladoMasivo');
});

Route::get('/crearRol', function(){
    return view('roles/crear');
});

Route::get('/editarRol', function(){
    return view('roles/editar');
});

Route::get('/eliminarRol', function(){
    return view('roles/eliminar');
});

Route::get('/testingRelations', function(){
    session(['idUsuario' => '123']);
    $cedula = session('idUsuario');
    $permisos = User::where('sipa_usuarios_identificacion',$cedula)->get()[0]->rol->permisos;
    foreach($permisos as $permiso){
        if($permiso->modulo->sipa_opciones_menu_codigo == 'ACTV')
            return  $permiso;
    
    }

});


Route::get('/activos2', function(){
    $activos = Activo::all();
    return view('activos/activos')->with('activos', $activos);
});
Route::post('/activ', 'activoController@borrarActivos');
// Route::get('/cbbx/{nom}', 'comboboxesController@edificioInfo');

Route::get('/inicio','menusController@inicio');
Route::get('/reservas','menusController@reservas');
Route::get('/reservasSalas','menusController@reservaSala');
Route::get('/reservasEquipos','menusController@reservaEquipo');

Route::get('/inventarioEnUso','menusController@inventarioEnUso');
Route::get('/inventarioEnUsoSalas','menusController@inventarioEnUsoSala');
Route::get('/inventarioEnUsoEquipos','menusController@inventarioEnUsoEquipo');
Route::get('/inventarioEnUsoAsignaciones','menusController@inventarioEnUsoAsignaciones');
Route::get('/inventarioEnUsoFormularios','menusController@inventarioEnUsoFormulario');

Route::get('/historiales','menusController@historiales');
Route::get('/historialesSalas','menusController@historialSalas');
Route::get('/historialesEquipos','menusController@historialEquipo');

Route::get('/entregas','menusController@entregas');
Route::get('/entregaSalas','menusController@entregaSalas');
Route::get('/entregaSalasAnticipadas','menusController@entregaSalasAnticipadas');
Route::get('/entregaSalasRapidas','menusController@entregaSalasRapidas');

Route::get('/entregaEquipos','menusController@entregaEquipos');
Route::get('/entregaEquiposAnticipados','menusController@entregaEquiposAnticipados');
Route::get('/entregaEquiposRapidos','menusController@entregaEquiposRapidos');

Route::get('/devoluciones','menusController@devoluciones');
Route::get('/devolucionesSalas','menusController@devolucionesSalas');
Route::get('/devolucionesEquipos','menusController@devolucionesEquipos');

Route::get('/inventario','menusController@inventario');
Route::get('/inventarioSalas','menusController@inventarioSalas');
Route::get('/inventarioEquipos','menusController@inventarioEquipos')->name('inventarioEquipos');
Route::get('/inventarioInsumos','menusController@inventarioInsumos');

Route::get('/configuraciones','menusController@configuraciones');
Route::get('/configuracionesRoles','menusController@configuracionesRoles');
Route::get('/configuracionesActivos','menusController@configuracionesActivos');
Route::get('/configuracionesUsuarios','menusController@configuracionesUsuarios');
Route::get('/configuracionesTiposUsuarios','menusController@configuracionesTiposDeUsuario');
Route::get('/configuracionesCuerposCorreo','menusController@configuracionesCorreos');
Route::get('/configuracionesSalas', function(){
    return view ('salas/activosSalas');
});

Route::get('/verEquipos/{id}','menusController@verEquipos');
Route::get('/irEditar/{id}','salasController@irEditarSala');
Route::get('/irDarDeBaja/{id}','salasController@irDarDeBja');
Route::get('/editarActivos','menusController@opcionesEditar');
Route::get('/verDetallerRol/{id}','menusController@verRolDetalle');
Route::get('/editarTipoUsuario/{id}', 'menusController@editarTipoUsuario');
Route::get('/crearActivo', function(){
    return view('activos/registrar');
});

Route::get('/detalleReservaSala', function(){
    return view('salas/detalleReservas');
});

Route::get('/registrarInsumo', function(){
    return view('insumos/registrarInsumo');
});
Route::get('entregarInsumo', function(){
    return view('insumos/entregarInsumo');
});
Route::get('/activosdatatable', function(){
    return view('activos/datatable');
});
// reservasEquipos
Route::get('/ir_a_datatable','reservasController@passDataToBlade');
Route::get('/reservarActivos/{fi}/{ff}/{hi}/{hf}/{cant}/{semanas_meses}/{cedula}/{archJson}','reservasController@reservar');

//Prueba de correos
Route::post('/enviarCorreo','EnviarCorreo@sendMailPHPMailer');

Route::post('/editTipoUse','editTipoUsuarioController@editarTipoUsuario');
//Traslado masivo, manejo de la lista de activos
// Route::get('/agregarElemento/{elemento}','editarActController@agregarLista');
// Route::get('/eliminarElemento/{activo}','editarActController@eliminarElemento');


//=============================================================================================================
//=============================================================================================================
//=============================================================================================================
//DE AQUI PARA ABAJO VAN LAS RUTAS DE PRUEBA
//=============================================================================================================
//=============================================================================================================
//=============================================================================================================


Route::get('/reservasEquiposTest', function(){
   
    session(['idUsuario' => '207630059']);
    return view('activos.reservar');
});

Route::get('/reservasSalasTest', function(){
   
    session(['idUsuario' => '207630059']);
    return view('salas.reservar');
});




