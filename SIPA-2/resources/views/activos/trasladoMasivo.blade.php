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
    <h1 id="trasladoMasivo" class="tituloModal">Traslado masivo de activo</h1>
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

    <div class="configForm">
    <div class="form-group">
        <label for="nombreActivo" id="labelNombreActivoBaja">Seleccione los activos que desea trasladar</label>
        <select class="form-control select2" id="selectActivoTraslado" placeholder="Seleccione activo...">
            <option disabled selected value>Seleccione una opción</option>
            @foreach($activos as $activo)
            <option value="{{$activo->sipa_activos_codigo}}">{{$activo->sipa_activos_codigo}} - {{$activo->sipa_activos_nombre}}
            </option>
            @endforeach
        </select>

        <button class="btn boton mt-3" id="agregar"><i class="glyphicon glyphicon-plus"></i> Agregar</button>
    </div>

    <div id="listaActivos" name = "listaActivos" class="form-group">
        <ul id="activosSeleccionados" name="activosSeleccionados">
        </ul>
    </div>

    <div class="form-group">
        <label for="boleta" id="labeltrasladoFun">Seleccione el funcionario al que se le trasladarán los activos</label>
        <select class="form-control select2" onchange="verificarEncargado(this)" id="selectFuncionarioTrasMasiv" name = "selectFuncionarioTrasMasiv" placeholder="Seleccione funcionario..." required>
            <option disabled selected value>Seleccione una opción</option>
            @foreach($usuarios as $usuario)
            <option value="{{$usuario->sipa_usuarios_identificacion}}">
                {{$usuario->sipa_usuarios_identificacion}} - {{$usuario->sipa_usuarios_nombre}}
            </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="encargadoNombre" id="labelencargadoTrasMasiv">Nombre del nuevo encargado</label>
        <input class="form-control" id="encargadoTrasMasiv" type="text" name="encargadoTrasMasiv" placeholder="Responsable del activo" readonly>
    </div>

    <!-- <button type="submit" class="btn btn-primary" id="guardarPDF"> Guardar Archivo PDF </button> -->
   
    
    <button type="button" onclick="trasladoMasivo(event,'modalCargarPdf')"  class="btn botonLargo" id="trasladar" data-dismiss="alert" > Trasladar </button>




    <!-- MODAL -->
    <div class="modal" tabindex="-1" role="dialog" id="modalCargarPdf">
        <div class="modal-dialog" role="document">
            <div class="modal-content" id="cargarPdf"> 
                <div class="modal-header">
                    <h3 class="modal-title">Cargar archivo PDF del Traslado Masivo</h3>
                    <button type="button" class="close cerrar" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body" id="darBajaFormPDF">
                    <form method="POST" action="{{ url('/agregarPdf') }}" enctype="multipart/form-data" id="trasladoMasivoForm">
                    @csrf
                        <div class="form-group" >
                            <label><i class="fas fa-exclamation-triangle"></i> Se debe seleccionar un archivo .pdf para poder realizar el traslado masivo</label>
                        </div>
                        <div class="form-group">
                            <label>Seleccione la boleta correspondiente al traslado masivo</label>
                            <input class="form-control" type="file" id = "inputBoleta" name="boletaImagen" required>
                        </div>
                        <br>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" id="guardarPDF">Guardar</button>
                            <button type="button" class="btn btn-danger cerrar" data-dismiss="modal">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<!-- 
    <div id="modalCargarPdf" class="modal">
        <div class="contenidoModal" id="cargarPdf">
            <div class= "divTituloModal" id="darBajaTituloPDF">
                <h1 id="darBajaPDF" class="tituloModal">Cargar archivo PDF del Traslado Masivo</h1>
            </div>
            <div id="darBajaFormPDF" class="modalBody">
                <form method="POST" action="{{ url('/agregarPdf') }}" enctype="multipart/form-data" id="trasladoMasivoForm">
                    @csrf

                    <div class = "form-group">
                        <label id = "advertencia"> Si no se agrega un archivo pdf, no se realizara el traslado de los activos</label>
                    </div>
                    <div class="form-group">
                        <label id="advertencia">Seleccione la boleta correspondiente al traslado masivo</label>
                        <input class="form-control" type="file" id = "inputBoleta" name="boletaImagen" required>
                        <small class="form-text text-muted" for="labelComprobanteAdv" id="labelComprobanteAdv">El archivo debe estar en formato .pdf</small>
                    </div>
                    <button type="submit"  class="btn boton-config" id="guardarPDF">
                        Guardar Archivo PDF
                    </button>
                </form>
                </div>
        </div>
    </div>
</div> -->

<script>
var arrayActivos = [];

function abrirModal(evt, modal) {
        var i, modals;
        modals = document.getElementsByClassName("modal");
        for (i = 0; i < modals.length; i++) {
            modals[i].style.display = "none";
        }
        document.getElementById(modal).style.display = "block";
}

$("#activosSeleccionados").on("click", "span", function(event) {
    $(this).parent().fadeOut(500, function() {
        $(this).remove();
    });
    event.stopPropagation();
});

$("#activosSeleccionados").on("click", "li", function(event) {
    var actvRemo = $(this).text();
    separador = "-";
    limite = 1;
    var nuevoActvRemo = actvRemo.split(separador, limite);
    arrayActivos = arrayActivos.filter(elements => elements !== nuevoActvRemo[0]);
    console.log(arrayActivos);
    $(this).fadeOut(500, function() {
        $(this).remove();
    });
    event.stopPropagation();
});

$("#agregar").on("click", function(event) {
    event.preventDefault();

     let seleccionado = $("#selectActivoTraslado option:selected").text();

    if(seleccionado === "Seleccione una opción"){
         Swal.fire({
            icon: 'error',
            title: '¡Error!',
            text: 'Debe seleccionar un activo',
            timer: 6000,
            showConfirmButton: false,
            showCloseButton: true,
            });
    }
    else{
        if(arrayActivos.length < 18){
        let activo = $('#selectActivoTraslado').find("option:selected").text();
        let select = document.getElementById('selectActivoTraslado');
        let idActivo = select.options[select.selectedIndex].value;
        $("#activosSeleccionados").append(
            "<li class='activoSeleccionado' name = 'activSeleccionados'><span class='basurero'><i class='fa fa-trash'></i></span>    " +
            activo + "</li>");
            // let select = document.getElementById('selectActivoTraslado');
            // let idActivo = select.options[select.selectedIndex].value;
            
            arrayActivos[arrayActivos.length] = idActivo;
            
        }else {
            Swal.fire({
            icon: 'warning',
            title: '¡Alerta!',
            text: 'No se puede realizar un traslado de más de 18 activos',
            timer: 5000,
            confirmButtonColor: '#22407E',
            showCloseButton: true,
            });
        }
    }

});

function trasladoMasivo(evt,modal) {
    
        if(arrayActivos.length > 1){
            var pdfLabel = document.getElementById('inputBoleta');
            var archJson = JSON.stringify(arrayActivos);
            var encargadoNuevo = document.getElementById('selectFuncionarioTrasMasiv');
            var cedEncargado = encargadoNuevo.options[encargadoNuevo.selectedIndex].value;
            if(document.getElementById('encargadoTrasMasiv').value){
                var url = "traspasoMasiv/" + archJson + "/" + cedEncargado;
                fetch(url).then(r => {
                    return r.json();
                }).then(d => {
                    var obj = JSON.stringify(d);
                    var obj2 = JSON.parse(obj);
                });
                abrirModal(evt,modal);
            }else{
                Swal.fire({
                    icon: 'warning',
                    title: '¡Alerta!',
                    text: 'Debe seleccionar un nuevo encargado',
                    timer: 5000,
                    confirmButtonColor: '#22407E',
                    showCloseButton: true,
                    });
            }
        }else{
            Swal.fire({
                icon: 'warning',
                title: '¡Alerta!',
                text: 'Debe seleccionar como mínimo 2 activos',
                timer: 5000,
                confirmButtonColor: '#22407E',
                showCloseButton: true,
                });
        }
    }

function verificarEncargado(elemento) {
    var url = "verificar/" + elemento.value;
    console.log(elemento.value);
    fetch(url).then(r => {
        console.log(r);
        return r.json();
    }).then(d => {
        var obj = JSON.stringify(d);
        var obj2 = JSON.parse(obj); 
        var encargado = document.getElementById('encargadoTrasMasiv');
        encargado.value = obj2.nombreUsuario;
    });
}

$('#trasladoMasivoForm').submit(function(){
    Swal.fire({
            icon: 'success',
            title: '¡Realizado con éxito!',
            text: 'El traslado masivo de los activos se ha realizado correctamente',
            timer: 6000,
            showConfirmButton: false,
            showCloseButton: true,
            });
});

$(".cerrar").on('click', function(){
    $(".modal").hide();
});

$(document).ready(function() {
    $('.select2').select2();
});

</script>
@endsection