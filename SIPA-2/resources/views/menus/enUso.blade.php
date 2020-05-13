@extends('plantillas.inicio')
@section('content')

@php
$cedula = session('idUsuario');
$permisos = App\User::where('sipa_usuarios_identificacion',$cedula)->get()[0]->rol->permisos;
$user = App\User::where('sipa_usuarios_identificacion',$cedula)->get()[0];
@endphp

<div class="row col-sm-12">
    <form method="get" action="{{url('/inventario')}}">
    <button type="submit" type="button" class="btn btn-secondary volver">
        <span class="glyphicon glyphicon-chevron-left"></span> Volver
    </button>
    </form>
</div>

<div class="row col-sm-12 justify-content-center mt-5">
    @foreach($permisos as $permiso)
    <!-- @if($permiso->modulo->sipa_opciones_menu_codigo == 'INV_USO_SALA')
    <div class="cuadro col">
        <form method="get" action="{{ url('/inventarioEnUsoSalas') }}">
            <button class="cuadrado" type="submit"><img class="menu-icons"  src="imagenes/meeting-room.png"></button>
        </form>
        <p class="enUsoEquipo">Salas</p>
    </div>
    @endif -->

    @if($permiso->modulo->sipa_opciones_menu_codigo == 'INV_USO_EQUIPO')
    <div class="cuadro">
        <form method="get" action="{{ url('/inventarioEnUsoActivos') }}">
            <button class="cuadrado btn btn-lg" type="submit"><img class="menu-icons"  src="imagenes/activos.png"></button>
        </form>
        <p class="enUsoSalas">Activos</p>
    </div>
    @endif

    <!-- @if($permiso->modulo->sipa_opciones_menu_codigo == 'INV_USO_ASIG')
    <div class="cuadro col">
        <form method="get" action="{{ url('/inventarioEnUsoAsignaciones') }}">
            <button class="cuadrado" type="submit"><img class="menu-icons"  src="/imagenes/pc-administrator.png"></button>
        </form>
        <p class="enUsoAsignaciones">Asignaciones</p>
    </div>
    @endif -->

    @if($permiso->modulo->sipa_opciones_menu_codigo == 'INV_FORMULARIOS')
    <div class="cuadro">
        <form method="get" action="{{ url('/inventarioEnUsoFormularios') }}">
            <button class="cuadrado btn btn-lg" type="submit"><img class="menu-icons"  src="/imagenes/reporte.png"></button>
        </form>
        <p class="enUsoFormularios">Formularios</p>
    </div>
    @endif
    @endforeach
</div>
@endsection