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
    <h1 id="editarResponsable" class="tituloModal">Editar responsable de activo</h1>
</div>

<div class="row col-sm-12 justify-content-center configActivo">
    @php
    $usuarios = App\User::all();
    $activos = App\Activo::where('sipa_activo_activo',1)->get();;
    $edificios = App\Edifico::all();
    $seleccionado = $edificios->get(0);
    $unidades = App\Unidad::where('sipa_edificios_unidades_edificio',$seleccionado->id);
    $estados = App\EstadoActivo::all();
    @endphp

    <form method="POST" action="{{ url('/editaResp') }}" class="configForm" id="editarRespon" enctype="multipart/form-data">
    @csrf
        <div class="form-group">
            <label for="nombreActivo" id="labelNombreActivo" name="nombreActivo">Seleccione el código del activo que desea editar</label>
            <select class="form-control select2" onchange="verficarActv(this);" id="selectActivoResponsable" placeholder="Seleccione activo..." name="selectActivoResponsable" required>
                <option disabled selected value>Seleccione una opción</option>
                @foreach($activos as $activo)
                <option value="{{$activo->sipa_activos_codigo}}"> {{$activo->sipa_activos_codigo}} </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="nombreActivo" id="labelNombreActivo">Nombre del activo</label>
            <input class="form-control" id="nombreActivo" type="text" name="nombreActivo" placeholder="Nombre del activo" readonly>
        </div>

        <div class="form-group">
            <label for="nombreResponsable" id="labelNombreResponsable" name="labelNombreResponsable">Nuevo funcionario responsable</label>
            <select class="form-control select2" onchange="verificarResponsable(this);" id="nombreResponsable" placeholder="Seleccione funcionario..." name="nombreResponsable" required>
                <option disabled selected value>Seleccione una opción</option>
                @foreach($usuarios as $usuario)
                <option value="{{$usuario->sipa_usuarios_identificacion}}">
                    {{$usuario->sipa_usuarios_identificacion}} - {{$usuario->sipa_usuarios_nombre}}
                </option>
                @endforeach
            </select>
        </div>

         <div class="form-group">
            <label for="responsableNombre" id="labelNomResponsableAct">Nombre del Responsable</label>
            <input class="form-control" id="nomResponsableAct" type="text" name="nomResponsableAct" placeholder="Responsable del activo" readonly>
        </div>

        <div class="form-group">
            <label>Número de boleta</label>
            <input class="form-control" type="text" placeholder="Número de boleta" required>
        </div>

        <div class="form-group">
            <label for="labelComprobante" id="labelComprobante">Agregue comprobante de cambio de responsable</label>
            <input class="form-control" id="boletaImagenRes" type="file" name="boletaImagenRes" required>
            <small class="form-text text-muted" for="labelComprobanteAdv" id="labelComprobanteAdv">El archivo debe estar en formato pdf y sin espacio en el nombre</small>
        </div>

        <button type="submit" class="btn botonLargo" id="responsableBoton"> Guardar </button>
    </form>
</div>

<script>
function verificarResponsable(elemento) {
    var url = "verificar/" + elemento.value;
    console.log(elemento.value);
    fetch(url).then(r => {
        return r.json();
    }).then(d => {
        var obj = JSON.stringify(d);
        var obj2 = JSON.parse(obj);
        console.log(obj2);
        var responsable = document.getElementById('nomResponsableAct');
        responsable.value = obj2.nombreUsuario;

    });
}

function verficarActv(elemento) {
    var url = "verificarAct/" + elemento.value;
    console.log(elemento.value);
    fetch(url).then(r => {
        return r.json();
    }).then(d => {
        var obj = JSON.stringify(d);
        var obj2 = JSON.parse(obj);
        console.log(obj2);
        var activo = document.getElementById('nombreActivo');
        activo.value = obj2.nombreActivo;
        

    });
}

$('#editarRespon').submit(function(){
    Swal.fire({
            icon: 'success',
            title: '¡Realizado con éxito!',
            text: 'El funcionario responsable del activo se ha editado correctamente',
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