<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="{{ asset('sass/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- DateTimePicker -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js">
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

    <title>Reservar Activo</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Mukta|Sanchez|Vidaloka&display=swap" rel="stylesheet">

</head>

<body id="cuerpoInicio">
    @php
    $cedula = session('idUsuario');
    $permisos = App\User::where('sipa_usuarios_identificacion',$cedula)->get()[0]->rol->permisos;
    $user = App\User::where('sipa_usuarios_identificacion',$cedula)->get()[0];
    @endphp


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



            <h3 id="h3ActivoReserva">Seleccione el activo que desea reservar</h3>
            <select id="selectActivoReserva">
                <option value="volvo">Volvo</option>
                <option value="saab">Saab</option>
                <option value="mercedes">Mercedes</option>
                <option value="audi">Audi</option>
            </select>


            <div id="calendar" class="col-centered">

                <!-- Modal -->
                <div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form class="form-horizontal" method="POST" action="addEvent.php">

                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Hacer reserva</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="title" class="col-sm-2 control-label">Activo a reservar</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="activo" class="form-control" id="activoReservar" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="start" class="col-sm-2 control-label">Fecha Inicial</label>
                                    <div class="col-sm-10">
                                        <div class="row">
                                            <div class='col-sm-6'>
                                                <div class='input-group date' id='inicial'>
                                                    <input type='text' class="form-control" id="fechaInicial" />
                                                    <span class="input-group-addon">
                                                        <span class="glyphicon glyphicon-calendar"></span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="end" class="col-sm-2 control-label">Fecha Final</label>
                                    <div class="col-sm-10">
                                        <div class="row">
                                            <div class='col-sm-6'>
                                                <div class='input-group date' id='final'>
                                                    <input type='text' class="form-control" id="fechaFinal" />
                                                    <span class="input-group-addon">
                                                        <span class="glyphicon glyphicon-calendar"></span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <!-- jQuery CDN -->
    <!-- Bootstrap Js CDN -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script>
        var informacionReserva;


        $(document).ready(function() {
            $('#sidebarCollapse').on('click', function() {
                $('#sidebar').toggleClass('active');
                $(this).toggleClass('active');
            });
        });

        $(function() {
            $('#inicial').datetimepicker({
                useCurrent: false,
                format: 'DD-MM-YYYY hh:mm'
            });
        });

        $(function() {
            $('#final').datetimepicker({
                useCurrent: false,
                format: 'DD-MM-YYYY hh:mm'
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: ['interaction', 'dayGrid', 'timeGrid', 'list'],
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                },
                views: {
                    listWeek: {
                        buttonText: 'Lista de semana'
                    }
                },
                select: function(info) {

                    $('#ModalAdd').modal('show');
                    $('#ModalAdd').appendTo("body");
                    $('#activoReservar').val($('#selectActivoReserva option:selected').text());
                    $('#fechaInicial').val(info.startStr);
                    $('#fechaFinal').val(info.endStr);
                },
                dateClick: function(info) {
                    $('#ModalAdd').modal('show');
                    $('#ModalAdd').appendTo("body");
                    $('#activoReservar').val($('#selectActivoReserva option:selected').text());
                    $('#fechaInicial').val(info.dateStr);
                    $('#fechaFinal').val(info.dateStr);
                },
                locale: 'es',
                selectable: true,
                selectMirror: true,

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
    </script>

</body>

</html>