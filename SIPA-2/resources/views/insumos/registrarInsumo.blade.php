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
    <h1 id="registrarActivo" class="tituloModal">Registrar Insumo</h1>
</div>

<div class="row col-sm-12 justify-content-center configActivo">
    @php 
    // <!--cambiar -->
    $usuarios = App\User::all();
    
    @endphp

    <form method="POST" action="{{ url('/ingresarInsumo') }}" enctype="multipart/form-data" class="configForm">
        @csrf
        <div class="form-group">
            <label>Nombre</label>
            <input name = "nombreInsumos" class=" form-control" type="text" placeholder="Ingrese el nombre del insumo" required>
        </div>
        
        <div class="form-group">
            <label>Descripción</label>
            <textarea name = "descripcionInsumos" class="form-control" rows="5" type="text" placeholder="Ingrese la descripción del insumo" required></textarea>
        </div>
        <div class="form-group">
            <label>Tipo</label>
            <input name = "tipoInsumos" class=" form-control" type="text" placeholder="Ejemplo: unidad, paquete, caja, envase" required>
        </div>
        <div class="form-group">
            <label>Cantidad</label>
            <input name = "cantidadInsumos" class="form-control" type="number" required>
        </div>
        <div class="form-group">
            <label>Costo unitario</label>
            <input name = "costoUnitarioInsumos" class="form-control" type="text" placeholder="₡30,000" data-type="currency" 
             required>
        </div> 
        <div class="form-group">
            <label>Número de documento</label>
            <input type="text" class="form-control" required> 
        </div>
        <div class="form-group">
            <label>Documento</label>
            <input name = "documentoInsumos" class="form-control" type="file" required>
        </div> 
        
        
        <button type="submit" class="btn boton-config" id="registrarActivoBoton">
            Guardar
        </button>
    </form>

<script>


function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function(e) {
            $('#blah').attr('src', e.target.result);
        }
        document.getElementById("blah").style.display = "";
        reader.readAsDataURL(input.files[0]);
    }
}

$('.configForm').submit(function(){
    Swal.fire({
            icon: 'success',
            title: '¡Realizado con éxito!',
            text: 'El registro del insumo se ha realizado correctamente',
            timer: 6000,
            showConfirmButton: false,
            showCloseButton: true,
            });
});

//****************** */


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