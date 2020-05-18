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
    <h1 id="editarEncargado" class="tituloModal">Configurar Cuerpo de Correos</h1>
</div>

<div class="row col-sm-12 justify-content-center configActivo">
    <div class="row col-sm-12">
        <label for="nombreActivo" id="labelNombreActivo">Seleccione el nombre del cuerpo de correo</label>
        <select class="form-control select2" id="selectActivoBaja" placeholder="Seleccione nombre..." name="selectActivoBaja" required>
            <option disabled selected value>Seleccione una opción</option>
            <option value="">
            </option>
        </select>
    </div>
    <div class="row col-sm-12">
        <label for="nombreActivo" id="labelNombreActivo">Ingrese el nombre del correo</label>
        <input class="form-control" id="nombre" type="text" name="nombre" required>
    </div>
    <div class="row col-sm-12 mt-4">
        <label for="nombreActivo" id="labelNombreActivo">Ingrese el asunto del correo</label>
        <input class="form-control" id="asunto" type="text" name="asunto" required>
    </div>
    <div class="row col-sm-12 mt-4">
        <div class="col-sm-8">
            <label for="nombreActivo" id="labelNombreActivo">Ingrese el cuerpo del correo</label>
            <textarea class="form-control" rows="10" cols="95" name="razonBajaActivo" placeholder="El usuario @nombreUsuario@ cédula @cedulaUsuario@ ha devuelto la sala reservada desde @fechaInicialReserva@ a las @horaInicialReserva@, hasta el día @fechaFinalReserva@ con la hora @horaFinalReserva@ la siguiente sala: @sala@" required></textarea>
        </div>
        <div class="col-sm-4">
            <label for="nombreActivo" id="labelNombreActivo">Etiquetas para el cuerpo del correo</label>
            <textarea class="form-control" rows="10" id="etiquetas"></textarea>
            <small><b>Debe</b> usar estas etiquetas para el cuerpo del correo</small>
        </div>
    </div>
    <div class="row col-sm-12 mt-5">
    <button type="submit" class="btn botonLargo" id="guardar"> Guardar </button>
    </div>
</div>


<script>
$("#etiquetas").on("keydown",function(){
    event.preventDefault();
});

$("#etiquetas").val("@nombreUsuario@ @cedulaUsuario@ @fechaInicialReserva@ @horaInicialReserva@ @fechaFinalReserva@ @horaFinalReserva@ @sala@");

$(document).ready(function() {
    $('.select2').select2();
});
</script>
@endsection