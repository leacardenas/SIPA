@extends('plantillas.inicio')

@section('content')
<div class="row col-sm-12">
    <form method="get" action="{{url('/inventarioInsumos')}}">
        <button type="submit" type="button" class="btn btn-secondary volver">
            <span class="glyphicon glyphicon-chevron-left"></span> Volver
        </button>
    </form>
</div>

<div class="row justify-content-center col-sm-12">
    <h1 id="registrarActivo" class="tituloModal">Asociar Factura a Insumos</h1>
</div>

<div class="row col-sm-12 justify-content-center">
    <div class="col-sm-12">
        <h4 class="mb-5">Seleccione los insumos pertenecientes a la factura ingresada</h4>

        @php
        $usuarios = App\User::all();

        $insumos = App\Insumos::all();
        @endphp

        <div class="col-sm-12 table-responsive-sm justify-content-center">
            <div class="input-group-prepend">
            <span class="input-group-text">
                <svg class="bi bi-search" width="1em" height="1em" viewBox="0 0 16 16" fill="#00000" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 011.415 0l3.85 3.85a1 1 0 01-1.414 1.415l-3.85-3.85a1 1 0 010-1.415z" clip-rule="evenodd"/>
                    <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 100-11 5.5 5.5 0 000 11zM13 6.5a6.5 6.5 0 11-13 0 6.5 6.5 0 0113 0z" clip-rule="evenodd"/>
                </svg>
            </span>
            <input class="form-control col-sm-3" id="insumos" type="text" placeholder="Ingrese información del insumo para buscar">
            </div>
            <br>
            <table class="table table-striped" id="table-usuarios">
                <thead>
                <tr>
                    <th scope="col" class="text-center">Código</th>
                    <th scope="col" class="text-center">Nombre</th>
                    <th scope="col" class="text-center">Cantidad Existente</th>
                    <th scope="col" class="text-center">Acción</th>
                </tr>
                </thead>
                @foreach($insumos as $insumo)
                <tbody class="text-center" id="tablaInsumos">
                <tr id="">
                    <input type = "hidden" value = "{{$insumo->sipa_insumos_id}}" class = "id">
                    <td data-label="Código" class="codigo"><b>{{$insumo->sipa_insumos_codigo}}</b></td>
                    <td data-label="Nombre" class="nombre">{{$insumo->sipa_insumos_nombre}}</td>
                    <td data-label="Cantidad Existente">{{$insumo->sipa_insumos_cant_exist}}</td>
                    <td data-label="Acción"><button class="btn agregar"><span class="glyphicon glyphicon-plus"></span></button></td>
                </tr>
                </tbody>
                @endforeach
            </table>
        </div>
    </div>

    <div class="mb-3 col-sm-12">
        <legend>Insumos Seleccionados</legend>
    </div>

    <div class="row col-sm-12 ml-5 listaInsumos">
        <ul id="insumosSeleccionados">
        </ul>
    </div>

    <div class="col-sm-12 mt-5 text-center">
        <button class="btn botonLargo" type="button" name ="guardar" id="guardar">Guardar</button>
    </div>
</div>

<script>
var arrayInsumos = [];

 $("#insumosSeleccionados").on("click", "span", function(event) {
    $(this).parent().fadeOut(500, function() {
        $(this).remove();
    });
    event.stopPropagation();
});

$("#insumosSeleccionados").on("click", "li", function(event) {
    var insRemo = $(this).val();
    var filtro = insRemo.toString();
    arrayInsumos = arrayInsumos.filter(elements => elements !== filtro);

    $(this).fadeOut(500, function() {
        $(this).remove();
    });
    event.stopPropagation();
});

$(".agregar").on("click", function(event) {
    event.preventDefault();

    //var nombre = $(this).closest("tr").find(".nombre").text();
    var codigo = $(this).closest("tr").find(".codigo").text();
    var nombre = $(this).closest("tr").find(".nombre").text();
    var id = $(this).closest("tr").find(".id").val();
    $("#insumosSeleccionados").append(
        "<li class='insumoSeleccionado' name='insumosLI' value = "+id+"><span class='basurero'><i class='fa fa-trash'></i></span> " +
        codigo + " - " + nombre + "</li>");
    
    arrayInsumos[arrayInsumos.length] =  id;
    console.log(arrayInsumos);
        

});

//FETCH QUE PUEDE SERVIRME
$("#guardar").on("click",function(event){
    if(arrayInsumos.length>0){
        var archJson = JSON.stringify(arrayInsumos);
        console.log(archJson);
            var url = "asociaFactura/" + archJson;
            //console.log(url);
            fetch(url).then(r => {
                return r.json();
            }).then(d => {
                var obj = JSON.stringify(d);
                var obj2 = JSON.parse(obj);
                console.log(obj2);
                if(obj2.respuesta == "Exito"){
                    Swal.fire({
                        icon: 'success',
                        title: '¡Realizado con éxito!',
                        text: 'Se le ha asignado la factura con exito',
                        timer: 6000,
                        showConfirmButton: false,
                        showCloseButton: true,
                        });
                }else{
                    Swal.fire({
                        icon: 'warning',
                        title: '¡Realizado con éxito!',
                        text: 'Se presento un error al asignar la factura, vuelva a intentar',
                        timer: 6000,
                        showConfirmButton: false,
                        showCloseButton: true,
                        });
                }
            });
    }else{
        Swal.fire({
            icon: 'warning',
            title: 'Alerta',
            text: 'No ha seleccionado ningun insumo',
            timer: 6000,
            showConfirmButton: false,
            showCloseButton: true,
            });
    }
});

//BUSCAR INPUT

$(document).ready(function(){

  $("#insumos").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#tablaInsumos tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});

$(document).ready(function() {
    $('.select2').select2();
});
</script>
@endsection



       