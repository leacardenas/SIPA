@extends('plantillas.inicio')

@section('ruta')
<p id="rol" class="navbar-text navbar-center">Configurar Roles</p>
@stop

@section('content')
{{-- @php
$cedula = session('idUsuario');
$user = App\User::where('sipa_usuarios_identificacion',$cedula)->get()[0];
$modulo = App\Modulo::where('sipa_opciones_menu_codigo',"INV_EQUIPO")->get()[0];
$permiso = App\Permiso::where('sipa_permisos_roles_role', $user->rol->sipa_roles_id)->where('sipa_permisos_roles_opciones_menu', $modulo->sipa_opciones_menu_id)->get()[0];
@endphp --}}

<form method="get" action="{{url('/configuracionesRoles')}}">
    <button type="submit" type="button" class="btn btn-secondary">
        <span class="glyphicon glyphicon-circle-arrow-left"></span> Volver
    </button>
</form>

<div class="row">
    <h1 class="rol">Crear Rol</h1>
</div>

<form method="POST" action="{{ route('roles.store') }}">
@csrf
    <div class="form-group">
        <label for="nombreRol" id="labelNombreRol">Nombre de rol</label>
        <input class="form-control" id="inputNombreRol" type="text" name="nombreRol" placeholder="Ingrese el nombre del rol" required>
    </div>

    <div class="form-group">
        <label for="descRol" id="labelDescRol">Descripción</label>
        <input class="form-control" id="inputDescRol" type="text" placeholder="Ingrese la descripción del rol" name="descRol" required>
    </div>

    <div class="form-group">
        <label for="codigoRol" id="labelCodRol">Código</label>
        <input class="form-control" id="inputCodRol" type="text" placeholder="Ingrese el código del rol" name="codigo" required>
    </div>

    <button type="submit" class="btn btn-primary" id="crearRolBoton"> Crear </button>
</form>

@endsection