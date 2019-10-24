@extends('plantillas.inicio')
@section('content')

@php
$cedula = session('idUsuario');
$permisos = App\User::where('sipa_usuarios_identificacion',$cedula)->get()[0]->rol->permisos;
$user = App\User::where('sipa_usuarios_identificacion',$cedula)->get()[0];
@endphp

<div id="cuadros">
@foreach($permisos as $permiso)
    @if($permiso->modulo->sipa_opciones_menu_codigo == 'RESERVAR')
    <div class="cuadro">
        <form method="get" action="{{ url('/reservas') }}">
            <button class="cuadrado" type="submit"><img class="menu-icons" style="width: 110px;" src="/imagenes/svgs/regular/calendar-plus.svg"></button>
        </form>
        <p class="reservar">Reservar</p>
    </div>
    @endif

    @if($permiso->modulo->sipa_opciones_menu_codigo == 'INV')
    <div class="cuadro">
        <form method="get" action="{{ url('/inventario') }}">
            <button class="cuadrado" type="submit"><img class="menu-icons" style="width: 110px;" src="/imagenes/svgs/solid/cubes.svg"></button>
        </form>
        <p class="inventario">Inventario</p>
    </div>
    @endif

    @if($permiso->modulo->sipa_opciones_menu_codigo == 'CONFIG')
    <div class="cuadro">
        <form method="get" action="{{ url('/configuraciones') }}">
            <button class="cuadrado" type="submit"><img class="menu-icons" style="width: 110px;" src="/imagenes/svgs/solid/cog.svg"></button>
        </form>
        <p class="configuraciones">Configuraciones</p>
    </div>
    @endif

@endforeach
</div>

@endsection