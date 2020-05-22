@extends('plantillas.inicio') 

@section('content') 
@php 
$cedula = session('idUsuario'); 
$user = App\User::where('sipa_usuarios_identificacion',$cedula)->get()[0]; 
@endphp

<?php
$_menusController = new App\Http\Controllers\menusController();
?>

<div class="row col-sm-12">
    <form method="get" action="{{url('/configuracionesRoles')}}">
        <button type="submit" type="button" class="btn btn-secondary volver">
            <span class="glyphicon glyphicon-chevron-left"></span> Volver
        </button>
    </form>
</div>

<div class="row justify-content-center col-sm-12">
    <h1 id="editarEstado" class="tituloModal">Ver información del rol <b>{{$rol->sipa_roles_codigo}}</h1>
</div>

<div class="col-sm-12 justify-content-center">
    <form method="POST" action="<?php echo url("/editarRolSeleccionado/{$rol->sipa_roles_id}"); ?>" class="col-sm-12" id="editarRole" enctype="multipart/form-data">
    @csrf
        <div class="form-group">
            <label>Nombre de rol</label>
            <input class="form-control" id="inputNombreRol" type="text" name="nombreRol" value="{{$rol->sipa_roles_codigo}}">
        </div>

        <div class="form-group">
            <label>Descripción</label>
            <input class="form-control" id="inputDescRol" type="text" value="{{$rol->sipa_roles_nombre}}" name="descRol">
        </div>

        <div class="form-group">
            <label>Código</label>
            <input class="form-control" id="inputCodRol" type="text" value="{{$rol->sipa_roles_descripcion}}" name="codigo">
        </div>

        <hr>

        <div class="col-sm-12 table-responsive-sm">
            <h4>Seleccione los permisos del rol</h4>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" onClick="toggle(this)" id="defaultCheck1">
                <label class="form-check-label ml-4" for="defaultCheck1">
                    Seleccionar todo
                </label>
            </div>

            <table class="table table-hover" name="table-roles" id="table-usuarios">
                <thead>
                    <tr>
                        <th scope="col" class="text-center"></th>
                        <th scope="col" class="text-center">Crear</th>
                        <th scope="col" class="text-center">Editar</th>
                        <th scope="col" class="text-center">Borrar</th>
                        <th scope="col" class="text-center">Ver</th>
                        <th scope="col" class="text-center">Exportar</th>
                    </tr>
                </thead>

                <tbody class="text-center roles">
                    <tr>
                        <th class="table-active"><legend>Reservar</legend></th>
                    </tr>
                    <tr>
                        <td class="float-left permiso-rol" data-label=" ">Reserva de salas</td>
                        <td data-label="Crear">
                            <div class="checkbox">
                                <label>
                                    <input id="checkbox" type="checkbox" name="crear_reserva_salas" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'RESERVAR_SALA'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_crear == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td data-label="Editar">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="editar_reserva_salas" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'RESERVAR_SALA'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_editar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td data-label="Borrar">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="borrar_reserva_salas" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'RESERVAR_SALA'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_borrar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td data-label="Ver">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="ver_reserva_salas" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'RESERVAR_SALA'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_ver == 1) {echo 'checked';'';}?>/>
                                </label>
                            </div>
                        </td>
                        <td data-label="Exportar">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="exportar_reserva_salas" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'RESERVAR_SALA'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_exportar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="float-left permiso-rol" data-label=" ">Reserva de activos</td>
                        <td data-label="Crear">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="crear_reserva_activos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'RESERVAR_ACTIVO'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_crear == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td data-label="Editar">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="editar_reserva_activos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'RESERVAR_ACTIVO'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_editar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td data-label="Borrar">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="borrar_reserva_activos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'RESERVAR_ACTIVO'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_borrar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td data-label="Ver">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="ver_reserva_activos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'RESERVAR_ACTIVO'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_ver == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td data-label="Exportar">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="exportar_reserva_activos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'RESERVAR_ACTIVO'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_exportar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                    </tr>
                    
                    <tr>
                        <th class="table-active"><legend>Mis reservas</legend></th>
                    </tr>
                    <tr>
                        <td data-label=" " class="float-left permiso-rol">Mis reservas de salas</td>
                        <td data-label="Crear" class="text-center">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="crear_mis_reservas_salas" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'MIS_RESERVAS_SALA'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_exportar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td data-label="Editar" class="text-center">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="editar_mis_reservas_salas" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'MIS_RESERVAS_SALA'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_exportar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td data-label="Borrar" class="text-center">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="borrar_mis_reservas_salas" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'MIS_RESERVAS_SALA'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_exportar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td data-label="Ver" class="text-center">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="ver_mis_reservas_salas" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'MIS_RESERVAS_SALA'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_exportar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td data-label="Exportar" class="text-center">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="exportar_mis_reservas_salas" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'MIS_RESERVAS_SALA'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_exportar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td data-label=" " class="float-left permiso-rol">Mis reservas de activos</td>
                        <td data-label="Crear" class="text-center">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="crear_mis_reservas_activos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'MIS_RESERVAS_ACTIVO'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_exportar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td class="text-center" data-label="Editar">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="editar_mis_reservas_activos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'MIS_RESERVAS_ACTIVO'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_exportar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td class="text-center" data-label="Borrar">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="borrar_mis_reservas_activos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'MIS_RESERVAS_ACTIVO'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_exportar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td class="text-center" data-label="Ver">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="ver_mis_reservas_activos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'MIS_RESERVAS_ACTIVO'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_exportar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td class="text-center" data-label="Exportar">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="exportar_mis_reservas_activos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'MIS_RESERVAS_ACTIVO'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_exportar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <th class="table-active"><legend>Entregas</legend></th>
                    </tr>
                    <tr>
                        <td class="float-left permiso-rol" data-label=" ">Entrega de salas</td>
                        <td data-label="Crear">
                            <div class="checkbox">
                                <label>
                                    <input id="checkbox" type="checkbox" name="crear_entrega_salas" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'ENTREG_SALA'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_crear == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td data-label="Editar">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="editar_entrega_salas" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'ENTREG_SALA'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_editar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td data-label="Borrar">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="borrar_entrega_salas" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'ENTREG_SALA'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_borrar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td data-label="Ver">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="ver_entrega_salas" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'ENTREG_SALA'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_ver == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td data-label="Exportar">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="exportar_entrega_salas" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'ENTREG_SALA'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_exportar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="permiso-rol float-left" data-label=" ">Entrega de activos</td>
                        <td data-label="Crear">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="crear_entrega_activos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'ENTREG_ACTIVO'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_crear == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td data-label="Editar">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="editar_entrega_activos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'ENTREG_ACTIVO'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_editar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td data-label="Borrar">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="borrar_entrega_activos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'ENTREG_ACTIVO'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_borrar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td data-label="Ver">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="ver_entrega_activos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'ENTREG_ACTIVO'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_ver == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td data-label="Exportar">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="exportar_entrega_activos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'ENTREG_ACTIVO'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_exportar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-active"><legend>Devolución</legend></th>
                    </tr>
                    <tr>
                        <td class="float-left permiso-rol" data-label=" ">Devolución de salas</td>
                        <td data-label="Crear">
                            <div class="checkbox">
                                <label>
                                    <input id="checkbox" type="checkbox" name="crear_devolucion_salas" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'DEVOLU_SALA'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_crear == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td data-label="Editar">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="editar_devolucion_salas" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'DEVOLU_SALA'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_editar == 1) {echo 'checked';'';}?>  />
                                </label>
                            </div>
                        </td>
                        <td data-label="Borrar">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="borrar_devolucion_salas" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'DEVOLU_SALA'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_borrar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td data-label="Ver">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="ver_devolucion_salas" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'DEVOLU_SALA'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_ver == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td data-label="Exportar">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="exportar_devolucion_salas" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'DEVOLU_SALA'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_exportar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="float-left permiso-rol" data-label=" ">Devolución de activos</td>
                        <td data-label="Crear">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="crear_devolucion_activos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'DEVOLU_ACTIVO'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_crear == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td data-label="Editar">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="editar_devolucion_activos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'DEVOLU_ACTIVO'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_editar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td data-label="Borrar">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="borrar_devolucion_activos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'DEVOLU_ACTIVO'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_borrar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td data-label="Ver">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="ver_devolucion_activos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'DEVOLU_ACTIVO'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_ver == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td data-label="Exportar">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="exportar_devolucion_activos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'DEVOLU_ACTIVO'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_exportar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-active"><legend>Inventario</legend></th>
                    </tr>
                    <tr>
                        <td class="float-left permiso-rol" data-label=" ">Inventario de salas</td>
                        <td data-label="Crear">
                            <div class="checkbox">
                                <label>
                                    <input id="checkbox" type="checkbox" name="crear_inventario_salas" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'INV_SALA'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_crear == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td data-label="Editar">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="editar_inventario_salas" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'INV_SALA'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_editar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td data-label="Borrar">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="borrar_inventario_salas" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'INV_SALA'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_borrar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td data-label="Ver">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="ver_inventario_salas" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'INV_SALA'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_ver == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td data-label="Exportar">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="exportar_inventario_salas" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'INV_SALA'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_exportar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="float-left permiso-rol" data-label=" ">Inventario de activos</td>
                        <td data-label="Crear">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="crear_inventario_activos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'INV_ACTIVO'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_crear == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td data-label="Editar">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="editar_inventario_activos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'INV_ACTIVO'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_editar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td data-label="Borrar">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="borrar_inventario_activos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'INV_ACTIVO'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_borrar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td data-label="Ver">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="ver_inventario_activos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'INV_ACTIVO'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_ver == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td data-label="Exportar">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="exportar_inventario_activos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'INV_ACTIVO'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_exportar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="float-left permiso-rol" data-label=" ">Inventario de insumos</td>
                        <td data-label="Crear">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="crear_inventario_insumos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'INV_INSUMO'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_crear == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td data-label="Editar">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="editar_inventario_insumos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'INV_INSUMO'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_editar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td data-label="Borrar">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="borrar_inventario_insumos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'INV_INSUMO'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_borrar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td data-label="Ver">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="ver_inventario_insumos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'INV_INSUMO'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_ver == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td data-label="Exportar">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="exportar_inventario_insumos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'INV_INSUMO'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_exportar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                    </tr>
                    
                    <tr>
                        <th class="table-active"><legend>Mi inventario</legend></th>
                    </tr>
                    <tr>
                        <td class="float-left permiso-rol" data-label=" ">Mi inventario de activos</td>
                        <td data-label="Crear">
                            <div class="checkbox">
                                <label>
                                    <input id="checkbox" type="checkbox" name="crear_mi_inventario_activos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'MI_INV_ACTIVO'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_crear == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td data-label="Editar">
                            <div class="checkbox">
                                <label>
                                    <input id="checkbox" type="checkbox" name="editar_mi_inventario_activos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'MI_INV_ACTIVO'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_crear == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td data-label="Borrar">
                            <div class="checkbox">
                                <label>
                                    <input id="checkbox" type="checkbox" name="borrar_mi_inventario_activos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'MI_INV_ACTIVO'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_crear == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td data-label="Ver">
                            <div class="checkbox">
                                <label>
                                    <input id="checkbox" type="checkbox" name="ver_mi_inventario_activos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'MI_INV_ACTIVO'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_crear == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td data-label="Exportar">
                            <div class="checkbox">
                                <label>
                                    <input id="checkbox" type="checkbox" name="exportar_mi_inventario_activos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'MI_INV_ACTIVO'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_crear == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <th class="table-active"><legend>Historial</legend></th>
                    </tr>
                    <tr>
                        <td class="float-left permiso-rol" data-label=" ">Historial de salas</td>
                        <td data-label="Crear">
                            <div class="checkbox">
                                <label>
                                    <input id="checkbox" type="checkbox" name="crear_historial_salas" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'HISTO_SALA'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_crear == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td data-label="Editar">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="editar_historial_salas" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'HISTO_SALA'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_editar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td data-label="Borrar">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="borrar_historial_salas" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'HISTO_SALA'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_borrar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td data-label="Ver">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="ver_historial_salas" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'HISTO_SALA'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_ver == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td data-label="Exportar">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="exportar_historial_salas" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'HISTO_SALA'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_exportar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="float-left permiso-rol" data-label=" ">Historial de activos</td>
                        <td data-label="Crear">
                            <div class="checkbox">
                                <label>
                                    <input id="checkbox" type="checkbox" name="crear_historial_activos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'HISTO_ACTIVO'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_crear == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td data-label="Editar">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="editar_historial_activos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'HISTO_ACTIVO'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_editar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td data-label="Borrar">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="borrar_historial_activos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'HISTO_ACTIVO'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_borrar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td data-label="Ver">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="ver_historial_activos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'HISTO_ACTIVO'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_ver == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td data-label="Exportar">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="exportar_historial_activos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'HISTO_ACTIVO'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_exportar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-active"><legend>Configuración</legend></th>
                    </tr>
                    <tr>
                        <td class="float-left permiso-rol" data-label=" ">Configuración de correos</td>
                        <td data-label="Crear">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="crear_configuracion_correos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'CONFIG_CORREOS'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_crear == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td data-label="Editar">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="editar_configuracion_correos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'CONFIG_CORREOS'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_editar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td data-label="Borrar">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="borrar_configuracion_correos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'CONFIG_CORREOS'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_borrar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td data-label="Ver">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="ver_configuracion_correos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'CONFIG_CORREOS'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_ver == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td data-label="Exportar">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="exportar_configuracion_correos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'CONFIG_CORREOS'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_exportar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td class="float-left permiso-rol" data-label=" ">Configuración de usuarios</td>
                        <td data-label="Crear">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="crear_configuracion_usuarios" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'CONFIG_USUARIOS'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_crear == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td data-label="Editar">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="editar_configuracion_usuarios" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'CONFIG_USUARIOS'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_editar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td data-label="Borrar">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="borrar_configuracion_usuarios" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'CONFIG_USUARIOS'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_borrar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td data-label="Ver">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="ver_configuracion_usuarios" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'CONFIG_USUARIOS'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_ver == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td data-label="Exportar">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="exportar_configuracion_usuarios" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'CONFIG_USUARIOS'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_exportar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td class="float-left permiso-rol" data-label=" ">Configuración de tipos de usuario</td>
                        <td data-label="Crear">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="crear_configuracion_tipos_de_usuario" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'CONFIG_TIPO_USUARIOS'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_crear == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td data-label="Editar">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="editar_configuracion_tipos_de_usuario" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'CONFIG_TIPO_USUARIOS'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_editar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td data-label="Borrar">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="borrar_configuracion_tipos_de_usuario" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'CONFIG_TIPO_USUARIOS'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_borrar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td data-label="Ver">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="ver_configuracion_tipos_de_usuario" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'CONFIG_TIPO_USUARIOS'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_ver == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td data-label="Exportar">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="exportar_configuracion_tipos_de_usuario" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'CONFIG_TIPO_USUARIOS'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_exportar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td class="float-left permiso-rol" data-label=" ">Configuración de roles</td>
                        <td data-label="Crear">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="crear_configuracion_roles" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'CONFIG_ROLES'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_crear == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td data-label="Editar">
                            <div class="checkbox">
                                <label> 
                                    <input type="checkbox" name="editar_configuracion_roles" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'CONFIG_ROLES'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_editar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td data-label="Borrar">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="borrar_configuracion_roles" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'CONFIG_ROLES'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_borrar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td data-label="Ver">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="ver_configuracion_roles" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'CONFIG_ROLES'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_ver == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td data-label="Exportar">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="exportar_configuracion_roles" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'CONFIG_ROLES'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_exportar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

            <button type="submit" class="btn botonLargo mt-3" id="editarRolBoton"> Guardar </button>
        </form>
</div>


<script>
    function toggle(source) {
        checkboxes = document.getElementsByTagName('input');
        for(var i=0, n=checkboxes.length;i<n;i++) {
            checkboxes[i].checked = source.checked;
        }
    }
</script>
@endsection
