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
    <h1 id="registrarActivo" class="tituloModal">Entrega de Insumos</h1>
</div>

<div class="row col-sm-12">
<div class="row col-sm-12 justify-content-start configActivo">
@php
$usuarios = App\User::all();
$activos = App\Activo::all();
@endphp
    <form class="insumoForm">
        <div class="ml-5">
            <label>Seleccione el funcionario al que se le hará la entrega de insumos</label>
            <select class="form-control" required>
                <option disabled selected value>Seleccione un funcionario</option>
                @foreach($usuarios as $usuario)
                <option value="{{$usuario->sipa_usuarios_identificacion}}">
                    {{$usuario->sipa_usuarios_identificacion}} - {{$usuario->sipa_usuarios_nombre}}
                </option>
                @endforeach
            </select>
        </div>
    </form>
</div>

<div class="row col-sm-12 mt-5 justify-content-center">
    <h2>Insumos</h2>
</div>

<div class="row col-sm-12 ml-2 justify-content-center">
    <div class="col-sm-12 table-responsive-sm justify-content-center">
        <table class="table table-striped" id="table-usuarios">
            <thead>
            <tr>
                <th scope="col" class="text-center">Código</th>
                <th scope="col" class="text-center">Nombre</th>
                <th scope="col" class="text-center">Cantidad</th>
                <th scope="col" class="text-center">Acción</th>
            </tr>
            </thead>
            @foreach($activos as $activo)
            <tbody class="text-center">
            <tr id="">
                <th class="text-center">{{$activo->sipa_activos_codigo}}</th>
                <th class="text-center nombre">{{$activo->sipa_activos_nombre}}</th>
                <th class="text-center"><input type="number" class="form-control cantidad"></th>
                <th class="text-center"><button class="btn agregar"><span class="glyphicon glyphicon-plus"></span></button></th>
            </tr>
            </tbody>
            @endforeach
        </table>
    </div>
</div>

<div class="row col-sm-12 ml-5 mt-5">
    <legend>Insumos seleccionados</legend>
</div>
<div class="row col-sm-12 ml-5 listaInsumos">
    <ul id="insumosSeleccionados">
    </ul>
</div>

<div class="col-sm-12 mt-5 text-center">
    <button class="btn boton-insumo" >Aceptar</button>
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
    var insRemo = $(this).text();
    separador = "-";
    limite = 1;
  //  var nuevoInsRemo = insRemo.split(separador, limite);
 //   arrayInsumos = arrayInsumos.filter(elements => elements !== nuevoInsRemo[0]);
//    console.log(arrayInsumos);
    $(this).fadeOut(500, function() {
        $(this).remove();
    });
    event.stopPropagation();
});

$(".agregar").on("click", function(event) {
    event.preventDefault();

    if(arrayInsumos.length < 18){
    var nombre = $(this).closest("tr").find(".nombre").text();
    var cantidad = $(this).closest("tr").find(".cantidad").val();


    $("#insumosSeleccionados").append(
        "<li class='insumoSeleccionado'><span class='basurero'><i class='fa fa-trash'></i></span>    " +
        nombre + " - " + cantidad + " unidades" + "</li>");
        // let select = document.getElementById('selectActivoTraslado');
        // let idActivo = select.options[select.selectedIndex].value;
        
        //arrayInsumos[arrayInsumos.length] = nombre;
        
    }else {
        alert("No se puede hacer traslado masivo de más de 18 activos");
    }

});
</script>

@endsection