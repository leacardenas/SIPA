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
    <h1 id="editarEstado" class="tituloModal">Ver información del rol <b># {{$rol->sipa_roles_id}}</h1>
</div>

<div class="col-sm-12 justify-content-center">
    <div class="row">
        <label>Nombre de rol</label>
        <input class="form-control" id="inputNombreRol" type="text" name="nombreRol" value="{{$rol->sipa_roles_codigo}}" disabled>
    </div>

    <div class="row">
        <label for="descRol" id="labelDescRol">Descripción</label>
        <input class="form-control" id="inputDescRol" type="text" value="{{$rol->sipa_roles_nombre}}" name="descRol" disabled>
    </div>

    <div class="row">
        <label for="codigoRol" id="labelCodRol">Código</label>
        <input class="form-control" id="inputCodRol" type="text" value="{{$rol->sipa_roles_descripcion}}" name="codigo" disabled>
    </div>

    <hr>

    <div class="col-sm-12 table-responsive-sm">
        <table class="table table-hover" name="table-roles" id="table-usuarios">
                <thead>
                    <tr>
                        <th scope="col" class="text-center"></th>
                        <th scope="col" class="text-center">Crear</th>
                        <th scope="col" class="text-center">Editar</th>
                        <th scope="col" class="text-center">Ver</th>
                        <th scope="col" class="text-center">Borrar</th>
                        <th scope="col" class="text-center">Exportar</th>
                    </tr>
                </thead>

                <tbody class="text-center">
                    <tr>
                        <th class="table-active"><legend>Reservar</legend></th>
                    </tr>
                    <tr>
                        <td class="float-left">Reserva de salas</td>
                        <td class="text-center">
                            <div class="checkbox">
                                <label>
                                    <input id="checkbox" type="checkbox" name="crear_reserva_salas" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'RESERVAR_SALA'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_crear == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="editar_reserva_salas" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'RESERVAR_SALA'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_editar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="borrar_reserva_salas" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'RESERVAR_SALA'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_borrar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="ver_reserva_salas" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'RESERVAR_SALA'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_ver == 1) {echo 'checked';'';}?>/>
                                </label>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="exportar_reserva_salas" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'RESERVAR_SALA'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_exportar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="float-left">Reserva de equipos</td>
                        <td class="text-center">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="crear_reserva_equipos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'RESERVAR_EQUIPO'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_crear == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="editar_reserva_equipos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'RESERVAR_EQUIPO'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_editar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="borrar_reserva_equipos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'RESERVAR_EQUIPO'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_borrar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="ver_reserva_equipos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'RESERVAR_EQUIPO'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_ver == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="exportar_reserva_equipos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'RESERVAR_EQUIPO'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_exportar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-active"><legend>Inventario en uso</legend></th>
                    </tr>
                    <tr>
                        <td class="float-left">Inventario en uso de salas</td>
                        <td class="text-center">
                            <div class="checkbox">
                                <label>
                                    <input id="checkbox" type="checkbox" name="crear_inventario_en_uso_salas" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'INV_USO_SALA'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_crear == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="editar_inventario_en_uso_salas" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'INV_USO_SALA'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_editar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="borrar_inventario_en_uso_salas" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'INV_USO_SALA'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_borrar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="ver_inventario_en_uso_salas" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'INV_USO_SALA'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_ver == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="exportar_inventario_en_uso_salas" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'INV_USO_SALA'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_exportar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="float-left">Inventario en uso de equipos</td>
                        <td class="text-center">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="crear_inventario_en_uso_equipos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'INV_USO_EQUIPO'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_crear == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="editar_inventario_en_uso_equipos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'INV_USO_EQUIPO'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_editar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="borrar_inventario_en_uso_equipos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'INV_USO_EQUIPO'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_borrar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="ver_inventario_en_uso_equipos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'INV_USO_EQUIPO'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_ver == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="exportar_inventario_en_uso_equipos"  <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'INV_USO_EQUIPO'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_exportar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-active"><legend>Entregas</legend></th>
                    </tr>
                    <tr>
                        <td class="float-left">Entrega de salas</td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input id="checkbox" type="checkbox" name="crear_entrega_salas" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'ENTREG_SALA'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_crear == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="editar_entrega_salas" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'ENTREG_SALA'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_editar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="borrar_entrega_salas" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'ENTREG_SALA'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_borrar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="ver_entrega_salas" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'ENTREG_SALA'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_ver == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="exportar_entrega_salas" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'ENTREG_SALA'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_exportar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="float-left">Entrega de equipos</td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="crear_entrega_equipos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'ENTREG_EQUIPO'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_crear == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="editar_entrega_equipos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'ENTREG_EQUIPO'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_editar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="borrar_entrega_equipos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'ENTREG_EQUIPO'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_borrar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="ver_entrega_equipos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'ENTREG_EQUIPO'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_ver == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="exportar_entrega_equipos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'ENTREG_EQUIPO'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_exportar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-active"><legend>Devolución</legend></th>
                    </tr>
                    <tr>
                        <td class="float-left">Devolución de salas</td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input id="checkbox" type="checkbox" name="crear_devolucion_salas" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'DEVOLU_SALA'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_crear == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="editar_devolucion_salas" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'DEVOLU_SALA'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_editar == 1) {echo 'checked';'';}?>  />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="borrar_devolucion_salas" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'DEVOLU_SALA'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_borrar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="ver_devolucion_salas" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'DEVOLU_SALA'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_ver == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="exportar_devolucion_salas" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'DEVOLU_SALA'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_exportar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="float-left">Devolución de equipos</td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="crear_devolucion_equipos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'DEVOLU_EQUIPO'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_crear == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="editar_devolucion_equipos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'DEVOLU_EQUIPO'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_editar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="borrar_devolucion_equipos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'DEVOLU_EQUIPO'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_borrar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="ver_devolucion_equipos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'DEVOLU_EQUIPO'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_ver == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="exportar_devolucion_equipos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'DEVOLU_EQUIPO'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_exportar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-active"><legend>Inventario</legend></th>
                    </tr>
                    <tr>
                        <td class="float-left">Inventario de salas</td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input id="checkbox" type="checkbox" name="crear_inventario_salas" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'INV_SALA'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_crear == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="editar_inventario_salas" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'INV_SALA'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_editar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="borrar_inventario_salas" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'INV_SALA'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_borrar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="ver_inventario_salas" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'INV_SALA'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_ver == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="exportar_inventario_salas" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'INV_SALA'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_exportar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="float-left">Inventario de equipos</td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="crear_inventario_equipos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'INV_EQUIPO'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_crear == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="editar_inventario_equipos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'INV_EQUIPO'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_editar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="borrar_inventario_equipos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'INV_EQUIPO'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_borrar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="ver_inventario_equipos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'INV_EQUIPO'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_ver == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="exportar_inventario_equipos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'INV_EQUIPO'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_exportar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="float-left">Inventario de insumos</td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="crear_inventario_insumos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'INV_INSUMO'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_crear == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="editar_inventario_insumos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'INV_INSUMO'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_editar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="borrar_inventario_insumos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'INV_INSUMO'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_borrar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="ver_inventario_insumos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'INV_INSUMO'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_ver == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="exportar_inventario_insumos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'INV_INSUMO'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_exportar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-active"><legend>Formularios</legend></th>
                    </tr>
                    <tr>
                        <td style="width: 90px; text-align: center;">Formularios</td>
                        <td style="width: 91px; text-align: center;">
                            <div class="checkbox">
                                <label>
                                    <input id="checkbox" type="checkbox" name="crear_formularios" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'INV_FORMULARIOS'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_crear == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td style="width: 91px; text-align: center;">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="editar_formularios" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'INV_FORMULARIOS'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_editar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td style="width: 92px; text-align: center;">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="borrar_formularios" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'INV_FORMULARIOS'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_borrar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td style="width: 91px; text-align: center;">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="ver_formularios" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'INV_FORMULARIOS'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_ver == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td style="width: 120px; text-align: center;">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="exportar_formularios" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'INV_FORMULARIOS'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_exportar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-active"><legend>Historial</legend></th>
                    </tr>
                    <tr>
                        <td class="float-left">Historial de salas</td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input id="checkbox" type="checkbox" name="crear_historial_salas" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'HISTO_SALA'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_crear == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="editar_historial_salas" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'HISTO_SALA'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_editar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="borrar_historial_salas" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'HISTO_SALA'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_borrar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="ver_historial_salas" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'HISTO_SALA'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_ver == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="exportar_historial_salas" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'HISTO_SALA'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_exportar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="float-left">Historial de equipos</td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input id="checkbox" type="checkbox" name="crear_historial_equipos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'HISTO_EQUIPO'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_crear == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="editar_historial_equipos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'HISTO_EQUIPO'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_editar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="borrar_historial_equipos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'HISTO_EQUIPO'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_borrar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="ver_historial_equipos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'HISTO_EQUIPO'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_ver == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="exportar_historial_equipos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'HISTO_EQUIPO'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_exportar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-active"><legend>Configuración</legend></th>
                    </tr>
                    <tr>
                        <td class="float-left">Configuración de correos</td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="crear_configuracion_correos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'CONFIG_CORREOS'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_crear == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="editar_configuracion_correos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'CONFIG_CORREOS'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_editar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="borrar_configuracion_correos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'CONFIG_CORREOS'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_borrar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="ver_configuracion_correos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'CONFIG_CORREOS'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_ver == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="exportar_configuracion_correos" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'CONFIG_CORREOS'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_exportar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td class="float-left">Configuración de usuarios</td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="crear_configuracion_usuarios" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'CONFIG_USUARIOS'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_crear == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="editar_configuracion_usuarios" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'CONFIG_USUARIOS'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_editar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="borrar_configuracion_usuarios" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'CONFIG_USUARIOS'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_borrar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="ver_configuracion_usuarios" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'CONFIG_USUARIOS'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_ver == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="exportar_configuracion_usuarios" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'CONFIG_USUARIOS'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_exportar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td class="float-left">Configuración de tipos de usuario</td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="crear_configuracion_tipos_de_usuario" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'CONFIG_TIPO_USUARIOS'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_crear == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="editar_configuracion_tipos_de_usuario" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'CONFIG_TIPO_USUARIOS'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_editar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="borrar_configuracion_tipos_de_usuario" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'CONFIG_TIPO_USUARIOS'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_borrar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="ver_configuracion_tipos_de_usuario" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'CONFIG_TIPO_USUARIOS'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_ver == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="exportar_configuracion_tipos_de_usuario" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'CONFIG_TIPO_USUARIOS'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_exportar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td class="float-left">Configuración de roles</td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="crear_configuracion_roles" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'CONFIG_ROLES'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_crear == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label> 
                                    <input type="checkbox" name="editar_configuracion_roles" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'CONFIG_ROLES'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_editar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="borrar_configuracion_roles" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'CONFIG_ROLES'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_borrar == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="ver_configuracion_roles" <?php $id_rs=$_menusController->encontrarPermiso($permisos_de_rol, 'CONFIG_ROLES'); if ($permisos_de_rol[$id_rs]->sipa_permisos_roles_ver == 1) {echo 'checked';'';}?> />
                                </label>
                            </div>
                        </td>
                        <td>
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
</div>

<script>
    $("input[type='checkbox']").prop("disabled", true);
</script>
@endsection