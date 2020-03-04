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
            <nav class="navbar">
                <img src="imagenes/logo_vicerrectoria_blanco_transparente.png" id="logo_vicerrectoria_navbar">
                <p class="user_rol">{{$user->rol->sipa_roles_nombre}}</p>
                <p class="user_name">{{$user->sipa_usuarios_nombre}}</p>
                <img src="imagenes/iconoUsuario.png" id="user_icon">
                <button id="logout" onClick='window.location.href="/" '>Cerrar Sesión</button>
            </nav>

        <section class="page_path">

        </section>
        <aside class="shortcuts">
            <h3 id="shortcuts_h3">Accesos rápidos</h3>
            <ul class="shortcuts_links">
                <li class="shortcut_group">
                   
                @foreach($permisos as $permiso)
                @if($permiso->modulo->sipa_opciones_menu_codigo == 'RESERVAR')
                    <a href="#reservar"><b>Reservar &#187</b></a>
                    <ul id="reservar">
                        <li><a class="shortcut_link" href="/reservasEquipos">Activo</a></li>
                        <li><a class="shortcut_link" href="/reservasSalas">Sala</a></li>
                    </ul>
                </li>
                @endif

                @if($permiso->modulo->sipa_opciones_menu_codigo == 'INV')
                <li class="shortcut_group">
                    <a href="#inventario"><b>Inventario &#187</b></a>
                    <ul id="inventario">
                        <li><a class="shortcut_link" href="/inventarioEquipos">Activos</a></li>
                        <li><a class="shortcut_link" href="#">Salas</a></li>
                        <li><a class="shortcut_link" href="#">Insumos</a></li>
                    </ul>
                </li>
                @endif

                @if($permiso->modulo->sipa_opciones_menu_codigo == 'CONFIG')
                <li class="shortcut_group">
                    <a href="#configuraciones"><b>Configuraciones &#187</b></a>
                    <ul id="configuraciones">
                        <li><a class="shortcut_link" href="/configuracionesRoles">Roles</a></li>
                        <li><a class="shortcut_link" href="/configuracionesUsuarios">Usuarios</a></li>
                        <li><a class="shortcut_link" href="#">Tipos de usuarios</a></li>
                        <li><a class="shortcut_link" href="#">Cuerpo de correos</a></li>
                    </ul>
                </li>
                @endif

                <li class="shortcut_group">
                    <a href="#enUso"><b>Inventario en uso &#187</b></a>
                    <ul id="enUso">
                        <li><a class="shortcut_link" href="#">Equipos</a></li>
                        <li><a class="shortcut_link" href="#">Salas</a></li>
                        <li><a class="shortcut_link" href="#">Formularios</a></li>
                    </ul>
                </li>

                <li class="shortcut_group">
                    <a href="#historial"><b>Historial &#187</b></a>
                    <ul id="historial">
                        <li>
                            <a href="#historialSalas"><b>Salas &#187</b></a>
                            <ul id="historialSalas">
                                <li><a class="shortcut_link" href="#">Reservas anticipadas</a></li>
                                <li><a class="shortcut_link" href="#">Reservas rápidas</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#historialEquipos"><b>Equipos &#187</b></a>
                            <ul id="historialEquipos">
                                <li><a class="shortcut_link" href="#">Reservas anticipadas</a></li>
                                <li><a class="shortcut_link" href="#">Reservas rápidas</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <li class="shortcut_group">
                    <a href="#entregas"><b>Entregas &#187</b></a>
                    <ul id="entregas">
                        <li><a class="shortcut_link" href="#">Equipos</a></li>
                        <li><a class="shortcut_link" href="#">Salas</a></li>
                    </ul>
                </li>

                <li class="shortcut_group">
                    <a href="#devoluciones"><b>Devoluciones &#187</b></a>
                    <ul id="devoluciones">
                        <li><a class="shortcut_link" href="#">Equipos</a></li>
                        <li><a class="shortcut_link" href="#">Salas</a></li>
                    </ul>
                </li>
                @endforeach
            </ul>
        </aside>

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