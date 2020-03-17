@extends('plantillas.inicio')

@section('ruta')
<p id="rol" class="navbar-text navbar-center">Inventario</p>
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

@foreach($permisos as $permiso)
    @if($permiso->modulo->sipa_opciones_menu_codigo == 'INV_SALA')
    <div class="cuadro col">
        <form method="get" action="{{ url('/inventarioSalasBlade') }}">
            <button class="cuadrado" type="submit"><img class="menu-icons"  src="/imagenes/meeting-room.png"></button>
        </form>
        <p class="inventarioSalas">Salas</p>
    </div>
    @endif

    @if($permiso->modulo->sipa_opciones_menu_codigo == 'INV_EQUIPO')
    <div class="cuadro col">
        <form method="get" action="{{ url('/inventarioEquipos') }}">
            <button class="cuadrado" type="submit"><img class="menu-icons"  src="imagenes/activos.png"></button>
        </form>
        <p class="inventarioEquipos">Equipos</p>
    </div>
    @endif

    @if($permiso->modulo->sipa_opciones_menu_codigo == 'INV_INSUMO')
    <div class="cuadro col">
        <form method="get" action="{{ url('/inventarioInsumos') }}">
            <button class="cuadrado" type="submit"><img class="menu-icons"  src="/imagenes/stationary.png"></button>
        </form>
        <p class="inventarioInsumos">Insumos</p>
    </div>
    @endif
@endforeach

@endsection