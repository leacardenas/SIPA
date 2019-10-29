@extends('plantillas.inicio')

@section('content')
@php
$cedula = session('idUsuario');
$user = App\User::where('sipa_usuarios_identificacion',$cedula)->get()[0];
$modulo = App\Modulo::where('sipa_opciones_menu_codigo',"INV_EQUIPO")->get()[0];
$permiso = App\Permiso::where('sipa_permisos_roles_role', $user->rol->sipa_roles_id)->where('sipa_permisos_roles_opciones_menu', $modulo->sipa_opciones_menu_id)->get()[0];
@endphp

<form method="get" action="{{url('/configuraciones')}}">
    <button type="submit" type="button" class="btn btn-secondary">
        <span class="glyphicon glyphicon-circle-arrow-left"></span> Volver
    </button>
</form>

<div id="cuadros">
    <div class="cuadro">
        <button type="button" class="cuadrado" id="botonCuadrado" onclick="abrirModal(event, 'modalCrearRol')"><img src="imagenes/resume.png"></button>
        <p class="rol">Crear Rol</p>
        <div id="modalCrearRol" class="modal">
            <div class="contenidoModal" id="contenidoCrear">
                <span class="cerrar" onclick="cerrarModal(event, 'modalCrearRol')">&times;</span>
                <h1 id="crearRol">Crear rol de usuario</h1>
                <div id="crearRolForm">
                    <form method="POST" action="{{ route('roles.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="nombreRol" id="labelNombreRol">Nombre de rol</label>
                            <input id="inputNombreRol" type="text" name="nombreRol" placeholder="Ingrese el nombre del rol" required>
                        </div>
                        <div class="form-group">
                            <label for="descRol" id="labelDescRol">Descripción</label>
                            <input id="inputDescRol" type="text" placeholder="Ingrese la descripción del rol" name="descRol" required>
                        </div>
                        <div class="form-group">
                            <label for="codigoRol" id="labelCodRol">Código</label>
                            <input id="inputCodRol" type="text" placeholder="Ingrese el código del rol" name="codigo" required>
                        </div>
                        <button type="submit" class="btn btn-primary" id="crearRolBoton">
                            Crear
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="cuadro">
        <form method="get" action="{{ url('/roles') }}">
            <button class="cuadrado" type="submit"><img class="menu-icons" src="imagenes/view-files.png"></button>
        </form>
        <p class="inventario">Ver Roles</p>
    </div>
    <div class="cuadro">
        <button type="button" class="cuadrado" id="botonCuadrado" onclick="abrirModal(event, 'modalEditarRol')"><img src="imagenes/content.png"></button>
        <p class="rol">Editar Rol</p>
        <div id="modalEditarRol" class="modal">
            <div class="contenidoModal" id="contenidoEditar">
                <span class="cerrar" onclick="cerrarModal(event, 'modalEditarRol')">&times;</span>
                <h1 id="editarRol">Editar rol de usuario</h1>
                <div id="editarRolForm">
                    <form method="POST" action="{{ route('roles.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="nombreRolEditar" id="labelNombreRol">Seleccione el rol que desea editar</label>
                            <select id="selectEditarRol" placeholder="Seleccione rol..." required>
                                <option value="volvo">Volvo</option>
                                <option value="saab">Saab</option>
                                <option value="mercedes">Mercedes</option>
                                <option value="audi">Audi</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tareasRol" id="labelTareasRol">Seleccione las tareas que desea agregarle al rol</label>
                            <select id="selectTareasRol" placeholder="Seleccione tarea..." required>
                                <option value="volvo">Volvo</option>
                                <option value="saab">Saab</option>
                                <option value="mercedes">Mercedes</option>
                                <option value="audi">Audi</option>
                            </select>
                            <button id="agregar">Agregar</button>
                        </div>
                        <div class="form-group">
                            <ul id="tareasSeleccionadas">
                            </ul>
                        </div>
                        <button type="submit" class="btn btn-primary" id="crearRolBoton">
                            Editar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="cuadro">
        <button type="button" class="cuadrado" id="botonCuadrado" onclick="abrirModal(event, 'modalEliminarRol')"><img src="imagenes/delete.png"></button>
        <p class="rol">Eliminar Rol</p>
        <div id="modalEliminarRol" class="modal">
            <div class="contenidoModal" id="contenidoEliminar">
                <span class="cerrar" onclick="cerrarModal(event, 'modalEliminarRol')">&times;</span>
                <h1 id="crearRol">Eliminar rol de usuario</h1>
                <div id="crearRolForm">
                    <form method="POST" action="{{ route('roles.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="nombreRol" id="labelNombreRol">Seleccione el rol que desea
                                eliminar</label>
                            <select required>
                                <option value="volvo">Volvo</option>
                                <option value="saab">Saab</option>
                                <option value="mercedes">Mercedes</option>
                                <option value="audi">Audi</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary" id="eliminarRolBoton">
                            Eliminar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<!-- Footer -->
<footer id="footer">
    <div class="contenedorFooter">
        <span id="copyright">© 2019 Copyright:
            <a href="https://www.una.ac.cr/" id="footerLink"> Universidad Nacional de Costa Rica</a>
        </span>
    </div>
</footer>

<!-- jQuery CDN -->
<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
<!-- Bootstrap Js CDN -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#sidebarCollapse').on('click', function() {
            $('#sidebar').toggleClass('active');
            $(this).toggleClass('active');
        });
    });

    // When the user clicks the button, open the modal 
    function abrirModal(evt, modal) {
        var i, modals;

        modals = document.getElementsByClassName("modal");
        for (i = 0; i < modals.length; i++) {
            modals[i].style.display = "none";
        }

        document.getElementById(modal).style.display = "block";
    }

    function cerrarModal(evt, modal) {
        document.getElementById(modal).style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it

    window.onclick = function(event) {
        var modals = document.getElementsByClassName("modal");
        var i;

        for (i = 0; i < modals.length; i++) {
            if (event.target == modals[i]) {
                modals[i].style.display = "none";
            }
        }

    }

    //click on x to delete toDo
    $("#tareasSeleccionadas").on("click", "span", function(event) {
        $(this).parent().fadeOut(500, function() {
            $(this).remove();
        });
        event.stopPropagation();
    });

    $("#tareasSeleccionadas").on("click", "li", function(event) {
        $(this).fadeOut(500, function() {
            $(this).remove();
        });
        event.stopPropagation();
    });

    $("#agregar").on("click", function(event) {

        event.preventDefault();

        let tarea = $('#selectTareasRol').find("option:selected").text();

        $("#tareasSeleccionadas").append(
            "<li class='tareaSeleccionada'><span><i class='fa fa-trash'></i></span>     " +
            tarea + "</li>");
    });
</script>
@endsection