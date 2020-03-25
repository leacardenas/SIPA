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
    <h1 id="editarEstado" class="tituloModal">Editar estado de activo</h1>
</div>

<div class="row col-sm-12 justify-content-center configActivo">
    @php
    $usuarios = App\User::all();
    $activos = App\Activo::all();
    $edificios = App\Edifico::all();
    $seleccionado = $edificios->get(0);
    $unidades = App\Unidad::where('sipa_edificios_unidades_edificio',$seleccionado->id);
    $estados = App\EstadoActivo::all();
    @endphp

    <form id="editEstado" method="POST" action="{{ url('/editaEstado') }}" enctype="multipart/form-data">
    @csrf
        <div class="form-group">
            <label for="nombreActivo" id="labelNombreActivo">Seleccione el activo que desea editar</label>
            <select class="form-control" onchange="verficarActv(this,document.getElementById('editEstado'));" id="selectActivoEstado" placeholder="Seleccione activo..." name="selectActivoEstado" required>
                <option disabled selected value>Seleccione una opción</option>
                @foreach($activos as $activo)
                <option value="{{$activo->sipa_activos_codigo}}">{{$activo->sipa_activos_codigo}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="nombreActivo" id="labelNombreActivo">Nombre del activo</label>
            <input class="form-control" id="nombreActivo3" type="text" name="nombreActivo3" placeholder="Nombre del activo" readonly>
        </div>

        <div class="form-group">
            <label for="nombreResponsable" id="labelNombreResponsable">Estado de activo</label><br>
            <select class="form-control" id="estadoActivo" name="estadoActivo" required>
                <option disabled selected value>Seleccione un estado</option>
                @foreach($estados as $estado)
                <option value="{{$estado->sipa_estado_activo_nombre}}">{{$estado->sipa_estado_activo_nombre}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="razonCambioEst" id="labelRazonCambioEst">Razón por la que se hace un cambio de estado</label>
            <textarea class="form-control" rows="10" cols="95" name="observCambioEst" placeholder="Ingrese la razón por la que da de baja este activo" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary boton-config"> Guardar </button>
        <br>
        <br>
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    ¡Estado de activo editado con éxito!
        </div>
    </form>
</div>

<script>
function verficarActv(elemento, elemento2) {
    var url = "verificarAct/" + elemento.value;
    console.log(elemento.value);
    fetch(url).then(r => {
        return r.json();
    }).then(d => {
        var obj = JSON.stringify(d);
        var obj2 = JSON.parse(obj);
        console.log(obj2);
        if (elemento2.id == 'editarRespon') {
            var activo = document.getElementById('nombreActivo');
            activo.value = obj2.nombreActivo;
        } else if (elemento2.id == 'editarEncarg') {
            var activo = document.getElementById('nombreActivo2');
            activo.value = obj2.nombreActivo;
        } else if (elemento2.id == 'editEstado') {
            var activo = document.getElementById('nombreActivo3');
            activo.value = obj2.nombreActivo;
        } else if (elemento2.id == 'darDeBaja') {
            var activo = document.getElementById('nombreActivo4');
            activo.value = obj2.nombreActivo;
        } else if (elemento2.id == 'labelActivoUbicacion') {
            var activo = document.getElementById('activoUbicacion');
            activo.value = obj2.nombreActivo;
        }

    });
}

$(document).ready(function(){
    $('.boton-config').click(function(){
        $('.alert').show()
    }) 
});

</script>

@endsection