@extends('plantillas.inicio')

@section('title')
Usuarios Registrados
@stop

@section('ruta')
<p id="rol" class="navbar-text navbar-center">Solicitudes de Registro</p>
@stop

@section('content')

<div class="row col-sm-12">
    <form method="get" action="{{url('/configuraciones')}}">
    <button type="submit" type="button" class="btn btn-secondary volver">
        <span class="glyphicon glyphicon-chevron-left"></span> Volver
    </button>
    </form>
</div>

<div class="row col-sm-12">
   <div class="row justify-content-center col-sm-12">
        <h1 id="usuarios-registrados">Usuarios Registrados</h1>
    </div>

    <div class="col-sm-12 table-responsive-sm">
     <h4>Buscar usuario</h4>
    <div class="input-group-prepend">
        <span class="input-group-text">
            <svg class="bi bi-search" width="1em" height="1em" viewBox="0 0 16 16" fill="#00000" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 011.415 0l3.85 3.85a1 1 0 01-1.414 1.415l-3.85-3.85a1 1 0 010-1.415z" clip-rule="evenodd"/>
                <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 100-11 5.5 5.5 0 000 11zM13 6.5a6.5 6.5 0 11-13 0 6.5 6.5 0 0113 0z" clip-rule="evenodd"/>
            </svg>
        </span>
        <input class="form-control" id="usuarios" type="text" placeholder="Ingrese información del usuario para buscar">
    </div>
    <br>
    <table class="table table-striped" id="table-usuarios">
        <thead>
            <tr>
                <th scope="col" class="text-center">Cédula</th>
                <th scope="col" class="text-center">Nombre</th>
                <th scope="col" class="text-center">Destinar Rol</th>
                <th scope="col" class="text-center">Acciones</th>
            </tr>
        </thead>

        <tbody class="text-center" id="tablaUsuarios">
        @php
        $usuarios= App\User::where('sipa_usuarios_rol',null)->get();
        $roles = App\Rol::all();
        @endphp

            @if(count($usuarios) > 0)
            @foreach($usuarios as $usuario)
            <tr>
                <td data-label="Cédula" id='{{$usuario->sipa_usuarios_identificacion}}id' value="{{$usuario->sipa_usuarios_identificacion}}" scope="row"> <b> {{$usuario->sipa_usuarios_identificacion}}</b> </td>
                <td data-label="Nombre">{{$usuario->sipa_usuarios_nombre}}</td>
                <td data-label="Destinar Rol">
                    <select  class="browser-default custom-select" id="{{$usuario->sipa_usuarios_identificacion}}" name="selectRolRegistrar">
                        <option selected>Seleccione un rol</option>
                        @foreach($roles as $role)
                        <option value="{{$role->sipa_roles_nombre}}">{{$role->sipa_roles_nombre}}</option>
                        @endforeach
                    </select>
                </td>
                <td data-label="Acciones">
                    <button onclick="actualizar({{$usuario->sipa_usuarios_identificacion}})" class="btn botonAzul">
                        <span class="glyphicon glyphicon-ok"></span> Aceptar
                    </button>
                    <button id = "{{$usuario->sipa_usuarios_id}}" onclick="eliminarU(this)" class="btn botonRojo" data-toggle="modal" data-target="#borrarModal">
                        <span class=" glyphicon glyphicon-remove "></span> Eliminar
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
        @else
            <div class="alerta mb-5">
                <i class="fas fa-exclamation-triangle"></i> No hay usuarios que hayan solicitado acceso al sistema
            </div>
        @endif
    </table>

    </div>

    <!-- MODAL ELIMINAR -->
    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" id="borrarModal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Eliminar Solicitud</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>¿Está seguro que desea eliminar esta solicitud de acceso al sistema?</p>
            </div>
            <div class="modal-footer">
            <form method="POST" action="{{ url('/eliminarUsuario') }}" class="borrarForm"c id="editarRespon" >
                @csrf
                <input type="hidden" id="usuarioId" name="usuarioId">
                <button type="submit" class="btn btn-primary" name= "aceptar" id="aceptar">Aceptar</button>
            </form>
            <form method="GET" action="{{ url ('/inventarioEquipos')}}" >
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </form>
            </div>
        </div>
    </div>
</div>

</div>

<script type='text/javascript'>

function eliminarU(elemento){
    var usuarioId = elemento.id;
    $('#usuarioId').attr('value', usuarioId);
}


function actualizar(nombre){
    var id = document.getElementById(nombre+'id').innerHTML;
    // var nombre = 'asdasd';
        console.log(id);
        var elemento = document.getElementById(id);
        console.log(elemento);
        var rolNombre = elemento.options[elemento.selectedIndex].value;
        console.log(rolNombre);
        var url = "aceptarUsuario/"+id+"/"+nombre+"/"+rolNombre;
        fetch(url).then(r => {
                console.log(r);
                return r.json();
        }).then(d => {
                var obj = JSON.stringify(d);
                var obj2 = JSON.parse(obj);
                console.log(obj2);
                document.location.reload();
        });
}



//BUSCAR INPUT

$(document).ready(function(){

  $("#usuarios").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#tablaUsuarios tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>

@endsection
