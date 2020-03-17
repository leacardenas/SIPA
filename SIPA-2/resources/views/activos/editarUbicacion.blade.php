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
    <h1 id="editarUbicacion" class="tituloModal">Editar ubicación de activo</h1>
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

    <form id="editUbicacion" method="POST" action="{{ url('/editaUbicacion') }}">
    @csrf
        <div class="form-group">
            <label for="nombreActivo" id="labelActivoUbicacion">Seleccione el activo que desea editar</label>
            <select class="form-control" onchange="verficarActv(this,document.getElementById('labelActivoUbicacion'));" id="selectActivoUbicacion" placeholder="Seleccione activo..." name="selectActivoUbicacion" required>
                <option disabled selected value>Seleccione una opción</option>
                @foreach($activos as $activo)
                <option value="{{$activo->sipa_activos_codigo}}">{{$activo->sipa_activos_codigo}}
                </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="nombreActivo" id="labelNombreActivo">Nombre del activo</label>
            <input class="form-control" id="activoUbicacion" type="text" name="activoUbicacion" placeholder="Nombre del activo" readonly>
        </div>

        <div class="form-group">
            <label for="ubicacionActivo" id="labelEdificio">Edificio</label>
            <select class="form-control" onchange="actualizar(this);" id="edificio" placeholder="Seleccione edificio..." name="edificio" required>
                <option disabled selected value>Seleccione una opción</option>
                @foreach($edificios as $edificio)
                <option value="{{$edificio->sipa_edificios_nombre}}">
                    {{$edificio->sipa_edificios_nombre}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="ubicacionActivo" id="labelPlanta">Planta</label>
            <select class="form-control" id="planta" placeholder="Seleccione planta..." name="planta" required>
                <option disabled selected value>Seleccione una opción</option>
                @for ($i = 0; $i < $seleccionado->sipa_edificios_cantidad_pisos; $i++)
                    <option value="{{$i+1}}">{{$i+1}}</option>
                    @endfor
            </select>
        </div>

        <div class="form-group">
            <label for="ubicacionActivo" id="labelUbicacion"><b>Seleccione la nueva unidad:</b></label><br><br>
            <label for="ubicacionActivo" id="labelUnidadEjecutora">Unidad ejecutora</label>
            <select class="form-control" id="unidadEjecutora" placeholder="Seleccione unidad ejecutora..." name="unidadEjecutora" required>
                @foreach($unidades->cursor() as $unidad)
                <option value="{{$unidad->sipa_edificios_unidades_nombre}}">
                    {{$unidad->sipa_edificios_unidades_nombre}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="labelComprobante" id="labelComprobante">Agregue comprobante de cambio de ubicacion</label>
            <input class="form-control" id="boletaImagenCE" type="file" name="boletaImagenCE" required>
            <small class="form-text text-muted" for="labelComprobanteAdv" id="labelComprobanteAdv">El archivo debe estar en formato pdf y sin espacio en el nombre</small>
        </div>

        <button type="submit" class="btn btn-primary" id="ubicacionBoton"> Guardar </button>

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

function actualizar(elemento) {
    var nom = elemento.options[elemento.selectedIndex].innerHTML;
    console.log(nom);
    var url = "cbbx/" + nom;
    fetch(url).then(r => {
        console.log(r);
        return r.json();
    }).then(d => {
        var obj = JSON.stringify(d);
        var obj2 = JSON.parse(obj);
        console.log(obj2);
        var pisos = document.getElementById('planta');
        var unidades = document.getElementById('unidadEjecutora');
        for (var i = pisos.length - 1; i >= 0; i--) {
            pisos.remove(i);
        }
        for (var i = unidades.length - 1; i >= 0; i--) {
            unidades.remove(i);
        }
        var defaultOption = document.createElement('option');
        pisos.appendChild(defaultOption);
        unidades.appendChild(defaultOption);
        for (var i = 0; i < obj2.pisos; i++) {
            var option = document.createElement('option');
            option.innerHTML = i + 1;
            pisos.appendChild(option);
        }
        for (var i = 0; i < obj2.items.length; i++) {
            var option = document.createElement('option');
            option.innerHTML = obj2.items[i];
            unidades.appendChild(option);
        }
    });
}
</script>

@endsection