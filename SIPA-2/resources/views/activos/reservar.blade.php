@extends('plantillas.navbar')
@section('content')

<div class="row col-sm-12">
    <form method="get" action="{{url('/reservas')}}">
    <button type="submit" type="button" class="btn btn-secondary volver">
        <span class="fa fa-chevron-left"></span> Volver
    </button>
    </form>
</div>

<div class="row">

    <div class="row col-sm-12">
        <h1 id="h3ActivoReserva">Reservar Activo</h1>
    </div>

    <div id="calendar" class="col-centered">

        <!-- Modal -->
        <div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Hacer reserva</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <!-- <div class="form-group">
                                <label for="title" class="col-sm-2 control-label">Activo a reservar</label>
                                <div class="col-sm-10">
                                    <input type="text" name="activo" class="form-control" id="activoReservar"
                                        readonly>
                                </div>
                            </div> -->

                            <form class="form-horizontal" method="GET" action="ir_a_datatable" id="irAlDataForm">
                            <div class="form-group row">
                                <label for="start" class="col-sm-3 control-label">Fecha Inicial</label>
                                <div class="col-sm-8">
                                    <div class='input-group date' id='fecha_inicial' data-target-input="nearest">
                                        <input type='text' class="form-control datetimepicker-input" data-target='#fecha_inicial' id="fechaInicial" name = "FI"/>
                                        <div class="input-group-append" data-target="#fecha_inicial" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="start" class="col-sm-3 control-label">Hora Inicial</label>
                                <div class="col-sm-8">
                                    <div class='input-group date' id='hora_iniciall' data-target-input="nearest">
                                        <input type='text' class="form-control datetimepicker-input" data-target="#hora_inicial" id="hora_inicial"name = "HI" />
                                        <div class="input-group-append" data-target="#hora_inicial" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-clock-o"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="start" class="col-sm-3 control-label">Fecha Final</label>
                                <div class="col-sm-8">
                                    <div class='input-group date' id='fecha_final' data-target-input="nearest">
                                        <input type='text' class="form-control datetimepicker-input" data-target='#fecha_final' id="fechaFinal" name = "FF" />
                                        <div class="input-group-append" data-target="#fecha_final" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="start" class="col-sm-3 control-label">Hora Final</label>
                                <div class="col-sm-8">
                                    <div class='input-group date' id='hora_finall' data-target-input="nearest">
                                        <input type='text' class="form-control datetimepicker-input" data-target="#hora_final" id="hora_final"name = "HF" />
                                        <div class="input-group-append" data-target="#hora_final" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-clock-o"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <legend>Reserva Cíclica</legend>

                            <div class="form-check">
                                <input type="radio" class="form-check-input" value="dias-box" name="bla" id="reservaSemanal">
                                <label class="form-check-label" for="reservaSemanal">Repetir reserva todas las semanas, cada</label>
                                <div class="input-group">
                                    <input type="number" class="form-control col-sm-7" id="semanal" name="semanasInput" disabled>
                                    <span> &nbsp; &nbsp; </span>
                                    <label>semanas</label>
                                </div>
                            </div>
                            <br>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" value="meses-box" name="bla2" id="reservaMensual">
                                <label class="form-check-label" for="reservaMensual">Repetir reserva todos los meses, cada</label>
                                <div class="input-group">
                                    <input type="number" class="form-control col-sm-7" id="mensual" name="mesesInput" disabled>
                                    <span> &nbsp; &nbsp; </span>
                                    <label>meses</label>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                        <button id="botonGuardar" type="submit" class="btn btn-primary">Reservar</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $("#botonGuardar").click(function(event){
        event.preventDefault();
        var resp = validateForm();
        if(resp === 1){
            swal("Error", "Todos los campos deben estar llenos.", "error");
        }else if(resp === 2){
            swal("Error", "La fecha final es menor a la inicial.", "error");
        }else if (resp === 3){
            swal("Error", "La Hora final es menor a la inicial.", "error");
        }else if(resp === 4){
            swal("Error", "La fecha inicial es menor a la fecha actual.", "error");
        }else{
        
            $("#irAlDataForm").submit();
        }
    });
    function validateForm(){
        var fi = document.getElementById('fechaInicial').value;
        var hi = document.getElementById('hora_inicial').value;
        var ff = document.getElementById('fechaFinal').value;
        var hf = document.getElementById('hora_final').value;

        if(fi === '' ||hi === '' ||ff === '' ||hf === ''  ){
            return 1;
        }

        var iMonth=fi.substring(3, 5);  
        var iDay=fi.substring(0, 2);
        var aux = parseInt(iMonth); 
        aux = aux-1;
        iMonth = aux.toString();
        var iYear=fi.substring(6,10); 
        var ihora = hi.substring(0, 2); 
        var iminutos= hi.substring(3, 5); 

        var fMonth=ff.substring(3, 5);  
        var fDay=ff.substring(0, 2);
        aux = parseInt(fMonth); 
        aux = aux-1;
        fMonth = aux.toString();  
        var fYear=ff.substring(6,10);  
        var fhora = hf.substring(0, 2); 
        var fminutos= hf.substring(3, 5); 

        var f1 = new Date(iYear, iMonth, iDay); 
        var f2 = new Date(fYear, fMonth, fDay);
        var hoy = new Date();
   
        
        if(f1.getTime()>f2.getTime()){
                return 2;
        }
        if(f1.getTime()==f2.getTime()){
            f1.setHours(ihora,iminutos,0,0);
            f2.setHours(fhora,fminutos,0,0);
            if(f1.getTime()>f2.getTime()){
                return 3;
            }
        }
        if(f1.getTime()<hoy.getTime()){
            
            return 4;
        }
       
        //a este punto ya todo esta validado, aca se agrega la validacion de tiempo minimo de reserva

        return 0;
                
    }
    var informacionReserva;
var url = "getReservasActivos";

    $('#reservaSemanal').on('click', function(){
        $('#reservaMensual').prop('checked', false);

        $('#mensual').prop('disabled', true);
        $('#semanal').prop('disabled', false);
    });

    $('#reservaMensual').on('click', function(){
        $('#reservaSemanal').prop('checked', false);

        $('#semanal').prop('disabled', true);
        $('#mensual').prop('disabled', false);
    });

    $(function () {
        $('#fecha_inicial').datetimepicker({
            useCurrent: true,
            format: 'DD-MM-YYYY',
            locale: "es"
        });
    });

    $(function () {
        $('#hora_inicial').datetimepicker({
            useCurrent: true,
            format: 'HH:mm',
        });
    });

    $(function () {
        $('#fecha_final').datetimepicker({
            useCurrent: true,
            format: 'DD-MM-YYYY',
            locale: "es"
        });
    });

    $(function () {
        $('#hora_final').datetimepicker({
            useCurrent: true,
            format: 'HH:mm'
        });
    });

    function dateToDMY(date) {
        var d = date.getDate();
        var m = date.getMonth() + 1; //Month from 0 to 11
        var y = date.getFullYear();
        return '' + (d <= 9 ? '0' + d : d) + '-' + (m <= 9 ? '0' + m : m) + '-' + y;
    }


    document.addEventListener('DOMContentLoaded', function () {
        
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: ['interaction', 'dayGrid', 'timeGrid', 'list', 'bootstrap'],
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
                events: '/getReservasActivos'
            });

            calendar.render();
        });

</script>

@endsection