@extends('plantillas.inicio')

@section('ruta')
<p id="rol" class="navbar-text navbar-center">Reservar</p>
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
    @if($permiso->modulo->sipa_opciones_menu_codigo == 'INV_SALA')
     <div class="cuadro">
        <form method="get" action="{{ url('/informacionSalas') }}">
            <button class="cuadrado" type="submit"><img class="menu-icons" style="width: 110px;" src="/imagenes/room-info.png"></button>
        </form>
        <p class="reservarSala">Información de salas</p>
    </div>
    @endif

    @if($permiso->modulo->sipa_opciones_menu_codigo == 'INV_SALA')
     <div class="cuadro">
        <form method="get" action="{{ url('/registrarSala') }}">
            <button class="cuadrado" type="submit"><img class="menu-icons" style="width: 110px;" src="/imagenes/add-room.png"></button>
        </form>
        <p class="reservarSala">Registrar sala</p>
    </div>
    @endif



</div>