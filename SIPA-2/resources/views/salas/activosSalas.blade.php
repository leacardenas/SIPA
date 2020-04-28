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
            <label>Seleccione la sala</label>
            <select class="form-control" id="selectSalas" required>
                <option disabled selected value>Seleccione la sala</option>
                @foreach($salas as $sala)
                <option value="{{$sala->sipa_salas_codigo}}">Sala #{{$sala->sipa_salas_codigo}}</option>
                @endforeach
            </select>
        </div>
    </form>
</div>

<div class="row col-sm-12 ml-4 mt-5">
    <legend>Asigne los activos a la sala</legend>
</div>

<div class="row col-sm-12 pl-5 pr-5">
    <div class="col-sm-6 table-responsive-sm justify-content-center text-center">
        <h3>Activos disponibles</h3>
        <input class="form-control mb-4" id="activosDisponibles" type="text" placeholder="Ingrese información del activo para buscar">
         <table class="table table-bordered table-striped" id="table-usuarios">
            <thead>
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Estado</th>
                <th>Acción</th>
            </tr>
            </thead>
            
             <!-- HACER UNA CONDICION DE QUE SI EL ACTIVO ESTA DISPONIBLE, SALGA EN LA TABLA -->
            
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
         </table>
    </div>
    <div class="col-sm-6 table-responsive-sm justify-content-center text-center">
         <h3>Activos en la sala</h3>
         <input class="form-control mb-4" id="activosSala" type="text" placeholder="Ingrese información del activo para buscar">
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