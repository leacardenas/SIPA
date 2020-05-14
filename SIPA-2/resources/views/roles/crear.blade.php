@extends('plantillas.inicio')

@section('ruta')
<p id="rol" class="navbar-text navbar-center">Configurar Roles</p>
@stop

@section('content')

<div class="row col-sm-12">
    <form method="get" action="{{url('/configuracionesRoles')}}">
        <button type="submit" type="button" class="btn btn-secondary volver">
            <span class="glyphicon glyphicon-chevron-left"></span> Volver
        </button>
    </form>
</div>

<div class="row justify-content-center col-sm-12">
    <h1 class="rol">Crear Rol</h1>
</div>

<div class="row col-sm-12 justify-content-center configRol">
    <form method="POST" action="{{ route('roles.store') }}" class="configForm">
    @csrf
        <div class="form-group">
            <label for="nombreRol" id="labelNombreRol">Nombre de rol</label>
            <input class="form-control" id="inputNombreRol" type="text" name="nombreRol" placeholder="Ingrese el nombre del rol" required>
        </div>

        <div class="form-group">
            <label for="descRol" id="labelDescRol">Descripción</label>
            <input class="form-control" id="inputDescRol" type="text" placeholder="Ingrese la descripción del rol" name="descRol" required>
        </div>

        <div class="form-group">
            <label for="codigoRol" id="labelCodRol">Código</label>
            <input class="form-control" id="inputCodRol" type="text" placeholder="Ingrese el código del rol" name="codigo" required>
        </div>

        <hr>

        <script language="JavaScript">
            function toggle(source) {
                checkboxes = document.getElementsByTagName('input');
                for(var i=0, n=checkboxes.length;i<n;i++) {
                    checkboxes[i].checked = source.checked;
                }
            }
        </script>

        <input type="checkbox" onClick="toggle(this)" /> Seleccionar todo<br/>

        <table style="height: 114px; width: 613px;">
            <tbody>
                <tr>
                    <td style="width: 90px; text-align: center;">&nbsp;</td>
                    <td style="width: 91px; text-align: center;"><strong>Crear</strong></td>
                    <td style="width: 91px; text-align: center;"><strong>Editar</strong></td>
                    <td style="width: 92px; text-align: center;"><strong>Borrar</strong></td>
                    <td style="width: 91px; text-align: center;"><strong>Ver</strong></td>

                    <td style="width: 120px; text-align: center;"><strong>Exportar</strong></td>
                </tr>
                <tr>
                    <td style="width: 90px; text-align: center;"><strong>Reservar</strong></td>
                </tr>
                <tr>
                    <td style="width: 90px; text-align: center;">Reserva de salas</td>
                    <td style="width: 91px; text-align: center;">
                        <div class="checkbox">
                            <label>
                                <input id="checkbox" type="checkbox" name="crear_reserva_salas" />
                            </label>
                        </div>
                    </td>
                    <td style="width: 91px; text-align: center;">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="editar_reserva_salas" />
                            </label>
                        </div>
                    </td>
                    <td style="width: 92px; text-align: center;">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="borrar_reserva_salas" />
                            </label>
                        </div>
                    </td>
                    <td style="width: 91px; text-align: center;">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="ver_reserva_salas" />
                            </label>
                        </div>
                    </td>
                    <td style="width: 120px; text-align: center;">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="exportar_reserva_salas" />
                            </label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 90px; text-align: center;">Reserva de equipos</td>
                    <td style="width: 91px; text-align: center;">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="crear_reserva_equipos" />
                            </label>
                        </div>
                    </td>
                    <td style="width: 91px; text-align: center;">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="editar_reserva_equipos" />
                            </label>
                        </div>
                    </td>
                    <td style="width: 92px; text-align: center;">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="borrar_reserva_equipos" />
                            </label>
                        </div>
                    </td>
                    <td style="width: 91px; text-align: center;">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="ver_reserva_equipos" />
                            </label>
                        </div>
                    </td>
                    <td style="width: 120px; text-align: center;">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="exportar_reserva_equipos" />
                            </label>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td style="width: 90px; text-align: center;"><strong>Inventario en uso</strong></td>
                </tr>
                <tr>
                    <td style="width: 90px; text-align: center;">Inventario en uso de salas</td>
                    <td style="width: 91px; text-align: center;">
                        <div class="checkbox">
                            <label>
                                <input id="checkbox" type="checkbox" name="crear_inventario_en_uso_salas" />
                            </label>
                        </div>
                    </td>
                    <td style="width: 91px; text-align: center;">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="editar_inventario_en_uso_salas" />
                            </label>
                        </div>
                    </td>
                    <td style="width: 92px; text-align: center;">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="borrar_inventario_en_uso_salas" />
                            </label>
                        </div>
                    </td>
                    <td style="width: 91px; text-align: center;">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="ver_inventario_en_uso_salas" />
                            </label>
                        </div>
                    </td>
                    <td style="width: 120px; text-align: center;">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="exportar_inventario_en_uso_salas" />
                            </label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 90px; text-align: center;">Inventario en uso de equipos</td>
                    <td style="width: 91px; text-align: center;">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="crear_inventario_en_uso_equipos" />
                            </label>
                        </div>
                    </td>
                    <td style="width: 91px; text-align: center;">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="editar_inventario_en_uso_equipos" />
                            </label>
                        </div>
                    </td>
                    <td style="width: 92px; text-align: center;">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="borrar_inventario_en_uso_equipos" />
                            </label>
                        </div>
                    </td>
                    <td style="width: 91px; text-align: center;">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="ver_inventario_en_uso_equipos" />
                            </label>
                        </div>
                    </td>
                    <td style="width: 120px; text-align: center;">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="exportar_inventario_en_uso_equipos" />
                            </label>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td style="width: 90px; text-align: center;"><strong>Entregas</strong></td>
                </tr>
                <tr>
                    <td style="width: 90px; text-align: center;">Entrega de salas</td>
                    <td style="width: 91px; text-align: center;">
                        <div class="checkbox">
                            <label>
                                <input id="checkbox" type="checkbox" name="crear_entrega_salas" />
                            </label>
                        </div>
                    </td>
                    <td style="width: 91px; text-align: center;">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="editar_entrega_salas" />
                            </label>
                        </div>
                    </td>
                    <td style="width: 92px; text-align: center;">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="borrar_entrega_salas" />
                            </label>
                        </div>
                    </td>
                    <td style="width: 91px; text-align: center;">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="ver_entrega_salas" />
                            </label>
                        </div>
                    </td>
                    <td style="width: 120px; text-align: center;">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="exportar_entrega_salas" />
                            </label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 90px; text-align: center;">Entrega de equipos</td>
                    <td style="width: 91px; text-align: center;">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="crear_entrega_equipos" />
                            </label>
                        </div>
                    </td>
                    <td style="width: 91px; text-align: center;">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="editar_entrega_equipos" />
                            </label>
                        </div>
                    </td>
                    <td style="width: 92px; text-align: center;">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="borrar_entrega_equipos" />
                            </label>
                        </div>
                    </td>
                    <td style="width: 91px; text-align: center;">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="ver_entrega_equipos" />
                            </label>
                        </div>
                    </td>
                    <td style="width: 120px; text-align: center;">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="exportar_entrega_equipos" />
                            </label>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td style="width: 90px; text-align: center;"><strong>Devolución</strong></td>
                </tr>
                <tr>
                    <td style="width: 90px; text-align: center;">Devolución de salas</td>
                    <td style="width: 91px; text-align: center;">
                        <div class="checkbox">
                            <label>
                                <input id="checkbox" type="checkbox" name="crear_devolucion_salas" />
                            </label>
                        </div>
                    </td>
                    <td style="width: 91px; text-align: center;">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="editar_devolucion_salas" />
                            </label>
                        </div>
                    </td>
                    <td style="width: 92px; text-align: center;">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="borrar_devolucion_salas" />
                            </label>
                        </div>
                    </td>
                    <td style="width: 91px; text-align: center;">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="ver_devolucion_salas" />
                            </label>
                        </div>
                    </td>
                    <td style="width: 120px; text-align: center;">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="exportar_devolucion_salas" />
                            </label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 90px; text-align: center;">Devolución de equipos</td>
                    <td style="width: 91px; text-align: center;">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="crear_devolucion_equipos" />
                            </label>
                        </div>
                    </td>
                    <td style="width: 91px; text-align: center;">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="editar_devolucion_equipos" />
                            </label>
                        </div>
                    </td>
                    <td style="width: 92px; text-align: center;">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="borrar_devolucion_equipos" />
                            </label>
                        </div>
                    </td>
                    <td style="width: 91px; text-align: center;">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="ver_devolucion_equipos" />
                            </label>
                        </div>
                    </td>
                    <td style="width: 120px; text-align: center;">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="exportar_devolucion_equipos" />
                            </label>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td style="width: 90px; text-align: center;"><strong>Inventario</strong></td>
                </tr>
                <tr>
                    <td style="width: 90px; text-align: center;">Inventario de salas</td>
                    <td style="width: 91px; text-align: center;">
                        <div class="checkbox">
                            <label>
                                <input id="checkbox" type="checkbox" name="crear_inventario_salas" />
                            </label>
                        </div>
                    </td>
                    <td style="width: 91px; text-align: center;">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="editar_inventario_salas" />
                            </label>
                        </div>
                    </td>
                    <td style="width: 92px; text-align: center;">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="borrar_inventario_salas" />
                            </label>
                        </div>
                    </td>
                    <td style="width: 91px; text-align: center;">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="ver_inventario_salas" />
                            </label>
                        </div>
                    </td>
                    <td style="width: 120px; text-align: center;">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="exportar_inventario_salas" />
                            </label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 90px; text-align: center;">Inventario de equipos</td>
                    <td style="width: 91px; text-align: center;">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="crear_inventario_equipos" />
                            </label>
                        </div>
                    </td>
                    <td style="width: 91px; text-align: center;">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="editar_inventario_equipos" />
                            </label>
                        </div>
                    </td>
                    <td style="width: 92px; text-align: center;">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="borrar_inventario_equipos" />
                            </label>
                        </div>
                    </td>
                    <td style="width: 91px; text-align: center;">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="ver_inventario_equipos" />
                            </label>
                        </div>
                    </td>
                    <td style="width: 120px; text-align: center;">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="exportar_inventario_equipos" />
                            </label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 90px; text-align: center;">Inventario de insumos</td>
                    <td style="width: 91px; text-align: center;">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="crear_inventario_insumos" />
                            </label>
                        </div>
                    </td>
                    <td style="width: 91px; text-align: center;">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="editar_inventario_insumos" />
                            </label>
                        </div>
                    </td>
                    <td style="width: 92px; text-align: center;">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="borrar_inventario_insumos" />
                            </label>
                        </div>
                    </td>
                    <td style="width: 91px; text-align: center;">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="ver_inventario_insumos" />
                            </label>
                        </div>
                    </td>
                    <td style="width: 120px; text-align: center;">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="exportar_inventario_insumos" />
                            </label>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td style="width: 90px; text-align: center;"><strong>Formularios</strong></td>
                </tr>
                <tr>
                    <td style="width: 90px; text-align: center;">Formularios</td>
                    <td style="width: 91px; text-align: center;">
                        <div class="checkbox">
                            <label>
                                <input id="checkbox" type="checkbox" name="crear_formularios" />
                            </label>
                        </div>
                    </td>
                    <td style="width: 91px; text-align: center;">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="editar_formularios" />
                            </label>
                        </div>
                    </td>
                    <td style="width: 92px; text-align: center;">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="borrar_formularios" />
                            </label>
                        </div>
                    </td>
                    <td style="width: 91px; text-align: center;">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="ver_formularios" />
                            </label>
                        </div>
                    </td>
                    <td style="width: 120px; text-align: center;">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="exportar_formularios" />
                            </label>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td style="width: 90px; text-align: center;"><strong>Historial</strong></td>
                </tr>
                <tr>
                    <td style="width: 90px; text-align: center;">Historial de salas</td>
                    <td style="width: 91px; text-align: center;">
                        <div class="checkbox">
                            <label>
                                <input id="checkbox" type="checkbox" name="crear_historial_salas" />
                            </label>
                        </div>
                    </td>
                    <td style="width: 91px; text-align: center;">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="editar_historial_salas" />
                            </label>
                        </div>
                    </td>
                    <td style="width: 92px; text-align: center;">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="borrar_historial_salas" />
                            </label>
                        </div>
                    </td>
                    <td style="width: 91px; text-align: center;">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="ver_historial_salas" />
                            </label>
                        </div>
                    </td>
                    <td style="width: 120px; text-align: center;">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="exportar_historial_salas" />
                            </label>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td style="width: 90px; text-align: center;">Historial de equipos</td>
                    <td style="width: 91px; text-align: center;">
                        <div class="checkbox">
                            <label>
                                <input id="checkbox" type="checkbox" name="crear_historial_equipos" />
                            </label>
                        </div>
                    </td>
                    <td style="width: 91px; text-align: center;">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="editar_historial_equipos" />
                            </label>
                        </div>
                    </td>
                    <td style="width: 92px; text-align: center;">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="borrar_historial_equipos" />
                            </label>
                        </div>
                    </td>
                    <td style="width: 91px; text-align: center;">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="ver_historial_equipos" />
                            </label>
                        </div>
                    </td>
                    <td style="width: 120px; text-align: center;">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="exportar_historial_equipos" />
                            </label>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td style="width: 90px; text-align: center;"><strong>Configuración</strong></td>
                </tr>
                <tr>
                    <td style="width: 90px; text-align: center;">Configuración de correos</td>
                    <td style="width: 91px; text-align: center;">
                    <div class="checkbox">
                            <label>
                                <input type="checkbox" name="crear_configuracion_correos" />
                            </label>
                        </div>
                    </td>
                    <td style="width: 91px; text-align: center;">
                    <div class="checkbox">
                            <label>
                                <input type="checkbox" name="editar_configuracion_correos" />
                            </label>
                        </div>
                    </td>
                    <td style="width: 92px; text-align: center;">
                    <div class="checkbox">
                            <label>
                                <input type="checkbox" name="borrar_configuracion_correos" />
                            </label>
                        </div>
                    </td>
                    <td style="width: 91px; text-align: center;">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="ver_configuracion_correos" />
                            </label>
                        </div>
                    </td>
                    <td style="width: 120px; text-align: center;">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="exportar_configuracion_correos" />
                            </label>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td style="width: 90px; text-align: center;">Configuración de usuarios</td>
                    <td style="width: 91px; text-align: center;">
                    <div class="checkbox">
                            <label>
                                <input type="checkbox" name="crear_configuracion_usuarios" />
                            </label>
                        </div>
                    </td>
                    <td style="width: 91px; text-align: center;">
                    <div class="checkbox">
                            <label>
                                <input type="checkbox" name="editar_configuracion_usuarios" />
                            </label>
                        </div>
                    </td>
                    <td style="width: 92px; text-align: center;">
                    <div class="checkbox">
                            <label>
                                <input type="checkbox" name="borrar_configuracion_usuarios" />
                            </label>
                        </div>
                    </td>
                    <td style="width: 91px; text-align: center;">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="ver_configuracion_usuarios" />
                            </label>
                        </div>
                    </td>
                    <td style="width: 120px; text-align: center;">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="exportar_configuracion_usuarios" />
                            </label>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td style="width: 90px; text-align: center;">Configuración de tipos de usuario</td>
                    <td style="width: 91px; text-align: center;">
                    <div class="checkbox">
                            <label>
                                <input type="checkbox" name="crear_configuracion_tipos_de_usuario" />
                            </label>
                        </div>
                    </td>
                    <td style="width: 91px; text-align: center;">
                    <div class="checkbox">
                            <label>
                                <input type="checkbox" name="editar_configuracion_tipos_de_usuario" />
                            </label>
                        </div>
                    </td>
                    <td style="width: 92px; text-align: center;">
                    <div class="checkbox">
                            <label>
                                <input type="checkbox" name="borrar_configuracion_tipos_de_usuario" />
                            </label>
                        </div>
                    </td>
                    <td style="width: 91px; text-align: center;">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="ver_configuracion_tipos_de_usuario" />
                            </label>
                        </div>
                    </td>
                    <td style="width: 120px; text-align: center;">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="exportar_configuracion_tipos_de_usuario" />
                            </label>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td style="width: 90px; text-align: center;">Configuración de roles</td>
                    <td style="width: 91px; text-align: center;">
                    <div class="checkbox">
                            <label>
                                <input type="checkbox" name="crear_configuracion_roles" />
                            </label>
                        </div>
                    </td>
                    <td style="width: 91px; text-align: center;">
                    <div class="checkbox">
                            <label>
                                <input type="checkbox" name="editar_configuracion_roles" />
                            </label>
                        </div>
                    </td>
                    <td style="width: 92px; text-align: center;">
                    <div class="checkbox">
                            <label>
                                <input type="checkbox" name="borrar_configuracion_roles" />
                            </label>
                        </div>
                    </td>
                    <td style="width: 91px; text-align: center;">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="ver_configuracion_roles" />
                            </label>
                        </div>
                    </td>
                    <td style="width: 120px; text-align: center;">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="exportar_configuracion_roles" />
                            </label>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

        </br>

        <button type="submit" class="btn btn-primary boton-config" id="crearRolBoton"> Crear </button>
        </form>
</div>

@endsection