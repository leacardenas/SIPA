@extends('plantillas.inicio')

@section('content')

@php
$cedula = session('idUsuario');
$rol = App\User::where('sipa_usuarios_identificacion',$cedula)->get()[0]->rol;
$permisoDePantalla = App\Permiso::where('sipa_permisos_roles_opcion_menu_codigo','CONFIG_ROLES')->where('sipa_permisos_roles_role',$rol->sipa_roles_id)->get()[0];
@endphp

<div class="row col-sm-12">
    <form method="get" action="{{url('/configuraciones')}}">
        <button type="submit" type="button" class="btn btn-secondary volver">
            <span class="glyphicon glyphicon-chevron-left"></span> Volver
        </button>
    </form>
</div>

<div class="row col-sm-12">

    <div class="row justify-content-center col-sm-12">
        <h1 class="tituloModal">Roles Registrados</h1>
    </div>

    @if($permisoDePantalla->sipa_permisos_roles_crear == true)
    <div class="row col-sm-12 mb-3 ml-3">
        <a type="submit" class="btn boton" href = "{{url('/crearRol')}}">
            <span class="glyphicon glyphicon-plus"></span> Crear
        </a>
    </div>
    @endif

    <div class="col-sm-12 justify-content-center">
        @php $roles = App\Rol::all(); @endphp

        <div class="col-sm-12 table-responsive-sm">
             <h4>Buscar rol</h4>
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <svg class="bi bi-search" width="1em" height="1em" viewBox="0 0 16 16" fill="#00000" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 011.415 0l3.85 3.85a1 1 0 01-1.414 1.415l-3.85-3.85a1 1 0 010-1.415z" clip-rule="evenodd"/>
                        <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 100-11 5.5 5.5 0 000 11zM13 6.5a6.5 6.5 0 11-13 0 6.5 6.5 0 0113 0z" clip-rule="evenodd"/>
                    </svg>
                </span>
                <input class="form-control" id="roles" type="text" placeholder="Ingrese información del activo para buscar">
            </div>
            <br>
            <table class="table table-striped" name="table-roles" id="table-usuarios">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">Código</th>
                        <th scope="col" class="text-center">Nombre</th>
                        <th scope="col" class="text-center">Descripción</th>
                        <th scope="col" class="text-center">Acción</th>
                    </tr>
                </thead>

                <tbody class="text-center" id="tablaRoles">
                    @foreach ($roles as $rol)
                    <tr>
                        <td data-label="Código"> <b> {{$rol->sipa_roles_codigo}} </b> </td>
                        <td data-label="Nombre"> {{$rol->sipa_roles_nombre}} </td>
                        <td data-label="Descripción"> {{$rol->sipa_roles_descripcion}} </td>
                        <td data-label="Acción">
                            <div class="col-sm-12">
                            @if($permisoDePantalla->sipa_permisos_roles_editar == true)
                                <div class="col-sm-4">
                                    <a type="submit" class="btn botonAzul" href ="{{url('editarRol',$rol->sipa_roles_id)}}">
                                        <span class="glyphicon glyphicon-edit"></span> Editar
                                    </a>
                                </div>
                            @endif

                            @if($permisoDePantalla->sipa_permisos_roles_ver == true)
                                <div class="col-sm-4">
                                    <a type="submit" class="btn botonAzul" href = "{{url('verDetallerRol',$rol->sipa_roles_id)}}'">
                                        <span class="far fa-eye"></span> Ver
                                    </a>
                                </div>
                            @endif

                            @if($permisoDePantalla->sipa_permisos_roles_borrar == true)
                                <div class="col-sm-4">
                                    <a data-toggle="modal" data-target="#borrarModal" class="btn botonRojo" id="$rol->sipa_roles_id">
                                        <span class="glyphicon glyphicon-trash"></span> Borrar
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

    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" id="borrarModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Borrar Rol</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>¿Está seguro que desea eliminar el rol?</p>
                </div>
                <div class="modal-footer">
                    <form method="POST" action="<?php echo url("/borrarRol/{$rol->sipa_roles_id}"); ?>" class="borrarForm" id="editarRespon" >
                        @csrf
                        <button type="submit" class="btn btn-primary" name= "aceptar" id="aceptar">Aceptar</button>
                    </form>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>
            </div>
        </div>
    </div>

<script>
//BUSCAR INPUT

$(document).ready(function(){

  $("#roles").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#tablaRoles tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
    @endsection