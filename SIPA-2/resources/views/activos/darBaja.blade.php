@extends('plantillas.inicio')

@section('content')
<div class="row">
<form method="get" action="{{url('/inventarioEquipos')}}">
        <button type="submit" type="button" class="btn btn-secondary">
            <span class="glyphicon glyphicon-circle-arrow-left"></span> Volver
        </button>
    </form>
</div>

<div class="row">
    <h1 id="darBaja" class="tituloModal">Dar de baja un activo</h1>
</div>

<div class="row">
    @php
    $usuarios = App\User::all();
    $activos = App\Activo::all();
    $edificios = App\Edifico::all();
    $seleccionado = $edificios->get(0);
    $unidades = App\Unidad::where('sipa_edificios_unidades_edificio',$seleccionado->id);
    $estados = App\EstadoActivo::all();
    @endphp

    <form id="darDeBaja" method="POST" action="{{ url('/darBaja') }}" enctype="multipart/form-data">
    @csrf
        <div class="form-group">
            <label for="nombreActivo" id="labelNombreActivo">Seleccione el activo que desea dar de baja</label>
            <select class="form-control" onchange="verficarActv(this,document.getElementById('darDeBaja'));" id="selectActivoBaja" placeholder="Seleccione activo..." name="selectActivoBaja" required>
                <option disabled selected value>Seleccione una opción</option>
                @foreach($activos as $activo)
                <option value="{{$activo->sipa_activos_codigo}}">{{$activo->sipa_activos_codigo}}
                </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="nombreActivo" id="labelNombreActivo">Nombre del activo</label>
            <input class="form-control" id="nombreActivo4" type="text" name="nombreActivo4" placeholder="Nombre del activo" readonly>
        </div>

        <div class="form-group">
            <label for="nombreResponsable" id="labelNombreResponsable">Estado de activo</label><br>
            <select class="form-control" id="estadoActivoBaja" name="estadoActivoBaja" required>
                <option disabled selected value>Seleccione un estado</option>
                @foreach($estados as $estado)
                <option value="{{$estado->sipa_estado_activo_nombre}}">{{$estado->sipa_estado_activo_nombre}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="razonBajaActivo" id="labelRazonBajaActivo">Razón por la que se da de baja el activo</label>
            <textarea class="form-control" rows="10" cols="95" name="razonBajaActivo" placeholder="Ingrese la razón por la que da de baja este activo" required></textarea>
        </div>

        <div class="form-group">
            <label for="boleta" id="labelBoleta">Seleccione la boleta</label>
            <input class="form-control" id="boletaImagen" type="file" name="boletaImagen" required>
            <small class="form-text text-muted">Debe seleccionar un archivo .pdf</small>
        </div>

        <button type="submit" class="btn btn-primary" id="darBaja"> Dar de baja </button>

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
</script>

@endsection