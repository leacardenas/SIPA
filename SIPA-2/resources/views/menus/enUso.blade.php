@extends('plantillas.inicio')
@section('content')

@php
$cedula = session('idUsuario');
$permisos = App\User::where('sipa_usuarios_identificacion',$cedula)->get()[0]->rol->permisos;
$user = App\User::where('sipa_usuarios_identificacion',$cedula)->get()[0];
@endphp

<div id="cuadros">
    @foreach($permisos as $permiso)
    @if($permiso->modulo->sipa_opciones_menu_codigo == 'INV_USO_SALA')
    <div class="cuadro">
        <form method="get" action="{{ url('/inventarioEnUsoSalas') }}">
            <button class="cuadrado" type="submit"><img class="menu-icons" style="width: 110px;" src="imagenes/svgs/solid/user-tag.svg"></button>
        </form>
        <p class="enUsoEquipo">Equipo</p>
    </div>
    @endif

    @if($permiso->modulo->sipa_opciones_menu_codigo == 'INV_USO_EQUIPO')
    <div class="cuadro">
        <form method="get" action="{{ url('/inventarioEnUsoEquipos') }}">
            <button class="cuadrado" type="submit"><img class="menu-icons" style="width: 110px;" src="imagenes/svgs/solid/user-tag.svg"></button>
        </form>
        <p class="enUsoSalas">Salas</p>
    </div>
    @endif

    @if($permiso->modulo->sipa_opciones_menu_codigo == 'INV_USO_ASIG')
    <div class="cuadro">
        <form method="get" action="{{ url('/inventarioEnUsoAsignaciones') }}">
            <button class="cuadrado" type="submit"><img class="menu-icons" style="width: 110px;" src="/imagenes/svgs/solid/user-tag.svg"></button>
        </form>
        <p class="enUsoAsignaciones">Asignaciones</p>
    </div>
    @endif

    @if($permiso->modulo->sipa_opciones_menu_codigo == 'INV_FORMULARIOS')
    <div class="cuadro">
        <form method="get" action="{{ url('/inventarioEnUsoFormularios') }}">
            <button class="cuadrado" type="submit"><img class="menu-icons" style="width: 110px;" src="/imagenes/svgs/solid/user-tag.svg"></button>
        </form>
        <p class="enUsoFormularios">Formularios</p>
    </div>
    @endif
    @endforeach
</div>

@endsection