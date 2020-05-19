@extends('plantillas.navbar')
@section('content')

<div class="row col-sm-12">
    <form method="get" action="{{url('/informacionSalas')}}">
    <button type="submit" type="button" class="btn btn-secondary volver">
        <span class="fa fa-chevron-left"></span> Volver
    </button>
    </form>
</div>

<div class="row col-sm-12 justify-content-center">

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

@endsection