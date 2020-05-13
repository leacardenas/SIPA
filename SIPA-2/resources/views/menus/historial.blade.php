@extends('plantillas.inicio')
@section('content')

@php
$cedula = session('idUsuario');
$permisos = App\User::where('sipa_usuarios_identificacion',$cedula)->get()[0]->rol->permisos;
$user = App\User::where('sipa_usuarios_identificacion',$cedula)->get()[0];
@endphp

<div class="row col-sm-12">
    <form method="get" action="{{url('/configReservas')}}">
    <button type="submit" type="button" class="btn btn-secondary volver">
        <span class="glyphicon glyphicon-chevron-left"></span> Volver
    </button>
    </form>
</div>

<div class="row col-sm-12 justify-content-center mt-5">

    @foreach($permisos as $permiso)
    @if($permiso->modulo->sipa_opciones_menu_codigo == 'HISTO_EQUIPO')
    <div class="cuadro">
        <form method="get" action="{{ url('/historialActivos') }}">
            <button class="cuadrado btn btn-lg" type="submit"><img class="menu-icons"  src="imagenes/activos.png"></button>
        </form>
        <p class="historialEquipos">Activos</p>
    </div>
    @endif

    @if($permiso->modulo->sipa_opciones_menu_codigo == 'HISTO_SALA')
    <div class="cuadro">
        <form method="get" action="{{ url('/historialSalas') }}">
            <button class="cuadrado btn btn-lg" type="submit"><img class="menu-icons"  src="imagenes/meeting-room.png"></button>
        </form>
        <p class="historialSalas">Salas</p>
    </div>
    @endif

    <!-- PARA EL FUNCIONARIO -->
        @if($permiso->modulo->sipa_opciones_menu_codigo == 'RESERVAR')
    <div class="cuadro">
        <form method="get" action="{{ url('/miHistorialActivos') }}">
            <button class="cuadrado btn btn-lg" type="submit"><img class="menu-icons"  src="imagenes/activos.png"></button>
        </form>
        <p class="historialEquipos">Mis Activos</p>
    </div>
    @endif

    @if($permiso->modulo->sipa_opciones_menu_codigo == 'RESERVAR')
    <div class="cuadro">
        <form method="get" action="{{ url('/miHistorialSalas') }}">
            <button class="cuadrado btn btn-lg" type="submit"><img class="menu-icons"  src="imagenes/meeting-room.png"></button>
        </form>
        <p class="historialSalas">Mis Salas</p>
    </div>
    @endif
    @endforeach
</div>

@endsection