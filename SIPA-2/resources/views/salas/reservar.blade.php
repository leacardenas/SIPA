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

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="sweetalert2.all.min.js"></script>
    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">
    <!-- Include the Borderless theme -->
    <link rel="stylesheet" href="@sweetalert2/theme-borderless/borderless.css">
    <script src="sweetalert2/dist/sweetalert2.min.js"></script>

    <title>Reservar Sala</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Mukta|Sanchez|Vidaloka&display=swap" rel="stylesheet">

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body id="cuerpoInicio">
    @php
    $cedula = session('idUsuario');
    // $cedula = '207630059';
    $permisos = App\User::where('sipa_usuarios_identificacion',$cedula)->get()[0]->rol->permisos;
    $user = App\User::where('sipa_usuarios_identificacion',$cedula)->get()[0];
    $SalasLista = App\Salas::all();
    // dd( json_encode($SalasLista,JSON_PARTIAL_OUTPUT_ON_ERROR ));
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
            <form method="get" action="{{url('/reservas')}}">
            <button type="submit" type="button" class="btn btn-secondary volver">
                <span class="fa fa-chevron-left"></span> Volver
            </button>
            </form>
        </div>

        <div class="row col-sm-12">
            <div class="col-sm-9 justify-content-centered">
                <div id="calendar" class="col-centered"></div>
            </div>

            <div class="col-sm-3 sideReservar">
                <div class="row mt-5">
                    <legend class="legendReserva">Reservar Sala</legend>
                    <div class="row col-sm-12">
                        <label>Seleccione la sala que desea reservar</label>
                        <select id="selectSalaReserva" class="form-control" onchange="actializarFormSalas();">
                            {{-- @foreach ($SalasLista as $sala) --}}
                            <option >Debe seleccionar un rango de fecha y hora</option>
                            {{-- @endforeach --}}
                        </select>
                    </div>
                </div>

                <!-- INFORMACION HIDDEN -->
                <p id="fip" hidden></p>
                <p id="ffp" hidden></p>
                <p id="hip" hidden></p>
                <p id="hfp" hidden></p>
                <p id="idSalap" hidden></p>
                <p id="cantp" hidden></p>
                <!-- ****************** -->
                
                <div class="row mt-5">
                    <legend class="legendSala">Información de la sala seleccionada</legend>
                    <div class="row col-sm-12">
                        <label>Ubicación</label>
                        <input class="form-control " id="ubicacionSala" type="text" value="" disabled>
                    </div>

                    <div class="row col-sm-12 mt-2">
                        <label>Información</label>
                        <textarea class="form-control " rows="3" id="descripcionSala" type="text" disabled></textarea>
                    </div>

                    <div class="row col-sm-12 mt-2">
                        <label>Capacidad de la sala</label>
                        <input class="form-control " id="capacidadSala" type="text" disabled>
                    </div>
                </div>

                <div class="row mt-4 justify-content-center">
                    <button type="submit" class="btn boton-reservar" id="registrarActivoBoton" onclick="reservarSala();">
                        Reservar
                    </button>
                </div>

            </div>

                <!-- Modal -->
                <div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Seleccionar Hora y Fecha</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                    <!-- <div class="form-group row">
                                        <label for="start" class="col-sm-3 control-label"><b>Sala a reservar</b></label>
                                        <div class="col-sm-8">
                                            <input type="text" name="activo" class="form-control" id="activoReservar"
                                                readonly>
                                        </div>
                                    </div> -->
                        
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
                                                <input type='text' class="form-control datetimepicker-input" data-target='#fecha_final' id="fechaFinal" name = "FF"/>
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
                                        <input type="number" class="form-control col-sm-7" id="semanal" disabled>
                                        <span> &nbsp; &nbsp; </span>
                                        <label>semanas</label>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" value="meses-box" name="bla2" id="reservaMensual">
                                        <label class="form-check-label" for="reservaMensual">Repetir reserva todos los meses, cada</label>
                                        <div class="input-group">
                                        <input type="number" class="form-control col-sm-7" id="mensual" disabled>
                                        <span> &nbsp; &nbsp;</span>
                                        <label>meses</label>
                                        </div>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button id = "botonCerrarModal" type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                <button onclick="seleccionarFechas();" class="btn btn-primary" data-dismiss="modal">Guardar</button>
                            </div>
                       
                    </div>
                    </div>
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
        function reservarSala(){
            var fi = document.getElementById("fip").innerHTML;
            var ff = document.getElementById("ffp").innerHTML;
            var hi = document.getElementById("hip").innerHTML;
            var hf = document.getElementById("hfp").innerHTML;
            var cant = document.getElementById("cantp").innerHTML;
            var idSalap = document.getElementById("idSalap").innerHTML;
            var url = "reservarSalas/"+fi+"/"+ff+"/"+hi+"/"+hf+"/"+cant+"/"+idSalap;
            console.log(url);
            fetch(url).then(r => {
                    return r.json();
                }).then(d => {
                    var obj = JSON.stringify(d);
                    var obj2 = JSON.parse(obj);
                    console.log(obj2);
                    Swal.fire({
                        icon: 'success',
                        title: '¡Reservada realizada con éxito!',
                        timer: 6000,
                        showConfirmButton: false,
                        showCloseButton: true,
                        });

                    window.location.href = "/reservas";
                }); 

        }
        function actializarFormSalas(){

            var salas = JSON.parse(localStorage.getItem("salas"));
           
            var selecSalas = document.getElementById("selectSalaReserva");
            var selected = selecSalas.options[selecSalas.selectedIndex].value;

            var ubicacionSala = document.getElementById("ubicacionSala");
            var descripcionSala = document.getElementById("descripcionSala");
            var capacidadSala = document.getElementById("capacidadSala");

           
            console.log(salas);
            for(var i = 0; i < salas.length; i++){
                console.log(selected + " comparado con: "+salas[i].sipa_salas_codigo);
                if(salas[i].sipa_salas_codigo === selected){
                    ubicacionSala.value = salas[i].sipa_sala_ubicacion;
                    descripcionSala.innerHTML = salas[i].sipa_sala_informacion;
                    capacidadSala.value = salas[i].sipa_sala_capacidad + " personas";
                    document.getElementById("idSalap").innerHTML= salas[i].sipa_salas_id;
                    break;
                }
                
            }
        }
        function actualizarCbbxSalas(obj2){
            // sipa_salas_codigo 
            var ubicacionSala = document.getElementById("ubicacionSala");
            var descripcionSala = document.getElementById("descripcionSala");
            var capacidadSala = document.getElementById("capacidadSala");
            
            
            
             var selecSalas = document.getElementById("selectSalaReserva");
             selecSalas.remove(0);
            for(var i = 0; i < obj2.length; i++){
                var option = document.createElement('option');
                option.innerHTML = obj2[i].sipa_salas_codigo;
                selecSalas.appendChild(option);
            }
            ubicacionSala.value = obj2[0].sipa_sala_ubicacion;
            descripcionSala.innerHTML = obj2[0].sipa_sala_informacion;
            capacidadSala.value = 'agregarlo en la base de datos';
            document.getElementById("idSalap").innerHTML= obj2[0].sipa_salas_id;
            
            localStorage.clear();
            localStorage.setItem("salas",JSON.stringify(obj2));
        }
        function seleccionarFechas(){
           
            var fi = document.getElementById('fechaInicial').value;
            var hi = document.getElementById('hora_inicial').value;
            var ff = document.getElementById('fechaFinal').value;
            var hf = document.getElementById('hora_final').value;
           var cantSemanas = document.getElementById('semanal').value;
           var cantMeses = document.getElementById('mensual').value;
           var cant;
           if(cantSemanas == ""){
                cant = cantMeses *4;
           }else if(cantMeses == ""){
                cant = cantSemanas;
           }else {
                cant = 0 ;
           }
          
            var resp = validateForm(fi,hi,ff,hf);
            if(resp === 1){
                swal("Error", "Todos los campos deben estar llenos.", "error");
            }else if(resp === 2){
                swal("Error", "La fecha final es menor a la inicial.", "error");
            }else if (resp === 3){
                swal("Error", "La Hora final es menor a la inicial.", "error");
            }else{
           
                var url = "filtrarSalas/"+fi+"/"+ff+"/"+hi+"/"+hf+"/"+cant;
                console.log('url: '+url);
                fetch(url).then(r => {
                    return r.json();
                }).then(d => {
                    var obj = JSON.stringify(d);
                    var obj2 = JSON.parse(obj);
                    console.log(obj2);
                    actualizarCbbxSalas(obj2);
                    
                    document.getElementById("fip").innerHTML=fi;
                    document.getElementById("ffp").innerHTML=ff;
                    document.getElementById("hip").innerHTML=hi;
                    document.getElementById("hfp").innerHTML=hf;
                    document.getElementById("cantp").innerHTML=cant;
                    document.getElementById("botonCerrarModal").click();
                });   
	        }
        }
        function validateForm(fi,hi,ff,hf){

            console.log(fi+hi+ff+hf);
            if(fi === '' ||hi === '' ||ff === '' ||hf === ''  ){
                return 1;
            }

            var iMonth=fi.substring(3, 5);  
            var iDay=fi.substring(0, 2);  
            var iYear=fi.substring(6,10); 
            var ihora = hi.substring(0, 2); 
            var iminutos= hi.substring(3, 5); 

            var fMonth=ff.substring(3, 5);  
            var fDay=ff.substring(0, 2);  
            var fYear=ff.substring(6,10);  
            var fhora = hf.substring(0, 2); 
            var fminutos= hf.substring(3, 5); 

            var f1 = new Date(iYear, iMonth, iDay); 
            var f2 = new Date(fYear, fMonth, fDay);

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
            //a este punto ya todo esta validado, aca se agrega la validacion de tiempo minimo de reserva

            return 0;
                   
        }



        var informacionReserva;

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