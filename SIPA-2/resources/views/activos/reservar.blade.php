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
       <nav class="navbar">
                <img src="imagenes/logo_vicerrectoria_blanco_transparente.png" id="logo_vicerrectoria_navbar">
                <p class="user_rol">{{$user->rol->sipa_roles_nombre}}</p>
                <p class="user_name">{{$user->sipa_usuarios_nombre}}</p>
                <div class="logout_dropdown">
                    <button class="user_icon"><img src="imagenes/iconoUsuario.png"></button>
                    <div class="user_dropdown">
                        <a href=" '/' ">Cerrar Sesión</a>
                    </div>
                </div>
            </nav>

            <form method="get" action="{{url('/reservas')}}">
                <button type="submit" type="button" class="btn btn-secondary">
                    <span class="glyphicon glyphicon-circle-arrow-left"></span> Volver
                </button>
            </form>

            <h3 id="h3ActivoReserva">Seleccione el activo que desea reservar</h3>
            <select id="selectActivoReserva">
                @foreach($activos as $activo)
                <option value="{{$activo->sipa_activos_nombre}}">{{$activo->sipa_activos_nombre}}</option>
                @endforeach
            </select>


            <div id="calendar" class="col-centered">

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
                                            <input type="text" name="activo" class="form-control" id="activoReservar"
                                                readonly>
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

      <!-- Footer -->
      <footer id="footerReserva">
        <div class="contenedorFooter">
            <span id="copyright">© 2019 Copyright:
                <a style="color:blue!important" href="https://www.una.ac.cr/" id="footerLink"> Universidad Nacional de Costa Rica</a>
            </span>
        </div>
    </footer>
    
    <!-- jQuery CDN -->
    <!-- Bootstrap Js CDN -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script>
        var informacionReserva;


        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
                $(this).toggleClass('active');
            });
        });

        $(function () {
            $('#inicial').datetimepicker({
                useCurrent: false,
                format: 'DD-MM-YYYY hh:mm'
            });
        });

        $(function () {
            $('#final').datetimepicker({
                useCurrent: false,
                format: 'DD-MM-YYYY hh:mm'
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
                select: function (info) {

                    $('#ModalAdd').modal('show');
                    $('#ModalAdd').appendTo("body");
                    $('#activoReservar').val($('#selectActivoReserva option:selected').text());
                    $('#fechaInicial').val(info.startStr);
                    $('#fechaFinal').val(info.endStr);
                },
                dateClick: function (info) {
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