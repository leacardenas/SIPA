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

    <link href="fullcalendar-library\packages\core\main.css" rel="stylesheet" />
    <link href="fullcalendar-library\packages\daygrid\main.css" rel="stylesheet" />
    <link href='fullcalendar-library\packages\timegrid\main.css' rel='stylesheet' />
    <link href='fullcalendar-library\packages\list\main.css' rel='stylesheet' />
    <link href='fullcalendar-library\packages\bootstrap\main.min.css' rel='stylesheet' />
    <link href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css' rel='stylesheet' />
    <link href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css' rel='stylesheet' />

    <script src='fullcalendar-library\packages\core\main.js'></script>
    <script src='fullcalendar-library\packages\core\main.min.js'></script>
    <script src='fullcalendar-library\packages\daygrid\main.js'></script>
    <script type='text/javascript' src='fullcalendar-library\packages\moment\main.min.js'></script>
    <script type='text/javascript' src='fullcalendar-library\packages\core\locales\es.js'></script>
    <script src='fullcalendar-library\packages\interaction\main.js'></script>
    <script src='fullcalendar-library\packages\timegrid\main.js'></script>
    <script src='fullcalendar-library\packages\list\main.js'></script>
    <script src='fullcalendar-library\packages\moment\main.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.12.0/moment.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js" charset="UTF-8"></script>

    <!-- Bootstrap Date-Picker Plugin -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap- 
datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap- 
datepicker/1.4.1/css/bootstrap-datepicker3.css"/>


    <title>Reservar Activo</title>

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


            <p>Seleccione el activo que desea reservar</p>
            <select id="selectActivoReserva">
                <option value="volvo">Volvo</option>
                <option value="saab">Saab</option>
                <option value="mercedes">Mercedes</option>
                <option value="audi">Audi</option>
            </select>


            <div class="row">
                <div class="col-lg-12 text-center">
                    <div id="calendar" class="col-centered">
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form class="form-horizontal" method="POST" action="addEvent.php">

                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Hacer reserva</h4>
                                </div>
                                <div class="modal-body">

                                    <div class="form-group">
                                        <label for="title" class="col-sm-2 control-label">Activo a reservar</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="activo" class="form-control" id="activo" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="start" class="col-sm-2 control-label">Hora Inicial</label>
                                    <div class="col-sm-10">
                                        <div class="container">
                                            <div class="row">
                                                <div class='col-sm-6'>
                                                    <div class="form-group">
                                                        <div class='input-group date' id='datetimepicker2'>
                                                            <input type='text' class="form-control" />
                                                            <span class="input-group-addon">
                                                                <span class="glyphicon glyphicon-calendar"></span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="end" class="col-sm-2 control-label">Hora Final</label>
                                    <div class="col-sm-10">
                                        <input type="time" name="horaFinal" class="form-control" id="horaFinal"
                                            required>
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
    <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <!-- Bootstrap Js CDN -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
                $(this).toggleClass('active');
            });
        });

        $(function () {
            $('#datetimepicker2').datetimepicker({
                locale: 'es'
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
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
                select: function (start, end) {

                    $('#ModalAdd').modal('show');
                    $('#ModalAdd').appendTo("body")
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