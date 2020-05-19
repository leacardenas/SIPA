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
    <h1 id="editarEstado" class="tituloModal">Editar Tipo del Activo</h1>
</div>

<div class="row col-sm-12 justify-content-center configActivo">
    @php
    $activos = App\Activo::all();
    
    @endphp

    <form id="editEstado" method="GET" action="{{ url('/editarTipo') }}" enctype="multipart/form-data" class="col-sm-12">
        @csrf
        <div class="form-group">
            <label for="nombreActivo" id="labelNombreActivo">Seleccione el activo que desea editar</label>
            <select class="form-control select2" onchange="verficarActv(this);" id="selectActivoEstado"
                placeholder="Seleccione activo..." name="selectActivoEstado" required>
                <option disabled selected value>Seleccione una opción</option>
                @foreach($activos as $activo)
                <option value="{{$activo->sipa_activos_codigo}}">{{$activo->sipa_activos_codigo}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="nombreActivo" id="labelNombreActivo">Nombre del activo</label>
            <input class="form-control" id="nombreActivo3" type="text" name="nombreActivo3"
                placeholder="Nombre del activo" readonly>
        </div>

        <div class="form-group">
            <label for="nombreResponsable" id="labelNombreResponsable">Tipo de activo</label><br>
            <select class="form-control select2" id="estadoActivo" name="estadoActivo" required>
                <option disabled selected value>Seleccione un tipo</option>
                <option value = "prestamo">Para préstamo</option>
                <option value = "asignar">Para asignar</option>
            </select>
        </div>

        <button type="submit" class="btn botonLargo"> Guardar </button>

    </form>
</div>

<script>
function verficarActv(elemento) {
    var url = "verificarAct/" + elemento.value;
    fetch(url).then(r => {
        return r.json();
    }).then(d => {
        var obj = JSON.stringify(d);
        var obj2 = JSON.parse(obj);
        var activo = document.getElementById('nombreActivo3');
        activo.value = obj2.nombreActivo;
    });
}

$('#editEstado').submit(function(){
    Swal.fire({
            icon: 'success',
            title: '¡Realizado con éxito!',
            text: 'El tipo del activo se ha editado correctamente',
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