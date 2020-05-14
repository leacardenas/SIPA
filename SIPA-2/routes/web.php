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
Route::resource('users', 'LoginLdapController2');
Route::resource('roles', 'RolesController');
Route::resource('activos', 'registraActController');
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
Route::post('/borrarInsumo','insumosController@borrarInsumo');
Route::post('/agregarInsumo','insumosController@agregarInsumos');

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
    return view('activos.reservar');
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

Route::get('/editarRol/{id}','menusController@editarRol');

Route::post('/editarRolSeleccionado/{id}', 'RolesController@editarRolSeleccionado');

Route::post('/borrarRol/{id}', 'RolesController@borrarRol');

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
Route::get('/activ/{id}', 'activoController@borrarActivos');
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
Route::get('/crearActivo','menusController@crearActivo');

Route::get('/configuraciones','menusController@configuraciones');
Route::get('/configuracionesRoles','menusController@configuracionesRoles');
Route::get('/configuracionesActivos','menusController@configuracionesActivos');
Route::get('/configuracionesUsuarios','menusController@configuracionesUsuarios');
Route::get('/configuracionesTiposUsuarios','menusController@configuracionesTiposDeUsuario');
Route::get('/configuracionesCuerposCorreo','menusController@configuracionesCorreos');

Route::get('/verEquipos/{id}','menusController@verEquipos');
Route::get('/irEditar/{id}','salasController@irEditarSala');
Route::get('/irDarDeBaja/{id}','salasController@irDarDeBja');
Route::get('/editarActivos','menusController@opcionesEditar');
Route::get('/verDetallerRol/{id}','menusController@verRolDetalle');
Route::get('/editarTipoUsuario/{id}', 'menusController@editarTipoUsuario');
Route::get('/activosdatatable', function(){
    return view('activos/datatable');
});

//entregas y devoluciones de reservas
Route::get('/devolucionActivo', function(){
    return view('reservas/devuelveActivo');
});

Route::get('/entregaActivos', function(){
    return view('reservas/entregaActivo');
});

Route::get('/devolucionSala', function(){
    return view('reservas/devuelveSala');
});

Route::get('/entregaSalas', function(){
    return view('reservas/entregaSala');
});

// reservasEquipos
Route::get('/ir_a_datatable','reservasController@passDataToBlade');
Route::get('/reservarActivos/{fi}/{ff}/{hi}/{hf}/{cant}/{semanas_meses}/{cedula}/{archJson}','reservasController@reservar');
Route::get('/reservarSalas/{fi}/{ff}/{hi}/{hf}/{cant}/{idSalap}','reservasController@reservarSalas');
Route::get('/filtrarSalas/{fi}/{ff}/{hi}/{hf}/{cant}','reservasController@filtrarSalas');
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
Route::get('/testMailBody', function(){
    session(['idUsuario' => '207630059']);
    return view('test');
});


//Sala 
Route::get('/asignaActivosSala/{listaActivos}/{sala}','salasController@asignarActivoSala');




//RUTAS PARA LOS NUEVOS MENUS
Route::get('/configReservas', function(){
    return view('menus/configReservas');
});

Route::get('/devoluciones', function(){
    return view('menus/devoluciones');
});

Route::get('/entregas', function(){
    return view('menus/entregas');
});

Route::get('/historialReservas', function(){
    return view('menus/historial');
});

Route::get('/historialActivos', function(){
    return view('reservas/historialActivos');
});

Route::get('/historialSalas', function(){
    return view('reservas/historialSalas');
});

Route::get('/misReservas', function(){
    return view('menus/historial');
});

Route::get('/miHistorialActivos', function(){
    return view('reservas/historialActivosFuncionario');
});

Route::get('/miHistorialSalas', function(){
    return view('reservas/historialSalasFuncionario');
});

Route::get('/activosBaja', function(){
    return view('inventario/activosBaja');
});

Route::get('/miInventario', function(){
    return view('menus/enUso');
});

Route::get('/inventarioEnUsoActivos', function(){
    return view('inventario/inventarioEnUso');
});

Route::get('/verBoletas', function(){
    return view('inventario/boletas');
});

Route::get('/verMisBoletas', function(){
    return view('inventario/boletasFuncionario');
});

Route::get('/existeInsumo/{nombre}','insumosController@existeNomInsumo');

Route::get('/existeActivo/{codigo}','editarActController@existeActivo');

Route::get('/existeSala/{codigo}','salasController@existeSala');

Route::post('/eliminarUsuario','UsuarioController@eliminarUsuario');