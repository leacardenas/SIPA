@php
$correos = App\CuerpoCorreo::all();
$correo1 = $correos[0];
$etiquetasString = '';
foreach ($correo1->etiquetas as $key => $value) {
    $etiquetasString =  $etiquetasString.$value->sipa_cuerpo_correos_etiquetas_etiqueta.' ';
}

// dd($etiquetasString);
$jsonCorreos= json_encode($correos,JSON_PARTIAL_OUTPUT_ON_ERROR );
// dd($jsonData);

$etiquetas0 = json_encode($correos[0]->etiquetas,JSON_PARTIAL_OUTPUT_ON_ERROR );
$etiquetas1 = json_encode($correos[1]->etiquetas,JSON_PARTIAL_OUTPUT_ON_ERROR );
$etiquetas2 = json_encode($correos[2]->etiquetas,JSON_PARTIAL_OUTPUT_ON_ERROR );
$etiquetas3 = json_encode($correos[3]->etiquetas,JSON_PARTIAL_OUTPUT_ON_ERROR );
$etiquetas4 = json_encode($correos[4]->etiquetas,JSON_PARTIAL_OUTPUT_ON_ERROR );
$etiquetas5 = json_encode($correos[5]->etiquetas,JSON_PARTIAL_OUTPUT_ON_ERROR );

$cedula = session('idUsuario');
$rol = App\User::where('sipa_usuarios_identificacion',$cedula)->get()[0]->rol;
$permisoDePantalla = App\Permiso::where('sipa_permisos_roles_opcion_menu_codigo','CONFIG_CORREOS')->where('sipa_permisos_roles_role',$rol->sipa_roles_id)->get()[0];

@endphp

@extends('plantillas.inicio')

@section('content')
<p id="e0" hidden>{{$etiquetasString}}</p>
<p id="e1" hidden>{{$etiquetas1}}</p>
<p id="e2" hidden>{{$etiquetas2}}</p>
<p id="e3" hidden>{{$etiquetas3}}</p>
<p id="e4" hidden>{{$etiquetas4}}</p>
<p id="e5" hidden>{{$etiquetas5}}</p>
<p id="e6" hidden>{{$jsonCorreos}}</p>

<div class="row col-sm-12">
    <form method="get" action="{{url('/configuraciones')}}">
        <button type="submit" type="button" class="btn btn-secondary volver">
            <span class="glyphicon glyphicon-chevron-left"></span> Volver
        </button>
    </form>
</div>

<div class="row justify-content-center col-sm-12">
    <h1 id="editarEncargado" class="tituloModal">Configurar Cuerpo de Correos</h1>
</div>

<div class="row col-sm-12 justify-content-center configActivo">
    <div class="row col-sm-12">
        <label for="nombreActivo" id="labelNombreActivo">Seleccione el nombre del cuerpo de correo</label>
        <select class="form-control" id="selectCuerpo" name="selectActivoBaja" onchange="actualizarForm();">
            @foreach ($correos as $correo)
                <option id="{{$correo->sipa_cuerpo_correos_id}}">{{$correo->sipa_cuerpo_correos_nombre}}</option>
            @endforeach
        </select>
    </div>
    <div class="row col-sm-12 mt-4">
        <label for="nombreActivo" id="labelNombreActivo">Ingrese el nombre del correo</label>
        <input class="form-control" id="nombreCorreo" type="text" name="nombre" value="{{$correo1->sipa_cuerpo_correos_nombre}}" required>
    </div>
    <div class="row col-sm-12 mt-4">
        <label for="nombreActivo" id="labelNombreActivo">Ingrese el asunto del correo</label>
        <input class="form-control" id="asuntoCorreo" type="text" name="asunto" value="{{$correo1->sipa_cuerpo_correo_asunto}}" required>
    </div>
    <div class="row col-sm-12 mt-4">
        <div class="col-sm-8">
            <label for="nombreActivo" id="labelNombreActivo">Ingrese el cuerpo del correo</label>
            <textarea class="form-control" rows="10" cols="95" name="razonBajaActivo" id="cuerpoCorreo" required>{{$correo1->sipa_cuerpo_correos_cuerpo}}</textarea>
        </div>
        <div class="col-sm-4">
            <label for="nombreActivo" id="labelNombreActivo">Etiquetas para el cuerpo del correo</label>
            <textarea class="form-control" rows="10" id="etiquetasCorreo" value="" readonly>{{$etiquetasString}}</textarea>
            <small><b>Debe</b> usar estas etiquetas para el cuerpo del correo</small>
        </div>
    </div>
    <div class="row col-sm-12 mt-5">
    @if($permisoDePantalla->sipa_permisos_roles_editar == true)
        <button type="submit" class="btn botonLargo" id="guardar" onclick="save();"> Guardar </button>
    @endif
    </div>
</div>


<script>
    function actualizarForm(){
        var selecSalas = document.getElementById("selectCuerpo");
        var selected = selecSalas.options[selecSalas.selectedIndex].id;
        // console.log(selected);
        var cuerposJson = document.getElementById("e6").innerHTML;
        var cuerpos = JSON.parse(cuerposJson);
        // console.log(cuerpos);

        var nombreCorreo = document.getElementById("nombreCorreo");//value
        var asuntoCorreo = document.getElementById("asuntoCorreo");//value
        var cuerpoCorreo = document.getElementById("cuerpoCorreo");//innerHTML
        var etiquetasCorreo = document.getElementById("etiquetasCorreo");//innerHTML

        for(var i = 0; i < cuerpos.length; i++){
           // console.log(cuerpos[i].sipa_cuerpo_correos_id+' vs '+selected);
            if(cuerpos[i].sipa_cuerpo_correos_id==selected){
                //console.log('entro');
                nombreCorreo.value = cuerpos[i].sipa_cuerpo_correos_nombre;
                asuntoCorreo.value = cuerpos[i].sipa_cuerpo_correo_asunto;
                cuerpoCorreo.innerHTML = cuerpos[i].sipa_cuerpo_correos_cuerpo;
                var num =  i;
                idEt= "e"+ num;
                //console.log(idEt);
                var etiquetas = document.getElementById(idEt).innerHTML;
                var etiquetas = JSON.parse(etiquetas);
                //console.log(etiquetas);

                var etiquetasString = '';
                for(var x = 0; x < etiquetas.length; x++) {
                   // console.log(etiquetas[x]);
                    etiquetasString =  etiquetasString + etiquetas[x].sipa_cuerpo_correos_etiquetas_etiqueta+' ';
                }   

                etiquetasCorreo.innerHTML = etiquetasString;
            }
        
        }

    }

    function save(){
        console.log("entre a save");

        var selecSalas = document.getElementById("selectCuerpo");

        var selected = selecSalas.options[selecSalas.selectedIndex].id;
        var nombreCorreo = document.getElementById("nombreCorreo").value;//value
        var asuntoCorreo = document.getElementById("asuntoCorreo").value;//value
        var cuerpoCorreo = document.getElementById("cuerpoCorreo").innerHTML;//innerHTML
        
        var url = "editarCuerpoCorreo/"+selected+"/"+nombreCorreo+"/"+asuntoCorreo+"/"+cuerpoCorreo;
        console.log(url);
        fetch(url).then(r => {
                return r.json();
            }).then(d => {
                var obj = JSON.stringify(d);
                var obj2 = JSON.parse(obj);
                console.log(obj2);
                Swal.fire({
                    icon: 'success',
                    title: '¡Correo editado con exito!',
                    timer: 6000,
                    showConfirmButton: false,
                    showCloseButton: true,
                    });

                // window.location.href = "/reservas";
            }); 

    }
// $("#etiquetas").on("keydown",function(){
//     event.preventDefault();
// });


$(document).ready(function() {
    $('.select2').select2();
});
</script>
@endsection