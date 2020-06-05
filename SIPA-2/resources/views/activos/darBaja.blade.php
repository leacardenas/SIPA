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
    <h1 id="darBaja" class="tituloModal">Dar de baja</h1>
</div>

<div class="row justify-content-center col-sm-12 configActivo">
    @php
    $usuarios = App\User::all();
    $activos = App\Activo::where('sipa_activo_activo',1)->get();
    // $edificios = App\Edifico::all();
    // $seleccionado = $edificios->get(0);
    // $unidades = App\Unidad::where('sipa_edificios_unidades_edificio',$seleccionado->id);
    $estados = App\EstadoActivo::all();
    @endphp

    <form id="darDeBaja"  enctype="multipart/form-data" class="col-sm-12">
        <div class="form-group">
            <label for="nombreActivo" id="labelNombreActivoBaja">Seleccione los activos que desea dar de baja</label>
            <select class="form-control select2 selectActivoBaja" id="selectActivoBaja" placeholder="Seleccione activo..." name="selectActivoBaja">
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
            <label for="nombreResponsable" id="labelNombreResponsable">Estado de los activos</label><br>
            <select class="form-control select2" id="estadoActivoBaja" name="estadoActivoBaja" required>
                <option disabled selected value>Seleccione un estado</option>
                @foreach($estados as $estado)
                <option value="{{$estado->sipa_estado_activo_nombre}}">{{$estado->sipa_estado_activo_nombre}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="razonBajaActivo" id="labelRazonBajaActivo">Razón por la que se dan de baja los activos</label>
            <textarea class="form-control" rows="10" cols="95" name="razonBajaActivo" id="razonBajaActivo" placeholder="Ingrese la razón por la que da de baja estos activos" required></textarea>
        </div>


        <button type = "button" class="btn botonLargo" id="darBaja"  data-toggle="modal" data-target="#modalCargarPdf" onclick="darBajaActivo()">Dar de baja</button>
        <!-- <br>
        <br>
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    ¡Activo dado de baja con éxito!
        </div> -->
    </form>

</div>

 <!-- MODAL -->
    <div class="modal fade" tabindex="-1" role="dialog" id="modalCargarPdf">
        <div class="modal-dialog" role="document">
            <div class="modal-content" id="cargarPdf"> 
                <div class="modal-header">
                    <h3 class="modal-title">Cargar archivo PDF de Dar de Baja</h3>
                    <button type="button" class="close cerrar" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body" id="darBajaFormPDF">
                    <form method="POST" action="{{ url('/darBaja') }}" enctype="multipart/form-data" id="trasladoMasivoForm">
                    @csrf
                        <div class="form-group" >
                            <label><i class="fas fa-exclamation-triangle"></i> Se debe seleccionar un archivo .pdf</label>
                        </div>
                        <div class="form-group">
                            <label>Número de boleta</label>
                            <input class="form-control" type="text" placeholder="Número de boleta" name = "numeroBoleta" required>
                        </div>
                        <div class="form-group">
                            <label>Seleccione la boleta correspondiente a la dada de baja</label>
                            <input class="form-control" type="file" id = "inputBoleta" name="boletaImagen" required>
                        </div>
                        <br>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" id="guardarPDF" name = "guardarPDF">Guardar</button>
                            <button type="button" class="btn btn-danger cerrar" data-dismiss="modal">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


<script>

var arrayActivos = [];

function darBajaActivo(){
    if(arrayActivos.length > 0){
        var archJson = JSON.stringify(arrayActivos);
        var estadoSelect = $("#estadoActivoBaja").val(); 
        var comentario = $("#razonBajaActivo").val();
        if(estadoSelect && comentario){
            var url = "darBajaAct/" + archJson + "/" + estadoSelect + "/" + comentario;
                fetch(url).then(r => {
                    return r.json();
                }).then(d => {
                    var obj = JSON.stringify(d);
                    var obj2 = JSON.parse(obj);
                    console.log(obj2);
                });
        }else{
            Swal.fire({
            icon: 'warning',
            title: '¡Alerta!',
            text: 'Debe llenar todos los campos',
            timer: 5000,
            confirmButtonColor: '#22407E',
            showCloseButton: true,
        });
        }
    }else{
        Swal.fire({
            icon: 'warning',
            title: '¡Alerta!',
            text: 'Debe seleccionar al menos 1 activos',
            timer: 5000,
            confirmButtonColor: '#22407E',
            showCloseButton: true,
        });
    }
}

$("#activosSeleccionados").on("click", "span", function(event) {
    if(arrayActivos.length){
        $('.botonLargo').prop('disabled', true);
    }

    $(this).parent().fadeOut(500, function() {
        $(this).remove();
    });
    event.stopPropagation();
});

$("#activosSeleccionados").on("click", "li", function(event) {
    if(arrayActivos.length){
        $('.botonLargo').prop('disabled', true);
        console.log("entro");
    }

    var actvRemo = $(this).text();
    separador = " - ";
    limite = 1;
    var nuevoActvRemo = actvRemo.split(separador, limite);
    console.log(nuevoActvRemo);
    arrayActivos = arrayActivos.filter(elements => elements !== nuevoActvRemo[0]);
    console.log(arrayActivos);
    $(this).fadeOut(500, function() {
        $(this).remove();
    });
    event.stopPropagation();
});

function enLista(){
    let seleccionado = $("#selectActivoBaja option:selected").text();
    let bandera = false;

    $("#activosSeleccionados li").each((id, elem) => {

        if(elem.innerText.trim() == seleccionado.trim()){
            Swal.fire({
            icon: 'error',
            title: '¡Error!',
            text: 'Ese activo ya fue seleccionado',
            timer: 6000,
            showConfirmButton: false,
            showCloseButton: true,
            });

            bandera = true;
        }
    });

    return bandera;
}

$("#agregar").on("click", function(event) {
    event.preventDefault();

    let seleccionado = $("#selectActivoBaja option:selected").text();

    let bandera = enLista();

    if(bandera == false){
        if(seleccionado === "Seleccione una opción"){
             $('.botonLargo').prop('disabled', true);

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
            $('.botonLargo').prop('disabled', false);
            let activo = $('#selectActivoBaja').find("option:selected").text();
            let select = document.getElementById('selectActivoBaja');
            let idActivo = select.options[select.selectedIndex].value;
            $("#activosSeleccionados").append(
                "<li class='activoSeleccionado' name = 'activSeleccionados'><span class='basurero'><i class='fa fa-trash'></i></span>" +
                activo + "</li>");
                // let select = document.getElementById('selectActivoTraslado');
                // let idActivo = select.options[select.selectedIndex].value;
                
                arrayActivos[arrayActivos.length] = idActivo;
                console.log(arrayActivos);
                
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
    }
});

$('#guardarPDF').submit(function(){
    Swal.fire({
            icon: 'success',
            title: '¡Realizado con éxito!',
            text: 'El activo se ha dado de baja correctamente',
            timer: 6000,
            showConfirmButton: false,
            showCloseButton: true,
            });
});

$(document).ready(function() {
    $('.select2').select2();
    $('.botonLargo').prop('disabled', true);

   
    
});


</script>

@endsection