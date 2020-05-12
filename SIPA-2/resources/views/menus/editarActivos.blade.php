@extends('plantillas.inicio')

@section('content')

@php
$cedula = session('idUsuario');
$permisos = App\User::where('sipa_usuarios_identificacion',$cedula)->get()[0]->rol->permisos;
$user = App\User::where('sipa_usuarios_identificacion',$cedula)->get()[0];
@endphp

<div class="row col-sm-12">
    <form method="get" action="{{url('/configuraciones')}}">
    <button type="submit" type="button" class="btn btn-secondary volver">
        <span class="glyphicon glyphicon-chevron-left"></span> Volver
    </button>
    </form>
</div>


<div class="row col-sm-12">
    @foreach($permisos as $permiso)
    @if($permiso->modulo->sipa_opciones_menu_codigo == 'CONFIG_ROLES')
    <div class="cuadro col">
        <form method="get" action="{{ url('editarResponsable') }}">
            <button class="cuadrado" type="submit"><img class="menu-icons" src="imagenes/man-in-office-desk-with-computer.png"></button>
        </form>
        <p class="editRespActivo">Editar Responsable de Activo</p>
    </div>
    @endif

    @if($permiso->modulo->sipa_opciones_menu_codigo == 'CONFIG_ROLES')
    <div class="cuadro col">
        <form method="get" action="{{ url('editarEncargado') }}">
            <button class="cuadrado" type="submit"><img class="menu-icons" src="imagenes/pc-administrator.png"></button>
        </form>
        <p class="editEncActivo">Editar Encargado de Activo</p>
    </div>
    @endif

    @if($permiso->modulo->sipa_opciones_menu_codigo == 'CONFIG')
    <div class="cuadro col">
        <form method="get" action="{{ url('editarEstado') }}">
            <button class="cuadrado" type="submit"><img class="menu-icons" src="imagenes/broken-laptop.png"></button>
        </form>
        <p class="editEstActivo">Editar Estado de Activo</p>
    </div>
    @endif

    @if($permiso->modulo->sipa_opciones_menu_codigo == 'CONFIG')
    <div class="cuadro col">
        <form method="get" action="{{ url('editarUbicacion') }}">
            <button class="cuadrado" type="submit"><img class="menu-icons" src="imagenes/placeholder.png"></button>
        </form>
        <p class="editEstActivo">Editar Ubicación de Activo</p>
    </div>
    @endif

    @if($permiso->modulo->sipa_opciones_menu_codigo == 'CONFIG')
    <div class="cuadro col">
        <form method="get" action="{{ url('trasladoMasivo') }}">
            <button class="cuadrado" type="submit"><img class="menu-icons" src="imagenes/exchange.png"></button>
        </form>
        <p class="editEstActivo">Traslado Masivo de Activo</p>
    </div>
    @endif

    @if($permiso->modulo->sipa_opciones_menu_codigo == 'CONFIG')
    <div class="cuadro col">
        <form method="get" action="{{ url('darBajaActivo') }}">
            <button class="cuadrado" type="submit"><img class="menu-icons" src="imagenes/storage-box.png"></button>
        </form>
        <p class="editEstActivo">Dar de Baja un Activo</p>
    </div>
    @endif

    @if($permiso->modulo->sipa_opciones_menu_codigo == 'CONFIG')
    <div class="cuadro col">
        <form method="get" action="{{ url('activosBaja') }}">
            <button class="cuadrado" type="submit"><img class="menu-icons" src="imagenes/storage-box.png"></button>
        </form>
        <p class="editEstActivo">Ver Activos dados de baja</p>
    </div>
    @endif
    @endforeach
</div>

@endsection