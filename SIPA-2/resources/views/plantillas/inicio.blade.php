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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Mukta|Sanchez|Vidaloka&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- DateTimePicker -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js">
    </script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css">

    <link href="fullcalendar-library\packages\core\main.css" rel="stylesheet" />
    <link href="fullcalendar-library\packages\daygrid\main.css" rel="stylesheet" />
    <link href='fullcalendar-library\packages\timegrid\main.css' rel='stylesheet' />
    <link href='fullcalendar-library\packages\list\main.css' rel='stylesheet' />
    <link href='fullcalendar-library\packages\bootstrap\main.min.css' rel='stylesheet' />

    <script src='fullcalendar-library\packages\core\main.js'></script>
    <script src='fullcalendar-library\packages\core\main.min.js'></script>
    <script src='fullcalendar-library\packages\daygrid\main.js'></script>
    <script type='text/javascript' src='fullcalendar-library\packages\moment\main.min.js'></script>
    <script type='text/javascript' src='fullcalendar-library\packages\core\locales\es.js'></script>
    <script src='fullcalendar-library\packages\interaction\main.js'></script>
    <script src='fullcalendar-library\packages\timegrid\main.js'></script>
    <script src='fullcalendar-library\packages\list\main.js'></script>
    <script src='fullcalendar-library\packages\moment\main.js'></script>
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
                            <li><a href="/reservasEquipos">Activo</a></li>
                            <!-- <li><a href="#">Sala</a></li> -->
                        </ul>
                    </li>
                    @endif

                    @if($permiso->modulo->sipa_opciones_menu_codigo == 'INV')
                    <li>
                        <a href="#inventario" data-toggle="collapse" aria-expanded="false">Inventario</a>
                        <ul class="collapse list-unstyled" id="inventario">
                            <li><a href="/inventarioEquipos">Activo</a></li>
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
                        <p id="ruta" class='navbar-text navbar-left'>{{$user->rol->sipa_roles_nombre}}</p>
                        @yield('ruta')
                        <button id="logout" onClick='window.location.href="/" ''>Cerrar sesión</button>
                        <p id="usuario">{{$user->sipa_usuarios_nombre}}</p>
                            <a class="dropbtn">
                                <img src="imagenes/iconoUsuario.png">
                            </a>
                    </div>
                </nav>

                @yield('content')

                <!-- Footer -->
                <footer id="footer">
                    <div class="contenedorFooter">
                        <span id="copyright">© 2019 Copyright:
                            <a style="color:blue!important" href="https://www.una.ac.cr/" id="footerLink"> Universidad
                                Nacional de Costa Rica</a>
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

                    $(document).ready(function () {
                        $('#sidebarCollapse').on('click', function () {
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

                    window.onclick = function (event) {
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