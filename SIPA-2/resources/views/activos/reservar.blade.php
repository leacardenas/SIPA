@extends('plantillas.inicio')

@section('content')
@php
$cedula = session('idUsuario');
$user = App\User::where('sipa_usuarios_identificacion',$cedula)->get()[0];
$modulo = App\Modulo::where('sipa_opciones_menu_codigo',"INV_EQUIPO")->get()[0];
$permiso = App\Permiso::where('sipa_permisos_roles_role', $user->rol->sipa_roles_id)->where('sipa_permisos_roles_opciones_menu', $modulo->sipa_opciones_menu_id)->get()[0];
@endphp


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
@endsection