@extends('plantillas.inicio')

@section('content')
@php
$cedula = session('idUsuario');
$user = App\User::where('sipa_usuarios_identificacion',$cedula)->get()[0];
$modulo = App\Modulo::where('sipa_opciones_menu_codigo',"INV_INSUMO")->get()[0];
$insumos = App\Insumos::all();

$rol = App\User::where('sipa_usuarios_identificacion',$cedula)->get()[0]->rol;
$permisoDePantalla = App\Permiso::where('sipa_permisos_roles_opcion_menu_codigo','HISTO_SALA')->where('sipa_permisos_roles_role',$rol->sipa_roles_id)->get()[0];
@endphp

<div class="row col-sm-12">
    <form method="get" action="{{url('/inventario')}}">
    <button type="submit" type="button" class="btn btn-secondary volver">
        <span class="glyphicon glyphicon-chevron-left"></span> Volver
    </button>
    </form>
</div>

<div class="row col-sm-12">

        <div class="row justify-content-center col-sm-12 mb-5">
            <h1 id="activos-registrados">Insumos Registrados</h1>
        </div>
    
    <div class="row ml-2 mb-4 mt-4">
        @if($permisoDePantalla->sipa_permisos_roles_crear == true)
        <div class="col-sm-2">
            <form method="get" action="{{url('/registrarInsumo')}}">
                <button type="submit" class="btn boton" >
                    <span class="glyphicon glyphicon-plus"></span> Registrar
                </button>
            </form>
        </div>
        @endif
        @if($permisoDePantalla->sipa_permisos_roles_editar == true)
        <div class="col-sm-2">
            <form method="GET" action="{{url('/entregarInsumo')}}">
                <button type="submit" class="btn boton">
                    <span class="glyphicon glyphicon-edit"></span> Entregar
                </button>
            </form>
        </div>
        @endif
        @if($permisoDePantalla->sipa_permisos_roles_crear == true)
        <div class="col-sm-4">
            <form method="GET" action="{{url('/asociarFactura')}}">
                <button type="submit" class="btn boton" >
                    <span class="fas fa-file-invoice-dollar"></span> Asociar Insumo a Factura
                </button>
            </form>
        </div>
        @endif
        @if($permisoDePantalla->sipa_permisos_roles_ver == true)
        <div class="col-sm-3">
            <form method="GET" action="{{url('/comprobantesEntregas')}}">
                <button type="submit" class="btn boton" >
                    <span class="fas fa-file-invoice"></span> Comprobantes de Entregas
                </button>
            </form>
        </div>
        @endif
    </div>
    
    <div class="row col-sm-12 justify-content-center">
        <div class="col-sm-12 table-responsive-sm table-wrapper-scroll-y">
        <h4>Buscar insumo</h4>
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
            <table class="table table-striped table-hover" id="table-usuarios">
                <thead>
                <tr>
                    <th  scope="col"  class="text-center">Código</th>
                    <th  scope="col"  class="text-center">Nombre</th>
                    <th  scope="col"  class="text-center">Descripción</th>
                    <th  scope="col"  class="text-center">Cantidad</th>
                    <th  scope="col"  class="text-center">Costo Unitario</th>
                    <th  scope="col"  class="text-center">Acción</th>
                </tr>
                </thead>
                
                <tbody class="text-center" id="tablaInsumos">
                @if(count($insumos) > 0)
                @foreach($insumos as $insumo)
                    <tr id="{{$insumo->sipa_insumos_id}}"> 
                        <td data-label="Código"> <b> {{$insumo->sipa_insumos_codigo}} </b> </td>
                        <td data-label="Nombre"> {{$insumo->sipa_insumos_nombre}} </td>
                        <td data-label="Descripción"> {{$insumo->sipa_insumos_descrip}} </td>
                        <td data-label="Cantidad"> {{$insumo->sipa_insumos_cant_exist}} </td>
                        <td data-label="Costo Unitario"> {{$insumo->sipa_insumos_costo_uni}} </td>
                        <td data-label="Acción"> 
                                @if($permisoDePantalla->sipa_permisos_roles_editar == true)
                                <div class="row mb-2 justify-content-center">
                                    <a data-toggle="modal" data-target="#editarModal" class="btn botonAzul editar-btn" id="{{$insumo->sipa_insumos_id}}" >
                                        <span class="glyphicon glyphicon-edit"></span> Ajuste
                                    </a>
                                </div>
                                @endif

                                @if($permisoDePantalla->sipa_permisos_roles_editar == true)
                                <div class="row mb-2 justify-content-center">
                                    <a data-toggle="modal" data-target="#agregarModal" class="btn botonAzul agregar-btn" id="{{$insumo->sipa_insumos_id}}" >
                                        <span class="glyphicon glyphicon-plus"></span> Agregar
                                    </a>
                                </div>
                                @endif

                                @if($permisoDePantalla->sipa_permisos_roles_borrar == true)
                                <div class="row justify-content-center mb-2">
                                    <a data-toggle="modal" data-target="#borrarModal" class="btn botonRojo borrar-btn" id="{{$insumo->sipa_insumos_id}}">
                                        <span class="glyphicon glyphicon-trash"></span> Borrar
                                    </a>
                                </div>
                                @endif

                                @if($permisoDePantalla->sipa_permisos_roles_ver == true)
                                <div class="row justify-content-center">
                                    <a  class="btn botonAzul" href="{{url('verFacturas')}}">
                                        <span class="far fa-eye"></span> Ver Facturas
                                    </a>
                                </div>
                                @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
                @else
                    <div class="alerta mb-5">
                     <i class="fas fa-exclamation-triangle"></i> No hay insumos registrados en el sistema
                    </div>
                @endif
            </table>
        </div>

        <!-- MODAL EDITAR CANTIDAD-->
        <div class="modal fade" id="editarModal" tabindex="-1" role="dialog" aria-labelledby="editarModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form method="POST" action="{{ url('/editarExistInsumos') }}" class="borrarForm"c id="editarCntInsumos" >
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title"><b>Editar Cantidad del Insumo</b></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="col-sm-12 mb-3">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadioInline1" name="customRadioInline1" value = "aumentar" class="custom-control-input" checked>
                                    <label class="custom-control-label" for="customRadioInline1">Aumentar</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadioInline2" name="customRadioInline1" value="disminuir" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadioInline2">Disminuir</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Cantidad</label>
                                <input onchange="verficarActv(this)" name ="nuevaCanti" type="number" class="form-control" placeholder="Ingrese la cantidad" required>
                            </div>
                            <div class="form-group">
                                <label>Razón</label>
                                <textarea name = "editMotivo" class="form-control" rows="5" type="text" placeholder="Ingrese la razón del cambio en la cantidad del insumo" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" id="insumoId" name="insumoId">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                            <button id="submitButton" type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
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
                    <form method="POST" action="{{ url('/borrarInsumo') }}" class="borrarForm"c id="editarRespon" >
                        @csrf
                        <input type="hidden" id="activoId" name="activoId">
                        <button type="submit" class="btn btn-primary" name= "aceptar" id="aceptar">Aceptar</button>
                    </form>
                    <form method="GET" action="{{ url ('/inventarioEquipos')}}" >
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL AGREGAR -->
        <div class="modal fade" id="agregarModal" tabindex="-1" role="dialog" aria-labelledby="agregarModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form method="POST" action="{{ url('/agregarInsumo') }}" class="borrarForm"c id="editarCntInsumos" >
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title"><b>Agregar Insumos</b></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Descripción</label>
                                <textarea name = "info_input" type="text" class="form-control" id="info_input" cols="100" placeholder="Ingrese la descripción del insumo" required></textarea>
                            </div>

                            <div class="form-group">
                                <label>Cantidad</label>
                                <input type="number" id="cantidadInsumos" class="form-control" name = "cantidaInsumo" required>
                            </div>

                            <div class="form-group">
                                <label>Costo Unitario</label>
                                <input name = "costoUnitarioInsumos" id="costoUnitario" class="form-control" type="text" placeholder="₡30,000" data-type="currency" required>
                            </div>

                            <div class="form-group">
                                <label>Costo Total</label>
                                <input name = "costoTotalInsumos" class=" form-control" id="costoTotal" type="text" placeholder="Costo Total" data-type="currency" readonly>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" id="insumoIdA" name="insumoIdA">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                            <button id="submitButton" type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

<script type="text/javascript">
$(".editar-btn").click(function(){
    var actID = this.id;
    $('#insumoId').attr('value', actID);

});

//borrar-btn
$(".borrar-btn").click(function(){
    var actID = this.id;

    $('#activoId').attr('value', actID);

});

$(".agregar-btn").click(function(){
    var actID = this.id;
    $('#insumoIdA').attr('value', actID);

});

function verficarActv(elemento) {
                            
    var accion = document.getElementsByName('customRadioInline1');
    
    if(elemento.value < 0){
        Swal.fire({
            icon: 'warning',
            title: 'Alerta',
            text: 'Debe ingresar una cantidad mayor a 0',
            timer: 6000,
            showConfirmButton: false,
            showCloseButton: true,
        });
        document.getElementById("submitButton").disabled = true;
    }else{
        document.getElementById("submitButton").disabled = false;
        if(accion[1].checked){
            console.log('Verificar Activo');
            var id = document.getElementById('insumoId');
            var url = "verificarExist/" + elemento.value + "/" + id.value;
            fetch(url).then(r => {
                return r.json();
            }).then(d => {
                console.log('Hola');
                var obj = JSON.stringify(d);
                var obj2 = JSON.parse(obj);
                console.log(obj2);
                if(obj2.existencia == "insuficientes"){
                    Swal.fire({
                        icon: 'warning',
                        title: 'Alerta',
                        text: 'No hay suficientes insumos en el sistema. La cantidad en existecia es '+ obj2.cantidad,
                        timer: 6000,
                        showConfirmButton: false,
                        showCloseButton: true,
                    });
                    document.getElementById("submitButton").disabled = true;
                }
            });
        }
    }
}

//********************** */
$("#costoUnitario").change(function(){
    let cantidad = parseInt($("#cantidadInsumos").val());
    let costo = $(this).val();

    let array = costo.split("₡");

    let costo2 = parseInt(array[1].split(",").join('').trim());
    
    $("#costoTotal").val(costo2 * cantidad).focus();
    
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

//BUSCAR INPUT

$(document).ready(function(){

  $("#insumos").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#tablaInsumos tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});

</script>


@endsection