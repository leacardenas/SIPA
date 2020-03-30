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

<div class="row col-sm-12 justify-content-start configActivo">
@php
$usuarios = App\User::all();
@endphp

    <form>
        <div class="form-group ml-5">
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

        <div class="col-sm-12 justify-content-center">
            <h2>Insumos</h2>
        </div>

        <div class="col-sm-12 justify-content-center">
            <div class="col-sm-12 table-responsive-sm">
                <table class="table table-striped" id="table-usuarios">
                    <thead>
                    <tr>
                        <th scope="col" class="text-center">Código</th>
                        <th scope="col" class="text-center">Nombre</th>
                        <th scope="col" class="text-center">Cantidad</th>
                        <th scope="col" class="text-center">Acción</th>
                    </tr>
                    </thead>

                    <tbody class="text-center">
                    <tr id="">
                        <th class="text-center"> </th>
                        <th class="text-center" id="insumoNombre"> </th>
                        <th class="text-center"><input type="number" class="form-control"></th>
                        <th class="text-center"><button class="btn agregar"><span class="glyphicon glyphicon-plus"></span></button></th>
                    </tr>

                </table>
            </div>
        </div>
        
        <div class="form-group listaInsumos">
            <ul id="insumosSeleccionados">
                <li> bla</li>
            </ul>
        </div>

        <button class="btn btn-primary" >Aceptar</button>

    </form>
</div>

<script>
var arrayActivos = [];

 $("#insumosSeleccionados").on("click", "span", function(event) {
    $(this).parent().fadeOut(500, function() {
        $(this).remove();
    });
    event.stopPropagation();
});

$("#insumosSeleccionados").on("click", "li", function(event) {
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

$(".agregar").on("click", function(event) {
    event.preventDefault();

    if(arrayActivos.length < 18){
    let insumo = $('#insumoNombre').text();


    $("#activosSeleccionados").append(
        "<li class='activoSeleccionado' name = 'activSeleccionados'><span class='basurero'><i class='fa fa-trash'></i></span>    " +
        activo + " - " +  "</li>");
        // let select = document.getElementById('selectActivoTraslado');
        // let idActivo = select.options[select.selectedIndex].value;
        
        arrayActivos[arrayActivos.length] = idActivo;
        
    }else {
        alert("No se puede hacer traslado masivo de más de 18 activos");
    }

});
</script>

@endsection