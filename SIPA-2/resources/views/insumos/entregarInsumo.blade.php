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

$insumos = App\Insumos::all();
@endphp

    
    <div class="ml-5 mt-5">
        <h4 class="mr-3">Seleccione el funcionario al que se le hará la entrega de insumos</h4>
        <select class="form-control select2" id = "asignacionFuncionario"required>
            <option disabled selected value>Seleccione un funcionario</option>
            @foreach($usuarios as $usuario)
            <option value="{{$usuario->sipa_usuarios_id}}">
                {{$usuario->sipa_usuarios_identificacion}} - {{$usuario->sipa_usuarios_nombre}}
            </option>
            @endforeach
        </select>
    </div>
</div>

<div class="row col-sm-12 mt-5 justify-content-center">
    <h2>Insumos</h2>
</div>

<div class="row col-sm-12 ml-2 justify-content-center">
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
                <th scope="col" class="text-center">Cantidad</th>
                <th scope="col" class="text-center">Acción</th>
            </tr>
            </thead>
            @foreach($insumos as $insumo)
            <tbody class="text-center" id="tablaInsumos">
            <tr id="">
                <td data-label="Código" class="codigo"><b>{{$insumo->sipa_insumos_codigo}}</b></td>
                <td data-label="Nombre" class="nombre">{{$insumo->sipa_insumos_nombre}}</td>
                <td data-label="Cantidad"><input type="number" class="form-control cantidad" name = "cantidad" id = "cantidad" onchange="verficarActv({{$insumo->sipa_insumos_id}},this)"></td>
                <td data-label="Acción"><button class="btn agregar" id  = "{{$insumo->sipa_insumos_id}}"><span class="glyphicon glyphicon-plus"></span></button></td>
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

<div class="row col-sm-12 ml-5 mt-5">
    <h4>Observación</h4>   
    <textarea class="form-control modal-textarea" rows="5" id="observacionInsumo" type="text" name="observacionInsumo" placeholder="Este campo es opcional"></textarea>
</div>

<div class="col-sm-12 mt-5 text-center ml-5">
    <button class="btn botonLargo" type="button" name ="guardar" id="guardar">Aceptar</button>
</div>


</div>

<script>
var arrayInsumos = [];

 $("#insumosSeleccionados").on("click", "span", function(event) {
     console.log(arrayInsumos); 
     var insRemo = $(this).text();
    //console.log(insRemo);
    var activoF = insRemo.replace(" unidades","");
    var activoF2 = activoF.split(" - ");
    var filtro = activoF2[0]+" - "+activoF2[activoF2.length-1];
    console.log(filtro);
    //sconsole.log(insRemo);
    arrayInsumos = arrayInsumos.filter(elements => elements !== filtro);
    console.log(arrayInsumos); 
    $(this).parent().fadeOut(500, function() {
        $(this).remove();
    });
    event.stopPropagation();
});

$("#insumosSeleccionados").on("click", "li", function(event) {
    var insRemo = $(this).text();
    //console.log(insRemo);
    var activoF = insRemo.replace(" unidades","");
    var activoF2 = activoF.split(" - ");
    var filtro = activoF2[0]+" - "+activoF2[activoF2.length-1];
    console.log(filtro);
    //sconsole.log(insRemo);
    arrayInsumos = arrayInsumos.filter(elements => elements !== filtro);
    

    $(this).fadeOut(500, function() {
        $(this).remove();
    });
    event.stopPropagation();
});

function enLista(boton){
    let codigo = $(boton).closest("tr").find(".codigo").text();

    let bandera = false;

    $("#insumosSeleccionados li").each((id, elem) => {
        
        let split = elem.innerText.trim().split('-');

        if(split[0].trim() == codigo.trim()){
            Swal.fire({
            icon: 'error',
            title: '¡Error!',
            text: 'Ese insumo ya fue seleccionado',
            timer: 6000,
            showConfirmButton: false,
            showCloseButton: true,
            });

            bandera = true;
        }
    });

    return bandera;
}

$(".agregar").on("click", function(event) {
    event.preventDefault();

    var nombre = $(this).closest("tr").find(".nombre").text();
    var cantidad = $(this).closest("tr").find(".cantidad").val();
    var codigo = $(this).closest("tr").find(".codigo").text();

    let bandera = enLista(this);

    if(bandera == false){
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
                "<li class='insumoSeleccionado'><span class='basurero'><i class='fa fa-trash'></i>" +
                codigo + " - " + nombre + " - " + cantidad + " unidades" + "</span></li>");
            
            

            arrayInsumos[arrayInsumos.length] =  codigo + " - " + cantidad;
            console.log(arrayInsumos);
            }
    }
        
//<input name = 'nombreInsumos' class='form-control' type='text' required>
});


function verficarActv(insumo,elemento) {
    // console.log(insumo);
    // console.log(elemento);       
    // var accion = document.getElementsByName('customRadioInline1');
    
        if((parseInt(elemento.value)) > 0){
            document.getElementById(insumo).disabled = false;
        var id = document.getElementById('insumoId');
        var url = "verificarExist/" + elemento.value + "/" + insumo;
        fetch(url).then(r => {
            return r.json();
        }).then(d => {
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
                // alert('No hay suficientes insumos en el sistema. La cantidad en existecia es' + obj2.cantidad);
                document.getElementById(insumo).disabled = true;
            }else{
                document.getElementById(insumo).disabled = false;
            }
        });
    }else{
        Swal.fire({
            icon: 'warning',
            title: 'Alerta',
            text: 'Se debe ingresar un numero mayor que cero',
            timer: 6000,
            showConfirmButton: false,
            showCloseButton: true,
        });

        document.getElementById(insumo).disabled = true;
    }
    
}


$("#guardar").on("click",function(event){
    var archJson = JSON.stringify(arrayInsumos);
    var funcionario =  document.getElementById('asignacionFuncionario');
    var idFuncionario = funcionario.options[funcionario.selectedIndex].value;
    var observacion = document.getElementById('observacionInsumo').value;
    if(!observacion){
        observacion = 'Sin observaciones';
    }
    //console.log(observacion);
    if(arrayInsumos.length>0){
        if(idFuncionario){
            var url = "asignarInsumos/" + archJson + "/" + idFuncionario + "/" + observacion;
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
                        text: 'La información de la entrega de insumos se ha guardado correctamente',
                        timer: 6000,
                        showConfirmButton: false,
                        showCloseButton: true,
                        });

                    window.location.reload(true);
                }else{
                    Swal.fire({
                        icon: 'warning',
                        title: 'Alerta',
                        text: 'Algo salió mal',
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
            text: 'No seleccionó ningun funcionario',
            timer: 6000,
            showConfirmButton: false,
            showCloseButton: true,
            });
        }
    }else{
        Swal.fire({
            icon: 'warning',
            title: 'Alerta',
            text: 'No ha enviado ningun insumo',
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