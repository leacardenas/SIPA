@extends('plantillas.inicio')
@section('content')
@php
$cedula = session('idUsuario');
$user = App\User::where('sipa_usuarios_identificacion',$cedula)->get()[0];
$modulo = App\Modulo::where('sipa_opciones_menu_codigo',"INV_ACTIVO")->get()[0];
$activos= App\Activo::where('sipa_activos_encargado',$user->sipa_usuarios_id)->orWhere('sipa_activos_responsable',$user->sipa_usuarios_id)->get();

$rol = App\User::where('sipa_usuarios_identificacion',$cedula)->get()[0]->rol;
$permisoDePantalla = App\Permiso::where('sipa_permisos_roles_opcion_menu_codigo','MI_INV_ACTIVO')->where('sipa_permisos_roles_role',$rol->sipa_roles_id)->get()[0];
@endphp
<div class="row col-sm-12">
    <form method="get" action="{{url('/miInventario')}}">
        <button type="submit" type="button" class="btn btn-secondary volver">
            <span class="glyphicon glyphicon-chevron-left"></span> Volver
        </button>
    </form>
</div>

<div class="row justify-content-center col-sm-12">
    <h1 id="editarEstado" class="tituloModal">Mi Inventario de Activos</h1>
</div>

<div class="row col-sm-12 justify-content-center configActivo">
    <div class="col-sm-12 table-responsive-sm table-wrapper-scroll-y">
        <h4>Buscar activo</h4>
        <div class="input-group-prepend">
            <span class="input-group-text">
                <svg class="bi bi-search" width="1em" height="1em" viewBox="0 0 16 16" fill="#00000" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 011.415 0l3.85 3.85a1 1 0 01-1.414 1.415l-3.85-3.85a1 1 0 010-1.415z" clip-rule="evenodd"/>
                    <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 100-11 5.5 5.5 0 000 11zM13 6.5a6.5 6.5 0 11-13 0 6.5 6.5 0 0113 0z" clip-rule="evenodd"/>
                </svg>
            </span>
            <input class="form-control" id="activos" type="text" placeholder="Ingrese información de la reserva para buscar">
        </div>
        <br>

        <table class="table table-striped table-hover" id="table-usuarios">
            <thead>
                <tr>
                    <th scope="col" class="text-center">Placa</th>
                    <th scope="col" class="text-center">Nombre</th>
                    <th scope="col" class="text-center">Estado</th>
                    <th scope="col" class="text-center">Acción</th>
                </tr>
            </thead>

            <tbody class="text-center" id="tablaActivos">
                @foreach ($activos as $activo)
                <tr id=""> 
                    <td data-label="Placa"> <b> {{$activo->sipa_activos_codigo}} </b> </td>
                    <td data-label="Nombre"> {{$activo->sipa_activos_nombre}} </td>
                    @if ($activo->sipa_activos_encargado == $activo->sipa_activos_responsable)
                    <td data-label="Estado"> 
                        Encargado/Responsable
                    </td>  
                    @else
                        @if ($activo->sipa_activos_responsable == $user->sipa_usuarios_id)
                        <td data-label="Estado"> 
                            Responsable
                        </td>
                        @else
                        <td data-label="Estado"> 
                            Encargado
                        </td>
                        @endif
                    @endif
                    <td data-label="Acción">
                    <div class="col-sm-12">
                    @if($permisoDePantalla->sipa_permisos_roles_ver == true)
                        <div class="col-sm-6">
                                <a class="btn botonAzul" href="{{url('verEquipos', $activo->sipa_activos_codigo)}}">
                                    <span class="far fa-eye"></span> Ver Activo
                                </a>
                        </div>
                        <div class="col-sm-6">
                            <a  class="btn botonAzul" href="{{url('verMisBoletas', $activo->sipa_activos_id)}}">
                                <span class="far fa-eye"></span> Ver Boletas
                            </a>
                        </div>
                    @endif
                    </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>

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