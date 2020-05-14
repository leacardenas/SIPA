<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="{{ asset('sass/app.css') }}" rel="stylesheet">

    <!-- DateTimePicker -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment-with-locales.min.js" type="text/javascript"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />


    <!-- FULLCALENDAR -->
    <link href='https://use.fontawesome.com/releases/v5.0.6/css/all.css' rel='stylesheet'>
    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' rel='stylesheet' />

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
    <script src='fullcalendar/fullcalendar.js'></script>
    <script src='fullcalendar/locale/es.js'></script>

    <title>Reservar Sala</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Mukta|Sanchez|Vidaloka&display=swap" rel="stylesheet">

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</head>

<body id="cuerpoInicio">
    @php
    // $cedula = session('idUsuario');
    $cedula = '207630059';
    $permisos = App\User::where('sipa_usuarios_identificacion',$cedula)->get()[0]->rol->permisos;
    $user = App\User::where('sipa_usuarios_identificacion',$cedula)->get()[0];
    @endphp


    <div class="container-fluid" id="cuerpoInicio">
        <header class="row navbar">
            <div class="col-sm-2" id="logo_div">  <img alt="logo" src="imagenes/logo_vicerrectoria_blanco_transparente.png" id="logo_vicerrectoria_navbar"> </div>
             <div class="col-sm-2 hamburger">  
                <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#sidebar" aria-controls="sidebar" aria-expanded="false" >
                    <span class="icon-bar top-bar"></span>
                    <span class="icon-bar middle-bar"></span>
                    <span class="icon-bar bottom-bar"></span>				
                </button>
            </div>
            <div class="col-sm-7"> <span class="user-role">{{$user->rol->sipa_roles_nombre}}</span> </div>

         <div class="col-sm-3">
            <div class="row">
                <div class="col-sm-12"><span class="navbar-user"> {{$user->sipa_usuarios_nombre}} <span> </div>
                <!-- <div class="col-sm-3"><img src="imagenes/iconoUsuario.png" id="user_icon"></div> -->
            </div>
            <div class="row"><button id="logout" onClick='window.location.href="/" '>Cerrar Sesión</button></div>
        </div>
        </header>

        <nav id="sidebar" class="col-sm-2 sidebarReservas">
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
                            <a href="/inventarioSalasBlade">Salas</a>
                        </li>
                        <li>
                            <a href="/inventarioInsumos">Insumos</a>
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

            <img alt="logo" src="public\imagenes\logo_vicerrectoria_blanco_transparente.png" id="logo_vicerrectoria_sidebar">
        </nav>

        <div class="row nav-open">

        <div class="row col-sm-12">
            <form method="get" action="{{url('/informacionSalas')}}">
            <button type="submit" type="button" class="btn btn-secondary volver">
                <span class="fa fa-chevron-left"></span> Volver
            </button>
            </form>
        </div>

            <div class="row">

            <div class="row col-sm-12 mb-5">
                <h1 id="h3ActivoReserva">Detalle de reservas de Sala <b># ...</b></h1>
            </div>

            <div class="row col-sm-12 ml-3">
                <div class="form-group">
                    <h3>Cambiar de sala </h3>
                    <select id="selectActivoReserva" class="form-control">
                        <option value="">Sala </option>
                    </select>
                </div>
            </div>

            <div id="calendar" class="col-centered">
            </div>

        </div>
    </div>
</div>
</div>

      <!-- Footer -->
      <footer id="footerReserva">
        <div class="contenedorFooter">
            <span id="copyright">© 2019 Copyright:
                <a style="color:blue!important" href="https://www.una.ac.cr/" id="footerLink"> Universidad Nacional de Costa Rica</a>
            </span>
        </div>
    </footer>

    <script>
        var informacionReserva;

        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: ['interaction', 'dayGrid', 'timeGrid', 'list', 'bootstrap'],
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                },
                defaultView: 'listWeek',
                views: {
                    listWeek: {
                        buttonText: 'Lista de semana'
                    }
                },
                select: function (info) {

                    $('#ModalAdd').modal('show');
                    $('#ModalAdd').appendTo("body");
                    $('#activoReservar').val($('#selectActivoReserva option:selected').text());
                    var startStr = dateToDMY(info.start);
                    $('#fechaInicial').val(startStr);
                    //var endDate = dateToDMY(info.end);
                    var endDate = new Date(info.end);
                    var beforeDay = new Date(endDate.getFullYear(),endDate.getMonth(), endDate.getDate() - 1); //toISOString().slice(0,10)
                    var endStr = dateToDMY(beforeDay);
                    $('#fechaFinal').val(endStr);      
                },

                locale: 'es',
                selectable: true,
                selectMirror: true,
                themeSystem: 'bootstrap',

                eventLimit: true, // allow "more" link when too many events
                events: [{
                        title: 'All Day Event', //el titulo sera> Reserva X activo
                        start: '2019-08-01'
                    },
                    {
                        title: 'Long Event',
                        start: '2019-08-07',
                        end: '2019-08-10'
                    },
                    {
                        groupId: 999,
                        title: 'Repeating Event',
                        start: '2019-08-09T16:00:00'
                    },
                    {
                        groupId: 999,
                        title: 'Repeating Event',
                        start: '2019-08-16T16:00:00'
                    },
                    {
                        title: 'Conference',
                        start: '2019-08-11',
                        end: '2019-08-13'
                    },
                    {
                        title: 'Meeting',
                        start: '2019-08-12T10:30:00',
                        end: '2019-08-12T12:30:00'
                    },
                    {
                        title: 'Lunch',
                        start: '2019-08-12T12:00:00'
                    },
                    {
                        title: 'Meeting',
                        start: '2019-08-12T14:30:00'
                    },
                    {
                        title: 'Happy Hour',
                        start: '2019-08-12T17:30:00'
                    },
                    {
                        title: 'Dinner',
                        start: '2019-08-12T20:00:00'
                    },
                    {
                        title: 'Birthday Party',
                        start: '2019-08-13T07:00:00'
                    },
                    {
                        title: 'Click for Google',
                        url: 'http://google.com/',
                        start: '2019-08-28'
                    }
                ]
            });

            calendar.render();
        });

$('#reservaForm').submit(function(){
Swal.fire({
    icon: 'success',
    title: '¡Reservada realizada con éxito!',
    timer: 6000,
    showConfirmButton: false,
    showCloseButton: true,
    });
});
        
    </script>

</body>

</html>