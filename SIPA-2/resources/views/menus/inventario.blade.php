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
    <!-- @if($permiso->modulo->sipa_opciones_menu_codigo == 'INV_SALA')
    <div class="cuadro">
        <form method="get" action="{{ url('/inventarioSalas') }}">
            <button class="cuadrado" type="submit"><img class="menu-icons" style="width: 110px;" src="/imagenes/svgs/solid/user-tag.svg"></button>
        </form>
        <p class="inventarioSalas">Salas</p>
    </div>
    @endif -->

    @if($permiso->modulo->sipa_opciones_menu_codigo == 'INV_EQUIPO')
    <div class="cuadro">
        <form method="get" action="{{ url('/inventarioEquipos') }}">
            <button class="cuadrado" type="submit"><img class="menu-icons" style="width: 110px;" src="/imagenes/svgs/solid/user-tag.svg"></button>
        </form>
        <p class="inventarioEquipos">Equipos</p>
    </div>
    @endif

    <!-- @if($permiso->modulo->sipa_opciones_menu_codigo == 'INV_INSUMO')
    <div class="cuadro">
        <form method="get" action="{{ url('/inventarioInsumos') }}">
            <button class="cuadrado" type="submit"><img class="menu-icons" style="width: 110px;" src="/imagenes/svgs/solid/user-tag.svg"></button>
        </form>
        <p class="inventarioInsumos">Insumos</p>
    </div>
    @endif -->
@endforeach
</div>

@endsection