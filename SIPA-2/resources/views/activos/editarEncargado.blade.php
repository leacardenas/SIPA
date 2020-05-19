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
    <h1 id="editarEncargado" class="tituloModal">Editar encargado de activo</h1>
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

    <form method="POST" action="{{ url('/editaEnc') }}" class="configForm" id="editarEncarg" enctype="multipart/form-data">
        @csrf
         <div class="form-group">
            <label for="nombreActivo" id="labelNombreActivo">Seleccione el código del activo que desea editar</label>
            <select class="form-control select2" onchange="verficarActv(this);" id="selectActivoEncargado" placeholder="Seleccione activo..." name="selectActivoEncargado" required>
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
            <select class="form-control select2" onchange="verificarEncargado(this);" id="nombreEncargado" placeholder="Seleccione funcionario..." name="nombreEncargado" required>
                <option disabled selected value>Seleccione una opción</option>
                @foreach($usuarios as $usuario)
                <option value="{{$usuario->sipa_usuarios_identificacion}}">
                    {{$usuario->sipa_usuarios_identificacion}} - {{$usuario->sipa_usuarios_nombre}}
                </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="encargadoNombre" id="labelNomEncargadoAct">Nombre del Encargado</label>
            <input class="form-control" id="nomEncargadoAct" type="text" name="nomEncargadoAct" placeholder="Responsable del activo" readonly>
        </div>

        <div class="form-group">
            <label for="labelComprobante" id="labelComprobante">Agregue comprobante de cambio de encargado</label>
            <input class="form-control" id="boletaImagenEnc" type="file" name="boletaImagenEnc" required>
            <small class="form-text text-muted" for="labelComprobanteAdv" id="labelComprobanteAdv">El archivo debe estar en formato pdf y sin espacio en el nombre</small>
        </div>

        <button type="submit" class="btn botonLargo"> Guardar </button>

        <div class="alert alert-success alert-dismissable mt-3">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    ¡Encargado editado con éxito!
        </div>
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
        var activo = document.getElementById('nombreActivo2');
        activo.value = obj2.nombreActivo;
      

    });
}

function verificarEncargado(elemento) {
    var url = "verificar/" + elemento.value;
    fetch(url).then(r => {
        console.log(r);
        return r.json();
    }).then(d => {
        var obj = JSON.stringify(d);
        var obj2 = JSON.parse(obj); 
        var encargado = document.getElementById('nomEncargadoAct');
        encargado.value = obj2.nombreUsuario;
        

    });
}

$('#editarEncarg').submit(function(){
    Swal.fire({
            icon: 'success',
            title: '¡Realizado con éxito!',
            text: 'El funcionario encargado del activo se ha editado correctamente',
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