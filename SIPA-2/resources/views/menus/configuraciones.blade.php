@extends('plantillas.inicio')

@section('ruta')
<p id="rol" class="navbar-text navbar-center">Configuraciones</p>
@stop

@section('content')

@php
$cedula = session('idUsuario');
$permisos = App\User::where('sipa_usuarios_identificacion',$cedula)->get()[0]->rol->permisos;
$user = App\User::where('sipa_usuarios_identificacion',$cedula)->get()[0];
@endphp

<form method="get" action="{{url('/principal')}}">
    <button type="submit" type="button" class="btn btn-secondary">
        <span class="glyphicon glyphicon-circle-arrow-left"></span> Volver
    </button>
</form>

<div id="cuadros">
    @foreach($permisos as $permiso)
    @if($permiso->modulo->sipa_opciones_menu_codigo == 'CONFIG_ROLES')
    <div class="cuadro">
        <form method="get" action="{{ url('configuracionesRoles') }}">
            <button class="cuadrado" type="submit"><img class="menu-icons" style="width: 110px;" src="imagenes/svgs/solid/user-tag.svg"></button>
        </form>
        <p class="configuracionesRoles">Roles</p>
    </div>
    @endif

    @if($permiso->modulo->sipa_opciones_menu_codigo == 'CONFIG_USUARIOS')
    <div class="cuadro">
        <form method="get" action="{{ url('/configuracionesUsuarios') }}">
            <button class="cuadrado" type="submit"><img class="menu-icons" style="width: 110px;" src="imagenes/svgs/solid/user-tag.svg"></button>
        </form>
        <p class="configuracionesUsuarios">Usuarios</p>
    </div>
    @endif

    <!-- @if($permiso->modulo->sipa_opciones_menu_codigo == 'CONFIG_TIPO_USUARIOS')
    <div class="cuadro">
        <form method="get" action="{{ url('/configuracionesTiposUsuarios') }}">
            <button class="cuadrado" type="submit"><img class="menu-icons" style="width: 110px;" src="/imagenes/svgs/solid/user-tag.svg"></button>
        </form>
        <p class="configuracionesTiposUsuarios">Tipos de usuario</p>
    </div>
    @endif -->

    <!-- @if($permiso->modulo->sipa_opciones_menu_codigo == 'CONFIG_CORREOS')
    <div class="cuadro">
        <form method="get" action="{{ url('/configuracionesCuerposCorreo') }}">
            <button class="cuadrado" type="submit"><img class="menu-icons" style="width: 110px;" src="/imagenes/svgs/solid/user-tag.svg"></button>
        </form>
        <p class="configuracionesCorreos">Cuerpo de correos</p>
    </div>
    @endif -->
    @endforeach
</div>

@endsection