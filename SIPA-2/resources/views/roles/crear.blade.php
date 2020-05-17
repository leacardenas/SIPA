@extends('plantillas.inicio')

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

<div class="row col-sm-12 justify-content-center">
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
                                    <input id="checkbox" type="checkbox" name="crear_reserva_salas" />
                                </label>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="editar_reserva_salas" />
                                </label>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="borrar_reserva_salas" />
                                </label>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="ver_reserva_salas" />
                                </label>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="exportar_reserva_salas" />
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="float-left">Reserva de equipos</td>
                        <td class="text-center">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="crear_reserva_equipos" />
                                </label>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="editar_reserva_equipos" />
                                </label>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="borrar_reserva_equipos" />
                                </label>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="ver_reserva_equipos" />
                                </label>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="exportar_reserva_equipos" />
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
                                    <input id="checkbox" type="checkbox" name="crear_inventario_en_uso_salas" />
                                </label>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="editar_inventario_en_uso_salas" />
                                </label>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="borrar_inventario_en_uso_salas" />
                                </label>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="ver_inventario_en_uso_salas" />
                                </label>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="exportar_inventario_en_uso_salas" />
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="float-left">Inventario en uso de equipos</td>
                        <td class="text-center">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="crear_inventario_en_uso_equipos" />
                                </label>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="editar_inventario_en_uso_equipos" />
                                </label>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="borrar_inventario_en_uso_equipos" />
                                </label>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="ver_inventario_en_uso_equipos" />
                                </label>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="exportar_inventario_en_uso_equipos" />
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
                                    <input id="checkbox" type="checkbox" name="crear_entrega_salas" />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="editar_entrega_salas" />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="borrar_entrega_salas" />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="ver_entrega_salas" />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="exportar_entrega_salas" />
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="float-left">Entrega de equipos</td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="crear_entrega_equipos" />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="editar_entrega_equipos" />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="borrar_entrega_equipos" />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="ver_entrega_equipos" />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="exportar_entrega_equipos" />
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
                                    <input id="checkbox" type="checkbox" name="crear_devolucion_salas" />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="editar_devolucion_salas" />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="borrar_devolucion_salas" />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="ver_devolucion_salas" />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="exportar_devolucion_salas" />
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="float-left">Devolución de equipos</td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="crear_devolucion_equipos" />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="editar_devolucion_equipos" />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="borrar_devolucion_equipos" />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="ver_devolucion_equipos" />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="exportar_devolucion_equipos" />
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
                                    <input id="checkbox" type="checkbox" name="crear_inventario_salas" />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="editar_inventario_salas" />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="borrar_inventario_salas" />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="ver_inventario_salas" />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="exportar_inventario_salas" />
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="float-left">Inventario de equipos</td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="crear_inventario_equipos" />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="editar_inventario_equipos" />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="borrar_inventario_equipos" />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="ver_inventario_equipos" />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="exportar_inventario_equipos" />
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="float-left">Inventario de insumos</td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="crear_inventario_insumos" />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="editar_inventario_insumos" />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="borrar_inventario_insumos" />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="ver_inventario_insumos" />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="exportar_inventario_insumos" />
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
                        <th class="table-active"><legend>Historial</legend></th>
                    </tr>
                    <tr>
                        <td class="float-left">Historial de salas</td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input id="checkbox" type="checkbox" name="crear_historial_salas" />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="editar_historial_salas" />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="borrar_historial_salas" />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="ver_historial_salas" />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="exportar_historial_salas" />
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="float-left">Historial de equipos</td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input id="checkbox" type="checkbox" name="crear_historial_equipos" />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="editar_historial_equipos" />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="borrar_historial_equipos" />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="ver_historial_equipos" />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="exportar_historial_equipos" />
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
                                    <input type="checkbox" name="crear_configuracion_correos" />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="editar_configuracion_correos" />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="borrar_configuracion_correos" />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="ver_configuracion_correos" />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="exportar_configuracion_correos" />
                                </label>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td class="float-left">Configuración de usuarios</td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="crear_configuracion_usuarios" />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="editar_configuracion_usuarios" />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="borrar_configuracion_usuarios" />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="ver_configuracion_usuarios" />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="exportar_configuracion_usuarios" />
                                </label>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td class="float-left">Configuración de tipos de usuario</td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="crear_configuracion_tipos_de_usuario" />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="editar_configuracion_tipos_de_usuario" />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="borrar_configuracion_tipos_de_usuario" />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="ver_configuracion_tipos_de_usuario" />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="exportar_configuracion_tipos_de_usuario" />
                                </label>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td class="float-left">Configuración de roles</td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="crear_configuracion_roles" />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="editar_configuracion_roles" />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="borrar_configuracion_roles" />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="ver_configuracion_roles" />
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="exportar_configuracion_roles" />
                                </label>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        
        </div>

            <button type="submit" class="btn botonLargo mt-3" id="crearRolBoton"> Guardar </button>
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