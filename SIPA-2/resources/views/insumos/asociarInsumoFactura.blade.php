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

    <form method="POST" action="{{ url('/asociaFactura') }}" enctype="multipart/form-data" class="configForm">
        @csrf
        <div class="col-sm-12">
            <div class="form-group">
                <label>Número de documento</label>
                <input type="text" name = "numeroDocumento" class="form-control" > 
            </div>
            <div class="form-group">
                <label>Documento</label>
                <input name = "documentoInsumos" class="form-control" type="file" >
                <small>Debe seleccionar un archivo .pdf</small>
            </div> 
        </div>

        <div class="col-sm-12">
            <legend>Insumos</legend>

            @php
            $insumos = App\AgregarInsumo::where('sipa_insumo_factura',null)->get();
            $totalFactura =  0;
            @endphp

            <div class="col-sm-12 table-responsive-sm justify-content-center">
                <div class="input-group-prepend">
                <span class="input-group-text">
                    <svg class="bi bi-search" width="1em" height="1em" viewBox="0 0 16 16" fill="#00000" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 011.415 0l3.85 3.85a1 1 0 01-1.414 1.415l-3.85-3.85a1 1 0 010-1.415z" clip-rule="evenodd"/>
                        <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 100-11 5.5 5.5 0 000 11zM13 6.5a6.5 6.5 0 11-13 0 6.5 6.5 0 0113 0z" clip-rule="evenodd"/>
                    </svg>
                </span>
                <input class="form-control" id="insumos" type="text" placeholder="Ingrese información del insumo para buscar">
                </div>
                <br>
                <table class="table table-striped" id="table-usuarios">
                    <thead>
                    <tr>
                        <th scope="col" class="text-center">Código</th>
                        <th scope="col" class="text-center">Nombre</th>
                        <th scope="col" class="text-center">Cantidad en Inventario</th>
                        <th scope="col" class="text-center">Cantidad en Factura</th>
                        <th scope="col" class="text-center">Costo Unitario</th>
                        <th scope="col" class="text-center">Costo Total</th>
                        <th scope="col" class="text-center">Acción</th>
                    </tr>
                    </thead>
                    @foreach($insumos as $insumo)
                    @php
                        $precioInsumo = $insumo->sipa_ingreso_total;
                        $totalInsumo = (int)str_replace(',','',Str::before(trim($precioInsumo, "₡"),'.'));
                        $totalFactura = $totalFactura + $totalInsumo;
                    @endphp
                    <tbody class="text-center" id="tablaInsumos">
                    <tr id="">
                        <td data-label="Código" class="codigo"><b>{{$insumo->insumo->sipa_insumos_codigo}}</b></td>
                        <td data-label="Nombre">{{$insumo->insumo->sipa_insumos_nombre}}</td>
                        <td data-label="Cantidad en Inventario">{{$insumo->insumo->sipa_insumos_cant_exist}}</td>
                        <td data-label="Cantidad en Factura"> {{$insumo->sipa_ingreso_insumo_cantidad}}</td>
                        <td data-label="Costo Unitario" id="costoUnitario"> {{$insumo->sipa_ingreso_precio_unitario}}</td>
                        <td data-label="Costo Total"> {{$precioInsumo}}</td>
                        <td data-label="Acción"><button data-toggle="modal" data-target="#borrarModal" id="{{$insumo->sipa_insumos_ingreso_id}}" class="btn borrar-btn botonRojo"><span class="glyphicon glyphicon-trash"></span> Borrar</button></td>
                    </tr>
                    </tbody>
                    @endforeach
                </table>

                <div class="col-sm-12 mt-5">
                    <h4><b>Costo Total de la Factura</b></h4>
                    <input class="col-sm-2 form-control" id="costoTotalFactura" type="text" data-type="currency" value = "{{'₡'.number_format($totalFactura,2)}}" readonly>
                </div>
            </div>
        </div>

        <div class="col-sm-12 mt-5 text-center">
            <button class="btn botonLargo" type="submit" name ="guardar" id="guardar">Guardar</button>
        </div>
    </form>
</div>

<!-- MODAL Borrar -->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" id="borrarModal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><b>Borrar Insumo</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>¿Está seguro que desea eliminar el insumo?</p>
            </div>
            <div class="modal-footer">
            <form method="POST" action="{{ url('/eliminarAgregar') }}" class="borrarForm"c id="editarRespon" >
                @csrf
                <input type="hidden" id="ingresoId" name="ingresoId">
                <button type="submit" class="btn btn-primary" name= "aceptar" id="aceptar">Aceptar</button>
            </form>
            <form method="GET" action="{{ url ('/inventarioEquipos')}}" >
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </form>
            </div>
        </div>
    </div>
</div>

<script>

$(".borrar-btn").click(function(){
    var actID = this.id;

    $('#ingresoId').attr('value', actID);

});
//FETCH QUE PUEDE SERVIRME
// $("#guardar").on("click",function(event){
//     var archJson = JSON.stringify(arrayInsumos);
//     var funcionario =  document.getElementById('asignacionFuncionario');
//     var idFuncionario = funcionario.options[funcionario.selectedIndex].value;
//     var observacion = document.getElementById('observacionInsumo').value;
//     if(!observacion){
//         observacion = 'Sin observaciones';
//     }
//     //console.log(observacion);
//     if(arrayInsumos.length>0){
//         if(idFuncionario){
//             var url = "asignarInsumos/" + archJson + "/" + idFuncionario + "/" + observacion;
//             //console.log(url);
//             fetch(url).then(r => {
//                 return r.json();
//             }).then(d => {
//                 var obj = JSON.stringify(d);
//                 var obj2 = JSON.parse(obj);
//                 if(obj2.respuesta == "Exito"){
//                     Swal.fire({
//                         icon: 'success',
//                         title: '¡Realizado con éxito!',
//                         text: 'La información de la entrega de insumos se ha guardado correctamente',
//                         timer: 6000,
//                         showConfirmButton: false,
//                         showCloseButton: true,
//                         });

//                     window.location.reload(true);
//                 }else{
//                     Swal.fire({
//                         icon: 'warning',
//                         title: 'Alerta',
//                         text: 'No seleccionó ningun funcionario',
//                         timer: 6000,
//                         showConfirmButton: false,
//                         showCloseButton: true,
//                         });
//                 }
//             });
//         }else{
//             Swal.fire({
//             icon: 'warning',
//             title: 'Alerta',
//             text: 'No seleccionó ningun funcionario',
//             timer: 6000,
//             showConfirmButton: false,
//             showCloseButton: true,
//             });
//         }
//     }else{
//         Swal.fire({
//             icon: 'warning',
//             title: 'Alerta',
//             text: 'No ha enviado ningun insumo',
//             timer: 6000,
//             showConfirmButton: false,
//             showCloseButton: true,
//             });
//     }
// });

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

//********************* */

$(".cantidad").change(function(){
    
    let cantidad = parseInt($(this).closest("tr").find(".cantidad").val());
    let costo = $(this).closest("tr").find("#costoUnitario").text();

    let array = costo.split("₡");

    let costo2 = parseInt(array[1].split(",").join('').trim());
    
    $(this).closest("tr").find("#costoTotal").val(costo2 * cantidad).focus();
    
});

$("input[data-type='currency']").on({

    keyup: function() {
      formatCurrency($(this));
    },
    blur: function() { 
      formatCurrency($(this), "blur");
    }
});


function formatNumber(n) {
  // format number 1000000 to 1,234,567
  return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
}


function formatCurrency(input, blur) {
  // appends $ to value, validates decimal side
  // and puts cursor back in right position.
  
  // get input value
  var input_val = input.val();
  
  // don't validate empty input
  if (input_val === "") { return; }
  
  // original length
  var original_len = input_val.length;

  // initial caret position 
  var caret_pos = input.prop("selectionStart");
    
  // check for decimal
  if (input_val.indexOf(".") >= 0) {

    // get position of first decimal
    // this prevents multiple decimals from
    // being entered
    var decimal_pos = input_val.indexOf(".");

    // split number by decimal point
    var left_side = input_val.substring(0, decimal_pos);
    var right_side = input_val.substring(decimal_pos);

    // add commas to left side of number
    left_side = formatNumber(left_side);

    // validate right side
    right_side = formatNumber(right_side);
    
    // On blur make sure 2 numbers after decimal
    if (blur === "blur") {
      right_side += "00";
    }
    
    // Limit decimal to only 2 digits
    right_side = right_side.substring(0, 2);

    // join number by .
    input_val = "₡" + left_side + "." + right_side;

  } else {
    // no decimal entered
    // add commas to number
    // remove all non-digits
    input_val = formatNumber(input_val);
    input_val = "₡" + input_val;
    
    // final formatting
    if (blur === "blur") {
      input_val += ".00";
    }
  }
  
  // send updated string to input
  input.val(input_val);

  // put caret back in the right position
  var updated_len = input_val.length;
  caret_pos = updated_len - original_len + caret_pos;
  input[0].setSelectionRange(caret_pos, caret_pos);
}

</script>
@endsection



       