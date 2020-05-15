@extends('plantillas.inicio')

@section('content')
@php
$cedula = session('idUsuario');
$user = App\User::where('sipa_usuarios_identificacion',$cedula)->get()[0];
$modulo = App\Modulo::where('sipa_opciones_menu_codigo',"INV_EQUIPO")->get()[0];
$permiso = App\Permiso::where('sipa_permisos_roles_role', $user->rol->sipa_roles_id)->where('sipa_permisos_roles_opciones_menu', $modulo->sipa_opciones_menu_id)->get()[0];
@endphp

<div class="row col-sm-12">
    <form method="get" action="{{url('/inventario')}}">
    <button type="submit" type="button" class="btn btn-secondary volver">
        <span class="glyphicon glyphicon-chevron-left"></span> Volver
    </button>
    </form>
</div>

<div class="row col-sm-12">

        <div class="row justify-content-center col-sm-12">
            <h1 id="activos-registrados">Activos Registrados</h1>
        </div>
    
    <div class="row ml-2">
        <div class="col-sm-6">
            @if($permiso->sipa_permisos_roles_crear)
            <form method="get" action="{{url('/crearActivo')}}">
            <button type="submit" class="btn boton" >
                <span class="glyphicon glyphicon-plus"></span> Registrar
            </button>
            </form>
            @endif
        </div>
        <div class="col-sm-6">
            @if($permiso->sipa_permisos_roles_editar)
            <form method="GET" action="{{url('/editarActivos')}}">
            <button type="submit" class="btn boton" id="editar_activo_inv" >
                <span class="glyphicon glyphicon-edit"></span> Editar
            </button>
            </form>
            @endif
        </div>
    </div>
    
    <div class="row col-sm-12 justify-content-center">

        <div class="col-sm-12 table-responsive-sm">
            <h4>Buscar activo</h4>
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <svg class="bi bi-search" width="1em" height="1em" viewBox="0 0 16 16" fill="#00000" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 011.415 0l3.85 3.85a1 1 0 01-1.414 1.415l-3.85-3.85a1 1 0 010-1.415z" clip-rule="evenodd"/>
                        <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 100-11 5.5 5.5 0 000 11zM13 6.5a6.5 6.5 0 11-13 0 6.5 6.5 0 0113 0z" clip-rule="evenodd"/>
                    </svg>
                </span>
                <input class="form-control" id="activos" type="text" placeholder="Ingrese información del activo para buscar">
            </div>
            <br>
            <table class="table table-striped" id="table-usuarios">
                <thead>
                <tr>
                    <th scope="col" class="text-center">Código</th>
                    <th scope="col" class="text-center">Nombre</th>
                    <th scope="col" class="text-center">Estado</th>
                    <th scope="col" class="text-center">Responsable</th>
                    <th scope="col" class="text-center">Encargado</th>
                    <th scope="col" class="text-center">Acciones</th>
                </tr>
                </thead>

                <tbody class="text-center" id="tablaActivos">
                @if(count($activos) > 0)
                @foreach($activos as $activo)
                    <tr id="{{$activo->sipa_activos_id}}">
                        <th class="text-center"> {{$activo->sipa_activos_codigo}} </th>
                        <td> {{$activo->sipa_activos_nombre}} </td>
                        <td> {{$activo->sipa_activos_estado}} </td>
                        <td> {{$activo->usuarioR->sipa_usuarios_nombre}} </td>
                        <td> {{$activo->usuarioE->sipa_usuarios_nombre}} </td>
                        <td> 
                            <div class="col-sm-12">
                                <div class="row justify-content-center mb-3">
                                    @if($permiso->sipa_permisos_roles_ver)
                                        <a class="btn ver-boton botonAzul" href="{{url('verEquipos', $activo->sipa_activos_codigo)}}">
                                            <span class="far fa-eye"></span> Ver Activo
                                        </a>
                                    @endif
                                </div>
                                <div class="row justify-content-center mb-3">
                                    @if($permiso->sipa_permisos_roles_ver)
                                        <a  class="btn botonAzul" href="{{url('verBoletas', $activo->sipa_activos_id)}}">
                                            <span class="far fa-eye"></span> Ver Boletas
                                        </a>
                                    @endif
                                </div>
                                <div class="row justify-content-center">
                                    @if($permiso->sipa_permisos_roles_borrar)
                                    <a data-toggle="modal" data-target="#borrarModal" class="btn borrar-btn botonRojo" id="{{$activo->sipa_activos_id}}">
                                        <span class="glyphicon glyphicon-trash"></span> Borrar
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                
                @else
                    <div class="alerta mb-5">
                     <i class="fas fa-exclamation-triangle"></i> No hay activos registrados en el sistema
                    </div>
                @endif
            </table>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" id="borrarModal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Borrar Activo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>¿Está seguro que desea eliminar el activo?</p>
            </div>
            <div class="modal-footer">
            <form method="POST" action="{{ url('/activ') }}" class="borrarForm"c id="editarRespon" >
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


<script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js">
</script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/codigo.js') }}"></script>
@include('sweet::alert')


<!--Modals-->
<!-- @extends('activos.borrar') -->

<!--Scripts-->

<script type="text/javascript">


$(".borrar-btn").click(function(){
    var actID = this.id;

    $('#activoId').attr('value', actID);

});

// function borrarActivo() {
   
//     var url = "/activ/"+ this.id;

//     fetch(url)
//     .then(r => {
//         return r.json();
//     }).then(d => {
//         var obj = JSON.stringify(d);
//         var obj2 = JSON.parse(obj);
//         document.location.reload();
//     });
// }
// function verficarActv(elemento, elemento2) {
//     var url = "verificarAct/" + elemento.value;
//     console.log(elemento.value);
//     fetch(url).then(r => {
//         return r.json();
//     }).then(d => {
//         var obj = JSON.stringify(d);
//         var obj2 = JSON.parse(obj);
//         console.log(obj2);
//         var activo = document.getElementById('nombreActivo');
//         activo.value = obj2.nombreActivo;
        

//     });
// }
    
	// function doSomthing(json){
	// 	var obj2 = JSON.parse(json);
	// 	// var obj = JSON.stringify(d);
	// 		// var obj2 = JSON.parse(obj);
	// 	console.log(obj2);

    // }


//BUSCAR INPUT

$(document).ready(function(){

  $("#activos").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#tablaActivos tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});

</script>


@endsection