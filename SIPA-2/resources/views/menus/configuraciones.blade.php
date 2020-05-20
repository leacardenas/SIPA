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

<div class="row col-sm-12">
    <form method="get" action="{{url('/principal')}}">
    <button type="submit" type="button" class="btn btn-secondary volver">
        <span class="glyphicon glyphicon-chevron-left"></span> Volver
    </button>
    </form>
</div>

<div class="row col-sm-12 justify-content-center mt-5">

    @foreach($permisos as $permiso)
    @if($permiso->modulo->sipa_opciones_menu_codigo == 'CONFIG')
    <div class="cuadro">
        <form method="get" action="{{ url('configuracionesRoles') }}">
            <button class="cuadrado btn btn-lg" type="submit"><img class="menu-icons" src="{{asset('imagenes/identification.png')}}"></button>
        </form>
        <p class="configuracionesRoles mt-3">Roles</p>
    </div>
    @endif

    @if($permiso->modulo->sipa_opciones_menu_codigo == 'CONFIG')
    <div class="cuadro">
        <form method="get" action="{{ url('/configuracionesUsuarios') }}">
            <button class="cuadrado btn btn-lg" type="submit"><img class="menu-icons" src="{{asset('imagenes/value.png')}}"></button>
        </form>
        <p class="configuracionesUsuarios mt-3">Usuarios</p>
    </div>
    @endif

    @if($permiso->modulo->sipa_opciones_menu_codigo == 'CONFIG')
    <div class="cuadro">
        <form method="get" action="{{ url('/configuracionesTiposUsuarios') }}">
            <button class="cuadrado btn btn-lg" type="submit"><img class="menu-icons" src="{{asset('/imagenes/group.png')}}"></button>
        </form>
        <p class="configuracionesTiposUsuarios mt-3">Tipos de usuario</p>
    </div>
    @endif

    @if($permiso->modulo->sipa_opciones_menu_codigo == 'CONFIG')
    <div class="cuadro">
        <form method="get" action="{{ url('/configuracionesCuerposCorreo') }}">
            <button class="cuadrado btn btn-lg" type="submit"><img class="menu-icons" src="{{asset('/imagenes/email.png')}}"></button>
        </form>
        <p class="configuracionesCorreos mt-3">Cuerpo de correos</p>
    </div>
    @endif

    @if($permiso->modulo->sipa_opciones_menu_codigo == 'CONFIG')
    <div class="cuadro">
        <form method="get" action="{{ url('/configuracionesActivos') }}">
            <button class="cuadrado btn btn-lg" type="submit"><img class="menu-icons" src="{{asset('/imagenes/activos.png')}}"></button>
        </form>
        <p class="configuracionesCorreos mt-3">Activos</p>
    </div>
    @endif

    @if($permiso->modulo->sipa_opciones_menu_codigo == 'CONFIG')
    <div class="cuadro">
        <form method="get" action="{{ url('/configuracionesSalas') }}">
            <button class="cuadrado btn btn-lg" type="submit"><img class="menu-icons" src="{{asset('/imagenes/meeting-room.png')}}"></button>
        </form>
        <p class="configuracionesCorreos mt-3">Salas</p>
    </div>
    @endif
    @endforeach
</div>

@endsection