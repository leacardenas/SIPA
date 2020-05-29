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
        @php
        $usuarios = App\User::all();
        $insumos = App\AgregarInsumo::where('sipa_insumo_factura',null)->get();
        @endphp

        <div class="col-sm-12 table-responsive-sm justify-content-center">
            <form method="POST" action="{{ url('/asociaFactura') }}" class="borrarForm" id="editarCntInsumos" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title"><b>Agregar Factura</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Número de documento</label>
                        <input type="text" class="form-control" name = "numeroDocumento" > 
                    </div>
                    <div class="form-group">
                        <label>Documento</label>
                        <input name = "documentoInsumos" class="form-control" type="file" required>
                        <small>Debe seleccionar un archivo .pdf</small>
                    </div> 
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
            <br>
            <table class="table table-striped" id="table-usuarios">
                <thead>
                <tr>
                    <th scope="col" class="text-center">Código</th>
                    <th scope="col" class="text-center">Nombre</th>
                    <th scope="col" class="text-center">Cantidad Agregar</th>
                    <th scope="col" class="text-center">Acción</th>
                </tr>
                </thead>
                @foreach($insumos as $insumo)
                <tbody class="text-center" id="tablaInsumos">
                <tr id="">
                    <td data-label="Código" class="codigo"><b>{{$insumo->insumo->sipa_insumos_codigo}}</b></td>
                    <td data-label="Nombre" class="nombre"><b>{{$insumo->insumo->sipa_insumos_nombre}}</b></td>
                    <td data-label="Cantidad Existente"><b>{{$insumo->sipa_ingreso_insumo_cantidad}}</b></td>
                    <td data-label="Acción">
                        <a data-toggle="modal" class="btn botonRojo borrar-btn" href="{{url('eliminarAgregar',$insumo->sipa_insumos_ingreso_id)}}">
                            <span class="glyphicon glyphicon-trash"></span> Borrar
                        </a>
                    </td>
                </tr>
                </tbody>
                @endforeach
            </table>
        </div>
    </div>

    {{-- <div class="mb-3 col-sm-12">
        <legend>Insumos Seleccionados</legend>
    </div>

    <div class="row col-sm-12 ml-5 listaInsumos">
        <ul id="insumosSeleccionados">
        </ul>
    </div> --}}
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



       