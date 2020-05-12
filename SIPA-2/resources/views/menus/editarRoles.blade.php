@extends('plantillas.inicio')

@section('ruta')
<p id="rol" class="navbar-text navbar-center">Roles</p>
@stop

@section('content')

@php
$cedula = session('idUsuario');
$permisos = App\User::where('sipa_usuarios_identificacion',$cedula)->get()[0]->rol->permisos;
$user = App\User::where('sipa_usuarios_identificacion',$cedula)->get()[0];
@endphp

<div class="row col-sm-12">
    <form method="get" action="{{url('/configuraciones')}}">
    <button type="submit" type="button" class="btn btn-secondary volver">
        <span class="glyphicon glyphicon-chevron-left"></span> Volver
    </button>
    </form>
</div>

<div class="row col-sm-12 justify-content-center mt-5">
<div class="cuadro">
    <form method="get" action="{{ url('crearRol') }}">
        <button class="cuadrado btn btn-lg" type="submit"><img class="menu-icons" src="imagenes/resume.png"></button>
    </form>
    <p class="inventario">Crear Rol</p>
</div>

<div class="cuadro">
    <form method="get" action="{{ url('/roles') }}">
        <button class="cuadrado btn btn-lg" type="submit"><img class="menu-icons" src="imagenes/view-files.png"></button>
    </form>
    <p class="inventario">Ver Roles</p>
</div>
@php
$roles = App\Rol::all(); 
@endphp
<script>
function rolFetch(elemento){
    var opcion = elemento.value;
    console.log(opcion);
}
</script>

<div class="cuadro">
    <form method="get" action="{{ url('editarRol') }}">
        <button class="cuadrado btn btn-lg" type="submit"><img class="menu-icons" src="imagenes/content.png"></button>
    </form>
    <p class="inventario">Editar Rol</p>
</div>

<div class="cuadro">
    <form method="get" action="{{ url('eliminarRol') }}">
        <button class="cuadrado btn btn-lg" type="submit"><img class="menu-icons" src="imagenes/delete.png"></button>
    </form>
    <p class="inventario">Eliminar Rol</p>
</div>
</div>

@endsection