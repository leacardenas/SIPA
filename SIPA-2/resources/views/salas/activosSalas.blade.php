@extends('plantillas.inicio')
@section('content')

<div class="row col-sm-12">
    <form method="get" action="{{url('/configuraciones')}}">
    <button type="submit" type="button" class="btn btn-secondary volver">
        <span class="glyphicon glyphicon-chevron-left"></span> Volver
    </button>
    </form>
</div>

<div class="row justify-content-center col-sm-12">
    <h1 id="editarEstado" class="tituloModal">Asignar activos a salas</h1>
</div>

<div class="row col-sm-12 justify-content-center">
 @php
 $salas = App\Salas::all();
 $activos = App\Activo::all();
 @endphp

    <form class="configForm">
    @csrf
        <div class="form-group selectSala"  required>
            <h4>Seleccione la sala</h4>
            <select class="selectpicker form-control" data-live-search="true" id="selectSalas" required>
                <option disabled selected value>Seleccione la sala</option>
                @foreach($salas as $sala)
                <option value="{{$sala->sipa_salas_codigo}}" >Sala #{{$sala->sipa_salas_codigo}}</option>
                @endforeach
            </select>
        </div>
    </form>
</div>

<div class="row col-sm-12 ml-1 mt-5">
    <legend>Asigne los activos a la sala</legend>
</div>

<div class="row col-sm-12 pl-5 pr-5">
    <div class="col-sm-6 table-responsive-sm justify-content-center text-center">
        <h3>Activos disponibles</h3>
        <div class="input-group-prepend">
            <span class="input-group-text">
                <svg class="bi bi-search" width="1em" height="1em" viewBox="0 0 16 16" fill="#00000" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 011.415 0l3.85 3.85a1 1 0 01-1.414 1.415l-3.85-3.85a1 1 0 010-1.415z" clip-rule="evenodd"/>
                    <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 100-11 5.5 5.5 0 000 11zM13 6.5a6.5 6.5 0 11-13 0 6.5 6.5 0 0113 0z" clip-rule="evenodd"/>
                </svg>
            </span>
            <input class="form-control" id="activosDisponibles" type="text" placeholder="Ingrese información del activo para buscar">
        </div>
        <br>

        @php
            $activosDisponibles = App\Activo::where('sipa_activos_disponible', 1)->count();
        @endphp
        @if($activosDisponibles > 0)
        <table class="table table-bordered table-striped" id="table-usuarios">
            <thead>
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Estado</th>
                <th>Acción</th>
            </tr>
            </thead>
            
             <!-- HACER UNA CONDICION DE QUE SI NO HAY ACTIVOS DISPONIBLES, QUE SALGA UN MENSAJE -->
                <tbody id="tablaDisponibles">
                    @foreach($activos as $activo)
                        @if ($activo->sipa_activos_disponible == 1)
                        <tr>
                            <td class="first">{{$activo->sipa_activos_codigo}}</td>
                            <td>{{$activo->sipa_activos_nombre}}</td>
                            <td>{{$activo->sipa_activos_estado}}</td>
                            <td>
                                <button class="btn agregar"><span class="glyphicon glyphicon-plus"></span></button>
                            </td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            @else
                <div class="alerta mb-5">
                     <i class="fas fa-exclamation-triangle"></i> No hay activos disponibles en el sistema
                </div>
            @endif
         </table>
    </div>
    <div class="col-sm-6 table-responsive-sm justify-content-center text-center">
         <h3>Activos en la sala</h3>
         <div class="input-group-prepend">
            <span class="input-group-text">
                <svg class="bi bi-search" width="1em" height="1em" viewBox="0 0 16 16" fill="#00000" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 011.415 0l3.85 3.85a1 1 0 01-1.414 1.415l-3.85-3.85a1 1 0 010-1.415z" clip-rule="evenodd"/>
                    <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 100-11 5.5 5.5 0 000 11zM13 6.5a6.5 6.5 0 11-13 0 6.5 6.5 0 0113 0z" clip-rule="evenodd"/>
                </svg>
            </span>
            <input class="form-control" id="activosSala" type="text" placeholder="Ingrese información del activo para buscar">
        </div>
        <br>
        
         <table class="table table-bordered table-striped" id="table-usuarios">
            <thead>
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Estado</th>
                <th>Acción</th>
            </tr>
            </thead>
            <!-- LLENAR ESTA TABLA CON LOS ACTIVOS QUE PERTENECEN A LA TABLA, ESTO SE LLENA CUANDO EL USUARIO SELECCIONA LA TABLA EN EL SELECT -->
            <tbody id="tablaSala">
                
            </tbody>
         </table>
    </div>
</div>

<!-- PARA QUE ESTE BOTON HAGA SUBMIT, EL METODO ESTA ABAJO. NO LO METAN EN EL FORM -->
<div class="row col-sm-12 justify-content-center mt-5">
    <button type="button" class="btn boton-guardar" name ="guardar" id="guardar">Guardar</button>
</div>

<script>
var arrayActivosCod = [];

$('.boton-guardar').on('click', function(){
    $('.configForm').submit();
});

$(document).ready(function(){
    var rows = $('#tablaSala tr').length;
    if(rows == 0){
        console.log(rows);
        $('#tablaSala').append('<tr><td>No ha seleccionado ningún activo</td><td></td><td></td><td></td></tr>');
    }
});

$(document).ready(function(){

    //tabla de activos disponibles
  $("#activosDisponibles").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#tablaDisponibles tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });

  //tabla de activos en la sala
  $("#activosSala").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#tablaSala tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});

//pasar row de tabla a tabla
$(document).ready(function(){

    $("body").on("click", ".agregar", function(event){
        event.preventDefault();

        var row = $(this).closest('tr');
        var id = row.find(".first").text();
        arrayActivosCod[arrayActivosCod.length] = id;
        // console.log(arrayActivosCod);
        var button = row.find('.btn');
        button.removeClass('agregar').addClass('borrar');
        button.find('.glyphicon').removeClass('glyphicon-plus').addClass('glyphicon-trash');

        $('#tablaSala').append(row);
    });

    $("body").on("click", ".borrar", function(event){
        event.preventDefault();

        var row = $(this).closest('tr');
        var id = row.find(".first").text();
        console.log(arrayActivosCod);
        arrayActivosCod = arrayActivosCod.filter(elements => elements !== id);
        console.log(arrayActivosCod);
        var button = row.find('.btn');
        button.removeClass('borrar').addClass('agregar');
        button.find('.glyphicon').removeClass('glyphicon-trash').addClass('glyphicon-plus');

        $('#tablaDisponibles').append(row);
    });
});



$("#guardar").on("click",function(event){
    var archJson = JSON.stringify(arrayActivosCod);
    var sala =  document.getElementById('selectSalas');
    var idSala = sala.options[sala.selectedIndex].value;
    //console.log(idSala);
    if(arrayActivosCod.length>0){
        if(idSala){
            var url = "asignaActivosSala/" + archJson + "/" + idSala;
            console.log(url);
            fetch(url).then(r => {
                return r.json();
            }).then(d => {
                var obj = JSON.stringify(d);
                var obj2 = JSON.parse(obj);
               // console.log(obj2);
               if(obj2.respuesta == "Exito"){
                    Swal.fire({
                        icon: 'success',
                        title: '¡Realizado con éxito!',
                        text: 'Se asignaron los activos correctamente',
                        timer: 6000,
                        showConfirmButton: false,
                        showCloseButton: true,
                        });

                    window.location.reload(true);
                }else{
                    Swal.fire({
                        icon: 'warning',
                        title: 'Alerta',
                        text: 'Algo salió mal, no se pudieron asignar los activos',
                        timer: 6000,
                        showConfirmButton: false,
                        showCloseButton: true,
                        });
                }
            });
        }else{
            Swal.fire({
                icon: 'warning',
                title: 'Alerta',
                text: 'No seleccionado una sala',
                timer: 6000,
                showConfirmButton: false,
                showCloseButton: true,
            });
        }
    }else{
        Swal.fire({
        icon: 'warning',
        title: 'Alerta',
        text: 'No ha enviado ningun activo',
        timer: 6000,
        showConfirmButton: false,
        showCloseButton: true,
        });
    }
        
});
</script>
@endsection