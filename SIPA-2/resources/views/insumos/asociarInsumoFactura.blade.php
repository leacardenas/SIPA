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
        <div class="form-group">
            <label>Número de documento</label>
            <input type="text" class="form-control" required> 
        </div>
        <div class="form-group">
            <label>Documento</label>
            <input name = "documentoInsumos" class="form-control" type="file" required>
            <small>Debe seleccionar un archivo .pdf</small>
        </div> 
    </div>

    <div class="col-sm-12">
        <legend>Insumos</legend>
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
                <tbody class="text-center" id="tablaInsumos">
                <tr id="">
                    <td data-label="Código" class="codigo"><b>{{$insumo->sipa_insumos_codigo}}</b></td>
                    <td data-label="Nombre">{{$insumo->sipa_insumos_nombre}}</td>
                    <td data-label="Cantidad en Inventario">{{$insumo->sipa_insumos_cant_exist}}</td>
                    <td data-label="Cantidad en Factura"><input type="number" class="form-control cantidad" name = "cantidad" id = "cantidad"></td>
                    <td data-label="Costo Unitario" id="costoUnitario"> {{$insumo->sipa_insumos_costo_uni}}</td>
                    <td data-label="Costo Total"><input name = "costoTotalInsumos" class="form-control" id="costoTotal" type="text" placeholder="Costo Total" data-type="currency" readonly></td>
                    <td data-label="Acción"><button class="btn agregar"><span class="glyphicon glyphicon-plus"></span></button></td>
                </tr>
                </tbody>
                @endforeach
            </table>
        </div>
    </div>

    <div class="mb-3 col-sm-12">
        <h4><b>Insumos Seleccionados</b></h4>
    </div>

    <div class="row col-sm-12 ml-5 listaInsumos">
        <ul id="insumosSeleccionados">
        </ul>
    </div>

    <div class="col-sm-12 mt-5">
        <h4><b>Costo Total de la factura</b></h4>
        <input class="col-sm-2 form-control" id="costoTotalFactura" type="text" data-type="currency" readonly>
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
    var insRemo = $(this).text();
    //console.log(insRemo);
    var filtro = insRemo.replace(" unidades","");
    console.log(filtro);
    arrayInsumos = arrayInsumos.filter(elements => elements !== filtro);
    console.log(arrayInsumos);

    $(this).fadeOut(500, function() {
        $(this).remove();
    });
    event.stopPropagation();
});

$(".agregar").on("click", function(event) {
    event.preventDefault();

    var codigo = $(this).closest("tr").find(".codigo").text();
    var cantidad = $(this).closest("tr").find(".cantidad").val();

    //validar que el input de cantidad no este vacio
   if(!cantidad || cantidad<=0){
        Swal.fire({
                    icon: 'warning',
                    title: '¡Alerta!',
                    text: 'Debe ingresar una cantidad mayor a 0',
                    timer: 6000,
                    showConfirmButton: false,
                    showCloseButton: true,
                    });
   }else{
        $("#insumosSeleccionados").append(
            "<li class='insumoSeleccionado' name='insumosLI'><span class='basurero'><i class='fa fa-trash'></i></span> " +
            codigo + " - " + cantidad + " unidades" + "</li>");
         
        arrayInsumos[arrayInsumos.length] =  codigo;

        let costoTotal = $(this).closest("tr").find("#costoTotal").val();

        let array = costoTotal.split("₡");
        let costoTotal2 = parseInt(array[1].split(",").join('').trim());
        console.log("COSTO TOTAL " + array[1]);
        console.log(costoTotal2);

        if($("#costoTotalFactura").val()){
            
        let costoGeneral = $("#costoTotalFactura").val();

        let array2 = costoGeneral.split("₡");
        let costoGeneral2 = parseInt(array2[1].split(",").join('').trim());
        console.log("COSTO GENERAL " + array2[1]);
        console.log(costoGeneral2);

        $("#costoTotalFactura").val(costoTotal2 + costoGeneral2).focus();
        
        }else{
            $("#costoTotalFactura").val(costoTotal2).focus();
        }


   }

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



       