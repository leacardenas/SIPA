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
    <input class="form-control mb-4" id="usuarios" type="text" placeholder="Ingrese información del usuario para buscar">
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
        @foreach($usuarios as $usuario)
            <tr>
                @if ($usuario->sipa_usuarios_identificacion !== $cedula)
                    
                    @if ($usuario->sipa_usuarios_rol)
                        <th class="text-center" id='{{$usuario->sipa_usuarios_identificacion}}id' value="{{$usuario->sipa_usuarios_identificacion}}" scope="row"> {{$usuario->sipa_usuarios_identificacion}} </th>
                        <td> {{$usuario->sipa_usuarios_nombre}} </td>
                        <td> {{$usuario->rol->sipa_roles_nombre }} </td>
                        <td> 
                        <div class="row justify-content-center">
                            <form  method="get" action="{{url('/editarTipoUsuario', $usuario->sipa_usuarios_identificacion)}}">
                                <button class="btn btn-primary ver-btn">
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