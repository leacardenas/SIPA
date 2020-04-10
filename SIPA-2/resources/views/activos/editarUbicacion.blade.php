@extends('plantillas.inicio')

@section('content')
<div class="row col-sm-12">
    <form method="get" action="{{url('/configuracionesActivos')}}">
        <button type="submit" type="button" class="btn btn-secondary volver">
            <span class="glyphicon glyphicon-chevron-left"></span> Volver
        </button>
    </form>
</div>

<div class="row col-sm-12 justify-content-center">
    <h1 id="editarUbicacion" class="tituloModal">Editar ubicación de activo</h1>
</div>

<div class="row col-sm-12 configActivo">
    @php
    $usuarios = App\User::all();
    $activos = App\Activo::all();
    $edificios = App\Edifico::all();
    $seleccionado = $edificios->get(0);
    $unidades = App\Unidad::where('sipa_edificios_unidades_edificio',$seleccionado->id);
    $estados = App\EstadoActivo::all();
    @endphp

    <form id="editUbicacion" method="POST" action="{{ url('/editaUbicacion') }}" enctype="multipart/form-data">
    @csrf
        <div class="form-group">
            <label for="nombreActivo" id="labelActivoUbicacion">Seleccione el activo que desea editar</label>
            <select class="form-control" onchange="verficarActv(this);" id="selectActivoUbicacion" placeholder="Seleccione activo..." name="selectActivoUbicacion" required>
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
                <option value="{{$edificio->sipa_edificios_nombre}}">{{$edificio->sipa_edificios_nombre}}</option>
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
        <br>

        <div class="form-group">
            <legend>Seleccione la nueva unidad:</legend>
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
        <br>
        <button type="submit" class="btn btn-primary boton-config" id="ubicacionBoton"> Guardar </button>
    </form>
</div>

<script>
function verficarActv(elemento, elemento2) {
    var url = "verificarAct/" + elemento.value;
    fetch(url).then(r => {
        return r.json();
    }).then(d => {
        var obj = JSON.stringify(d);
        var obj2 = JSON.parse(obj);
        var activo = document.getElementById('activoUbicacion');
        activo.value = obj2.nombreActivo;
        

    });
}

function actualizar(nombre) {
    var nom = nombre.options[nombre.selectedIndex].innerHTML;
    console.log(nom);
    var url = "cbbx/"+nom;
    console.log(url);
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
                for(var i = 0; i < obj2.pisos; i++){
                        var option = document.createElement('option');
                        option.innerHTML = i+1;
                        pisos.appendChild(option);
                }
                for(var i = 0; i < obj2.items.length; i++){
                        var option = document.createElement('option');
                        option.innerHTML = obj2.items[i];
                        unidades.appendChild(option);
                }
            });
}

$('#editUbicacion').submit(function(){
    Swal.fire({
            icon: 'success',
            title: '¡Realizado con éxito!',
            text: 'La ubicación del activo se ha editado correctamente',
            timer: 6000,
            showConfirmButton: false,
            showCloseButton: true,
            });
});


</script>

@endsection