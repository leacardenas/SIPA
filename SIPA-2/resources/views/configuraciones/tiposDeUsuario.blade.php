@extends('plantillas.inicio')

@section('content')
<div class="row col-sm-12">
    <form method="get" action="{{url('/configuraciones')}}">
        <button type="submit" type="button" class="btn btn-secondary volver">
            <span class="glyphicon glyphicon-chevron-left"></span> Volver
        </button>
    </form>
</div>

<div class="row justify-content-center col-sm-12">
    <h1 id="editarResponsable" class="tituloModal">Tipos de usuarios del sistema</h1>
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
                <th scope="col" class="text-center">Rol</th>
                <th scope="col" class="text-center">Acciones</th>
            </tr>
        </thead>
        @php
        $usuarios= App\User::all();
        $roles = App\Rol::all();
        $cedula = session('idUsuario');
        @endphp
        <tbody class="text-center" id="tablaUsuarios">
        @if(count($usuarios) > 0)
        @foreach($usuarios as $usuario)
            <tr>
                @if ($usuario->sipa_usuarios_identificacion !== $cedula)
                    
                    @if ($usuario->sipa_usuarios_rol)
                        <td data-label="Cédula" id='{{$usuario->sipa_usuarios_identificacion}}id' value="{{$usuario->sipa_usuarios_identificacion}}" scope="row"> <b> {{$usuario->sipa_usuarios_identificacion}} </b> </td>
                        <td data-label="Nombre"> {{$usuario->sipa_usuarios_nombre}} </td>
                        <td data-label="Rol"> {{$usuario->rol->sipa_roles_nombre }} </td>
                        <td data-label="Acciones"> 
                            <div class="row justify-content-center">
                                <form  method="get" action="{{url('/editarTipoUsuario', $usuario->sipa_usuarios_identificacion)}}">
                                    <button class="btn botonAzul">
                                        <span class="glyphicon glyphicon-edit"></span> Editar
                                    </button>
                                </form>
                            </div>
                        </td>
                    @endif
                @endif
            </tr>
            @endforeach
        </tbody>
         @else
            <div class="alerta mb-5">
                <i class="fas fa-exclamation-triangle"></i> No hay usuarios registrados en el sistema
            </div>
        @endif
        </table>
        
        
</div>

<script>
    
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
</script>
@endsection