@extends('plantillas.inicio')
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
    <!--@if($permiso->modulo->sipa_opciones_menu_codigo == 'RESERVAR_SALA')
    <div class="cuadro">
        <form method="get" action="{{ url('/reservasSalas') }}">
            <button class="cuadrado" type="submit"><img class="menu-icons" style="width: 110px;" src="/imagenes/svgs/regular/calendar-plus.svg"></button>
        </form>
        <p class="reservarSala">Sala</p>
    </div>
    @endif -->

    @if($permiso->modulo->sipa_opciones_menu_codigo == 'RESERVAR_EQUIPO')
    <div class="cuadro">
        <form method="get" action="{{ url('/reservasEquipos') }}">
            <button class="cuadrado" type="submit"><img class="menu-icons" style="width: 110px;" src="/imagenes/svgs/solid/user-tag.svg"></button>
        </form>
        <p class="reservarEquipo">Equipo</p>
    </div>
    @endif

@endforeach
</div>

@endsection