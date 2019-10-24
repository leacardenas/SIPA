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

    @php
    $cedula = session('idUsuario');
    $permisos = App\User::where('sipa_usuarios_identificacion',$cedula)->get()[0]->rol->permisos;
    $user = App\User::where('sipa_usuarios_identificacion',$cedula)->get()[0];
    @endphp

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

                        @foreach($permisos as $permiso)
                        @if($permiso->modulo->sipa_opciones_menu_codigo == 'RESERVAR')
                    <li>
                        <a href="#reservar" data-toggle="collapse" aria-expanded="false">Reservar</a>
                        <ul class="collapse list-unstyled" id="reservar">
                            <li><a href="/reservasEquipos">Equipo</a></li>
                            <!-- <li><a href="#">Sala</a></li> -->
                        </ul>
                    </li>
                    @endif

                    @if($permiso->modulo->sipa_opciones_menu_codigo == 'INV')
                    <li>
                        <a href="#inventario" data-toggle="collapse" aria-expanded="false">Inventario</a>
                        <ul class="collapse list-unstyled" id="inventario">
                            <li><a href="/inventarioEquipos">Equipo</a></li>
                            <!-- <li><a href="#">Sala</a></li>
                            <li><a href="#">Insumos</a></li> -->
                        </ul>
                    </li>
                    @endif

                    @if($permiso->modulo->sipa_opciones_menu_codigo == 'CONFIG')
                    <li>
                        <a href="#configuraciones" data-toggle="collapse" aria-expanded="false">Configuraciones</a>
                        <ul class="collapse list-unstyled" id="configuraciones">
                            <li><a href="/configuracionesRoles">Roles</a></li>
                            <li><a href="/configuracionesUsuarios">Usuarios</a></li>
                            <!-- <li><a href="#">Tipo de usuario</a></li>
                            <li><a href="#">Cuerpo de correos</a></li> -->
                        </ul>
                    </li>
                    @endif


                    <!-- <li>
                        <a href="#enUso" data-toggle="collapse" aria-expanded="false">Inventario en uso</a>
                        <ul class="collapse list-unstyled" id="enUso">
                            <li><a href="#">Equipo</a></li>
                            <li><a href="#">Sala</a></li>
                            <li><a href="#">Formularios</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="#historial" data-toggle="collapse" aria-expanded="false">Historial</a>
                        <ul class="collapse list-unstyled" id="historial">
                            <li>
                                <a href="#historialSalas" data-toggle="collapse" aria-expanded="false">Salas</a>
                                <ul class="collapse list-unstyled" id="historialSalas">
                                    <li><a href="#">Reservas anticipadas</a></li>
                                    <li><a href="#">Reserva rápida</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#historialEquipos" data-toggle="collapse" aria-expanded="false">Equipos</a>
                                <ul class="collapse list-unstyled" id="historialEquipos">
                                    <li><a href="#">Reservas anticipadas</a></li>
                                    <li><a href="#">Reserva rápida</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="#entregas" data-toggle="collapse" aria-expanded="false">Entregas</a>
                        <ul class="collapse list-unstyled" id="entregas">
                            <li><a href="#">Equipo</a></li>
                            <li><a href="#">Sala</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="#devoluciones" data-toggle="collapse" aria-expanded="false">Devoluciones</a>
                        <ul class="collapse list-unstyled" id="devoluciones">
                            <li><a href="#">Equipo</a></li>
                            <li><a href="#">Sala</a></li>
                        </ul>
                    </li> -->

                    @endforeach
                </ul>
                </li>



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
                        <p id="rol" class='navbar-text navbar-center'>{{$user->rol->sipa_roles_nombre}} - {{$user->sipa_usuarios_nombre}}</p>
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
                    var seleccionado = null;

                    $(document).ready(function() {
                        $('#sidebarCollapse').on('click', function() {
                            $('#sidebar').toggleClass('active');
                            $(this).toggleClass('active');
                        });
                    });

                    // When the user clicks the button, open the modal 
                    function abrirModal(evt, modal, id) {
                        var i, modals;

                        seleccionado = id;

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
                </script>
    </body>

</html>