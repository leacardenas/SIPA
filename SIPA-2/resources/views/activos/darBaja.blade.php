@extends('plantillas.inicio')

@section('content')
<div class="row col-sm-12">
    <form method="get" action="{{url('/configuracionesActivos')}}">
        <button type="submit" type="button" class="btn btn-secondary volver">
            <span class="glyphicon glyphicon-chevron-left"></span> Volver
        </button>
    </form>
</div>

<div class="row justify-content-center col-sm-12">
    <h1 id="darBaja" class="tituloModal">Dar de baja un activo</h1>
</div>

<div class="row justify-content-center col-sm-12 configActivo">
    @php
    $usuarios = App\User::all();
    $activos = App\Activo::where('sipa_activo_activo',1)->get();
    // $edificios = App\Edifico::all();
    // $seleccionado = $edificios->get(0);
    // $unidades = App\Unidad::where('sipa_edificios_unidades_edificio',$seleccionado->id);
    $estados = App\EstadoActivo::all();
    @endphp

    <form id="darDeBaja" method="POST" action="{{ url('/darBaja') }}" enctype="multipart/form-data" class="col-sm-12">
    @csrf
        <div class="form-group">
            <label for="nombreActivo" id="labelNombreActivoBaja">Seleccione los activos que desea dar de baja</label>
            <select class="form-control select2" id="selectActivoBaja" placeholder="Seleccione activo..." name="selectActivoBaja">
                <option disabled selected value>Seleccione una opción</option>
                @foreach($activos as $activo)
                <option value="{{$activo->sipa_activos_id}}">{{$activo->sipa_activos_codigo}} - {{$activo->sipa_activos_nombre}}
                </option>
                @endforeach
            </select>

            <button class="btn boton mt-3" id="agregar"><i class="glyphicon glyphicon-plus"></i> Agregar</button>
        </div>

        <div id="listaActivos" name = "listaActivos" class="form-group">
            <ul id="activosSeleccionados" name="activosSeleccionados">
            </ul>
        </div>

        <div class="form-group">
            <label for="nombreResponsable" id="labelNombreResponsable">Estado de los activos</label><br>
            <select class="form-control select2" id="estadoActivoBaja" name="estadoActivoBaja" required>
                <option disabled selected value>Seleccione un estado</option>
                @foreach($estados as $estado)
                <option value="{{$estado->sipa_estado_activo_nombre}}">{{$estado->sipa_estado_activo_nombre}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="razonBajaActivo" id="labelRazonBajaActivo">Razón por la que se dan de baja los activos</label>
            <textarea class="form-control" rows="10" cols="95" name="razonBajaActivo" placeholder="Ingrese la razón por la que da de baja estos activos" required></textarea>
        </div>

        <div class="form-group">
            <label>Número de boleta</label>
            <input class="form-control" type="text" placeholder="Número de boleta" required>
        </div>

        <div class="form-group">
            <label for="boleta" id="labelBoleta">Seleccione la boleta</label>
            <input class="form-control" id="boletaImagen" type="file" name="boletaImagen" required>
            <small class="form-text text-muted">Debe seleccionar un archivo .pdf</small>
        </div>

        <button type="submit" class="btn botonLargo" id="darBaja"> Dar de baja </button>
        <!-- <br>
        <br>
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    ¡Activo dado de baja con éxito!
        </div> -->
    </form>

</div>

<script>

var arrayActivos = [];

$("#activosSeleccionados").on("click", "span", function(event) {
    $(this).parent().fadeOut(500, function() {
        $(this).remove();
    });
    event.stopPropagation();
});

$("#activosSeleccionados").on("click", "li", function(event) {
    var actvRemo = $(this).text();
    separador = "-";
    limite = 1;
    var nuevoActvRemo = actvRemo.split(separador, limite);
    arrayActivos = arrayActivos.filter(elements => elements !== nuevoActvRemo[0]);
    $(this).fadeOut(500, function() {
        $(this).remove();
    });
    event.stopPropagation();
});

$("#agregar").on("click", function(event) {
    event.preventDefault();

    let seleccionado = $("#selectActivoBaja option:selected").text();

    $("#activosSeleccionados li").each((id, elem) => {
        console.log(seleccionado);
        console.log(elem.innerText);

        if(elem.innerText.trim() == seleccionado){
            Swal.fire({
            icon: 'error',
            title: '¡Error!',
            text: 'Ese activo ya fue seleccionado',
            timer: 6000,
            showConfirmButton: false,
            showCloseButton: true,
            });
        }
    });

    if(seleccionado === "Seleccione una opción"){
         Swal.fire({
            icon: 'error',
            title: '¡Error!',
            text: 'Debe seleccionar un activo',
            timer: 6000,
            showConfirmButton: false,
            showCloseButton: true,
            });
    }
    else{
        if(arrayActivos.length < 18){
        let activo = $('#selectActivoBaja').find("option:selected").text();
        let select = document.getElementById('selectActivoBaja');
        let idActivo = select.options[select.selectedIndex].value;
        $("#activosSeleccionados").append(
            "<li class='activoSeleccionado' name = 'activSeleccionados'><span class='basurero'><i class='fa fa-trash'></i></span>    " +
            activo + "</li>");
           
            
            arrayActivos[arrayActivos.length] = idActivo;
            
        }else {
            Swal.fire({
            icon: 'warning',
            title: '¡Alerta!',
            text: 'No se puede realizar un traslado de más de 18 activos',
            timer: 5000,
            confirmButtonColor: '#22407E',
            showCloseButton: true,
            });
        }
    }

});

$('#darDeBaja').submit(function(){
    Swal.fire({
            icon: 'success',
            title: '¡Realizado con éxito!',
            text: 'El activo se ha dado de baja correctamente',
            timer: 6000,
            showConfirmButton: false,
            showCloseButton: true,
            });
});

$(document).ready(function() {
    $('.select2').select2();
});
</script>

@endsection