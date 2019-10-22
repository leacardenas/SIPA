<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>{{ config('app.name', 'SIPA') }}</title>

    <!-- Styles -->
    <link href="{{ asset('sass/app.css') }}" rel="stylesheet">

    <!--FontAwsome-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Mukta|Sanchez|Vidaloka&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>

<body>

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
                            <li><a class="links" href="#">Activos</a></li>
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
                    <li><img src="imagenes/logo_vicerrectoria_blanco_transparente.png" class="img-fluid" id="logoVicerrectoriaInicioImg"></li>
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
                        <p id="rol" class='navbar-text navbar-center'>Role del usuario</p>
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav navbar-right">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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

                @yield('content')

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

                <script src="//code.jquery.com/jquery-1.12.3.js"></script>
                <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
                <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
                <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
                <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">

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
    </body>
</html>
