<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="{{ asset('sass/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <title>Configurar Roles</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Mukta|Sanchez|Vidaloka&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

</head>

<body id="cuerpoInicio">
    <div class="wrapper">
        <!-- Sidebar Holder -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3 id="sipaInicio">SIPA</h3>
            </div>

            <ul class="list-unstyled components">
                <p id="accesos">Accesos rápidos</p>
                <li class="active">
                    <a class="links" href="#homeSubmenu" data-toggle="collapse" aria-expanded="false">Inicio</a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li><a class="links" href="#">Configurar Roles</a></li>
                        <li><a class="links" href="#">Configurar cuerpos de correos</a></li>
                        <li><a class="links" href="#">Configurar usuarios nuevos</a></li>
                        <li><a class="links" href="#">Configurar tipos de usuarios</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false">Configurar cuerpo de los
                        correos</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li><a href="#">Page 1</a></li>
                        <li><a href="#">Page 2</a></li>
                        <li><a href="#">Page 3</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false">Configurar usuarios nuevos</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li><a href="#">Page 1</a></li>
                        <li><a href="#">Page 2</a></li>
                        <li><a href="#">Page 3</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false">Configurar tipos de usuarios</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li><a href="#">Page 1</a></li>
                        <li><a href="#">Page 2</a></li>
                        <li><a href="#">Page 3</a></li>
                    </ul>
                </li>
            </ul>

            <ul class="list-unstyled CTAs">
                <li><img src="imagenes/logo_vicerrectoria_blanco_transparente.png" class="img-fluid"
                        id="logoVicerrectoriaInicioImg"></li>
            </ul>
        </nav>

        <!-- Page Content Holder -->
        <div id="content">

            <nav class="navbar">
                <div class="container-fluid">

                    <div class="navbar-header">
                        <button type="button" id="sidebarCollapse" class="navbar-btn">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                    <p id="ruta" class="navbar-text navbar-left">Inicio</p>
                    <p id="rol" class='navbar-text navbar-center'>Super Administrador</p>
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="imagenes/iconoUsuario.png">
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="#" id="user">Ver Perfil</a>
                                    <a class="dropdown-item" href="#" id="user">Salir</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div id="cuadros">
                <div class="cuadro">
                    <button type="button" class="cuadrado" id="botonCuadrado"
                        onclick="abrirModal(event, 'modalCrearRol')"><img src="imagenes/resume.png"></button>
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
                                        <input id="inputNombreRol" type="text" name="nombreRol"
                                            placeholder="Ingrese el nombre del rol">
                                    </div>
                                    <div class="form-group">
                                        <label for="descRol" id="labelDescRol">Descripción</label>
                                        <input id="inputDescRol" type="text"
                                            placeholder="Ingrese la descripción del rol" name="descRol">
                                    </div>
                                    <div class="form-group">
                                        <label for="codigoRol" id="labelCodRol">Código</label>
                                        <input id="inputCodRol" type="text" placeholder="Ingrese el código del rol"
                                            name="codigo">
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
                    <button class="cuadrado"><img src="imagenes/view-files.png"></button>
                    <p class="rol">Ver Roles</p>
                </div>
                <div class="cuadro">
                    <button type="button" class="cuadrado" id="botonCuadrado"
                        onclick="abrirModal(event, 'modalEditarRol')"><img src="imagenes/content.png"></button>
                    <p class="rol">Editar Rol</p>
                    <div id="modalEditarRol" class="modal">
                        <div class="contenidoModal" id="contenidoEditar">
                            <span class="cerrar" onclick="cerrarModal(event, 'modalEditarRol')">&times;</span>
                            <h1 id="editarRol">Editar rol de usuario</h1>
                            <div id="editarRolForm">
                                <form method="POST" action="{{ route('roles.store') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="nombreRolEditar" id="labelNombreRol">Seleccione el rol que desea
                                            editar</label>
                                        <select id="selectEditarRol" placeholder="Seleccione rol...">
                                            <option value="volvo">Volvo</option>
                                            <option value="saab">Saab</option>
                                            <option value="mercedes">Mercedes</option>
                                            <option value="audi">Audi</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="tareasRol" id="labelTareasRol">Seleccione las tareas que desea
                                            agregarle al rol</label>
                                        <select id="selectTareasRol" placeholder="Seleccione tarea...">
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
                    <button type="button" class="cuadrado" id="botonCuadrado"
                        onclick="abrirModal(event, 'modalEliminarRol')"><img src="imagenes/delete.png"></button>
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
                                        <select>
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
                <div class="cuadro">
                    <button class="cuadrado"><img src="imagenes/selection.png"></button>
                    <p class="rol">Aceptar Registro de usuarios</p>
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
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
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

        window.onclick = function (event) {
            var modals = document.getElementsByClassName("modal");
            var i;

            for (i = 0; i < modals.length; i++) {
                if (event.target == modals[i]) {
                    modals[i].style.display = "none";
                }
            }

        }

        //click on x to delete toDo
        $("#tareasSeleccionadas").on("click", "span", function (event) {
            $(this).parent().fadeOut(500, function () {
                $(this).remove();
            });
            event.stopPropagation();
        });

        $("#tareasSeleccionadas").on("click", "li", function (event) {
            $(this).fadeOut(500, function () {
                $(this).remove();
            });
            event.stopPropagation();
        });

        $("#agregar").on("click", function (event) {

            event.preventDefault();

            let tarea = $('#selectTareasRol').find("option:selected").text();

            $("#tareasSeleccionadas").append(
                "<li class='tareaSeleccionada'><span><i class='fa fa-trash'></i></span>     " +
                tarea + "</li>");
        });
    </script>
</body>

</html>