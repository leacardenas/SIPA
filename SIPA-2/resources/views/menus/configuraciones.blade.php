@extends('plantillas.inicio')
@section('content')

@php
$cedula = session('idUsuario');
$permisos = App\User::where('sipa_usuarios_identificacion',$cedula)->get()[0]->rol->permisos;
$user = App\User::where('sipa_usuarios_identificacion',$cedula)->get()[0];
@endphp

@foreach($permisos as $permiso)

<div id="cuadros">
    @if($permiso->modulo->sipa_opciones_menu_codigo == 'CONFIG_ROLES')
    <div class="cuadro">
        <form method="get" action="{{ url('/') }}">
            <button class="cuadrado" type="submit"><img src="imagenes/give.png"></button>
        </form>
        <p class="configRoles">Roles</p>
    </div>
    @endif

    @if($permiso->modulo->sipa_opciones_menu_codigo == 'CONFIG_USUARIOS')
    <div class="cuadro">
        <form method="get" action="{{ url('/') }}">
            <button class="cuadrado" type="submit"><img src="imagenes/give.png"></button>
        </form>
        <p class="configUsuario">Usuarios</p>
    </div>
    @endif

    @if($permiso->modulo->sipa_opciones_menu_codigo == 'CONFIG_TIPO_USUARIOS')
    <div class="cuadro">
        <form method="get" action="{{ url('/') }}">
            <button class="cuadrado" type="submit"><img src="imagenes/give.png"></button>
        </form>
        <p class="configTipoUsuario">Tipo de usuarios</p>
    </div>
    @endif

    @if($permiso->modulo->sipa_opciones_menu_codigo == 'CONFIG_CORREOS')
    <div class="cuadro">
        <form method="get" action="{{ url('/') }}">
            <button class="cuadrado" type="submit"><img src="imagenes/give.png"></button>
        </form>
        <p class="configCorreos">Cuerpo de correos</p>
    </div>
    @endif
</div>

@endforeach

@endsection