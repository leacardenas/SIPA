@extends('plantillas.inicio')
@section('content')

<div class="row col-sm-12">
    <form method="get" action="{{url('/informacionSalas')}}">
        <button type="submit" type="button" class="btn btn-secondary volver">
            <span class="glyphicon glyphicon-chevron-left"></span> Volver
        </button>
    </form>
</div>

<div class="row justify-content-center col-sm-12">
    <h1 id="editarEstado" class="tituloModal">Editar Sala</h1>
</div>

<div class="row col-sm-12 justify-content-center configActivo">
    <form method="POST" action="{{ url('/editarSala') }}" class="configForm">
    @csrf
        <div class="form-group">
            <label id="num_sala_label">Número de sala</label>
            <input name = "num_sala_input" type="text" class="form-control" id="num_sala_input" value = "{{$sala->sipa_salas_codigo}}" readonly>
        </div>

        <div class="form-group">
            <label id="ubicacion_label">Ubicación</label>
            <input name = "ubicacion_input" type="text" class="form-control" id="ubicacion_input" value ="{{$sala->sipa_sala_ubicacion}}">
        </div>

        <div class="form-group">
            <label class="editar_sala_label" id="info_label">Capacidad de la sala</label>
            <input name = "cantidad_input" type="number" class="form-control" id="cantidad_input" value = "{{$sala->sipa_sala_capacidad}}" required>
        </div>

        <div class="form-group">
            <label id="info_label">Información</label>
            <textarea name = "info_input" type="text" class="form-control" id="info_input" cols="100" value = "{{$sala->sipa_sala_informacion}}" placeholder="Ingrese información de la sala"></textarea>
        </div>

        <div class="form-group">
            <label id="foto_sala_label">Foto de la sala</label>              
            <input class="form-control" type="file" name="foto_sala" accept="image/*" onchange="cargarImagen(event)">  
        </div>

        <div class="form-group">
            <label id="vista_prev_label"><b>Vista previa</b></label>
            <br>
            <img id="img_previa">
        </div>

        <button class="btn botonLargo">Guardar</button>
    </form>

</div>

<script>
var cargarImagen = function (event) {
    var output = document.getElementById('img_previa');
    output.src = URL.createObjectURL(event.target.files[0]);
};

$('.configForm').submit(function(){
    Swal.fire({
            icon: 'success',
            title: '¡Realizado con éxito!',
            text: 'La sala se ha editado correctamente',
            timer: 6000,
            showConfirmButton: false,
            showCloseButton: true,
            });
});
</script>

@endsection