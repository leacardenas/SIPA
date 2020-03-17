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
    <h1 id="editarEncargado" class="tituloModal">Editar encargado de activo</h1>
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

    <form method="POST" action="{{ url('/editaResp') }}">
        @csrf
         <div class="form-group">
            <label for="nombreActivo" id="labelNombreActivo">Seleccione el activo que desea editar</label>
            <select class="form-control" onchange="verficarActv(this,document.getElementById('editarEncarg'));" id="selectActivoEncargado" placeholder="Seleccione activo..." name="selectActivoEncargado" required>
                <option disabled selected value>Seleccione una opción</option>
                @foreach($activos as $activo)
                <option value="{{$activo->sipa_activos_codigo}}"> {{$activo->sipa_activos_codigo}} </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="nombreActivo" id="labelNombreActivo">Nombre del activo</label>
            <input class="form-control" id="nombreActivo2" type="text" name="nombreActivo2" placeholder="Nombre del activo" readonly>
        </div>

        <div class="form-group">
            <label for="nombreEncargado" id="labelNombreEncargado">Nuevo funcionario encargado</label>
            <select class="form-control" onchange="verificarEncargado(this,document.getElementById('labelNombreEncargado'));" id="nombreEncargado" placeholder="Seleccione funcionario..." name="nombreEncargado" required>
                <option disabled selected value>Seleccione una opción</option>
                @foreach($usuarios as $usuario)
                <option value="{{$usuario->sipa_usuarios_identificacion}}">
                    {{$usuario->sipa_usuarios_identificacion}} - {{$usuario->sipa_usuarios_nombre}}
                </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="encargadoNombre" id="labelNomEncargadoAct">Nombre del Responsable</label>
            <input class="form-control" id="nomEncargadoAct" type="text" name="nomEncargadoAct" placeholder="Responsable del activo" readonly>
        </div>

        <div class="form-group">
            <label for="labelComprobante" id="labelComprobante">Agregue comprobante de cambio de encargado</label>
            <input class="form-control" id="boletaImagenEnc" type="file" name="boletaImagenEnc" required>
            <small class="form-text text-muted" for="labelComprobanteAdv" id="labelComprobanteAdv">El archivo debe estar en formato pdf y sin espacio en el nombre</small>
        </div>

        <button type="submit" class="btn btn-primary" id="encargadoBoton"> Guardar </button>
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

function verificarEncargado(elemento, elemento2) {
    var url = "verificar/" + elemento.value;
    console.log(elemento.value);
    fetch(url).then(r => {
        console.log(r);
        return r.json();
    }).then(d => {
        var obj = JSON.stringify(d);
        var obj2 = JSON.parse(obj);
        console.log(obj2);
        if (elemento2.id == 'labelNombreEncargado') {
            var encargado = document.getElementById('nomEncargadoAct');
            encargado.value = obj2.nombreUsuario;
        } else if (elemento2.id == 'labeltrasladoFun') {
            var encargado = document.getElementById('nomEncargadoAct2');
            encargado.value = obj2.nombreUsuario;
        }else if(elemento2.id == 'labelencargadoTrasMasiv'){
            var encargado = document.getElementById('encargadoTrasMasiv');
            encargado.value = obj2.nombreUsuario;
        }

    });
}

</script>

@endsection