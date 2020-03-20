<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Styles -->
    <link href="{{ asset('sass/app.css') }}" rel="stylesheet">

    <!--FontAwsome-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Mukta|Sanchez|Vidaloka&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    

    @yield('datetime')

    <title>SIPA @yield('title')</title>
    
</head>

<body>

    @php
    $cedula = session('idUsuario');
    $permisos = App\User::where('sipa_usuarios_identificacion',$cedula)->get()[0]->rol->permisos;
    $user = App\User::where('sipa_usuarios_identificacion',$cedula)->get()[0];
    @endphp

    <div  class="container-fluid" id="cuerpoInicio">
         <header class="row navbar">
            <div class="col-sm-2">  <img alt="logo" src="imagenes/logo_vicerrectoria_blanco_transparente.png" id="logo_vicerrectoria_navbar"> </div>
            <!-- <div class="col-sm-2">  
                <button type="button" id="sidebarCollapse" class="navbar-btn">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>    
            </div> -->
            <div class="col-sm-8"> <span class="user-role">{{$user->rol->sipa_roles_nombre}}</span> </div>

         <div class="col-sm-2">
            <div class="row">
                <div class="col-sm-12"><span class="navbar-user"> {{$user->sipa_usuarios_nombre}} <span> </div>
                <!-- <div class="col-sm-3"><img src="imagenes/iconoUsuario.png" id="user_icon"></div> -->
            </div>
            <div class="row"><button id="logout" onClick='window.location.href="/" '>Cerrar Sesión</button></div>
        </div>
        </header>

        <div class="row">
        <nav id="sidebar" class="col-sm-2">
            <div class="sidebar-header">
                <h3>Accesos Directos</h3>
            </div>

             <ul class="list-unstyled components">
                <li>
                    <a href="#reservaSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Reservar</a>
                    <ul class="collapse list-unstyled" id="reservaSubmenu">
                        <li>
                            <a href="/reservasEquipos">Activo</a>
                        </li>
                        <li>
                            <a href="/reservasSalas">Sala</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="#inventarioSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Inventario</a>
                    <ul class="collapse list-unstyled" id="inventarioSubmenu">
                        <li>
                            <a href="/inventarioEquipos">Activos</a>
                        </li>
                        <li>
                            <a href="#">Salas</a>
                        </li>
                        <li>
                            <a href="#">Insumos</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="#configSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Configuraciones</a>
                    <ul class="collapse list-unstyled" id="configSubmenu">
                        <li>
                            <a href="/configuracionesRoles">Roles</a>
                        </li>
                        <li>
                            <a href="/configuracionesActivos">Activos</a>
                        </li>
                        <li>
                            <a href="/configuracionesUsuarios">Usuarios</a>
                        </li>
                        <li>
                            <a href="#">Tipos de usuarios</a>
                        </li>
                        <li>
                            <a href="#">Cuerpo de correos</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="#invUsoSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Inventario en uso</a>
                    <ul class="collapse list-unstyled" id="invUsoSubmenu">
                        <li>
                            <a href="#">Equipos</a>
                        </li>
                        <li>
                            <a href="#">Salas</a>
                        </li>
                        <li>
                            <a href="#">Formularios</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="#historialSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Historial</a>
                    <ul class="collapse list-unstyled" id="historialSubmenu">
                        <li>
                            <a href="#">Equipos</a>
                        </li>
                        <li>
                            <a href="#">Salas</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="#entregasSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Entregas</a>
                    <ul class="collapse list-unstyled" id="entregasSubmenu">
                        <li>
                            <a href="#">Equipos</a>
                        </li>
                        <li>
                            <a href="#">Salas</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="#devolucionesSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Devoluciones</a>
                    <ul class="collapse list-unstyled" id="devolucionesSubmenu">
                        <li>
                            <a href="#">Equipos</a>
                        </li>
                        <li>
                            <a href="#">Salas</a>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>

         <div class="col-sm-10">
            <div class=row>
                <section class="page_path col-sm-12">

                </section>
            </div>
            <div class="row align-items-center">
                @yield('content')
            </div>

            <footer class="row" id="footer">
            <div class="col-sm-12">
                <span id="copyright">© 2019 Copyright:
                <a style="color:blue!important" href="https://www.una.ac.cr/" id="footerLink"> Universidad Nacional de Costa Rica</a>
                </span>
            </div>
         </footer>
            
        </div>
        </div>
    </div>

    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>

    <!-- Bootstrap Js CDN -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>


    <script src="//code.jquery.com/jquery-1.12.3.js"></script>
    <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">

    <!-- <script type="text/javascript">
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

        $(document).ready(function () {
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
        });
    </script> -->

    @yield('scripts')
    
</body>

</html>