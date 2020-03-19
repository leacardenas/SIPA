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

<div class="row col-sm-12">
    <form method="get" action="{{url('/principal')}}">
    <button type="submit" type="button" class="btn btn-secondary volver">
        <span class="glyphicon glyphicon-chevron-left"></span> Volver
    </button>
    </form>
</div>

<div class="row col-sm-12">
@foreach($permisos as $permiso)
    @if($permiso->modulo->sipa_opciones_menu_codigo == 'RESERVAR_SALA')
    <div class="cuadro col">
        <form method="get" action="{{ url('/reservarSala') }}">
            <button class="cuadrado" type="submit"><img class="menu-icons"  src="/imagenes/meeting-room.png"></button>
        </form>
        <p class="reservarSala">Sala</p>
    </div>
    @endif

    @if($permiso->modulo->sipa_opciones_menu_codigo == 'RESERVAR_EQUIPO')
    <div class="cuadro col">
        <form method="get" action="{{ url('/reservasEquipos') }}">
            <button class="cuadrado" type="submit"><img class="menu-icons"  src="imagenes/activos.png"></button>
        </form>
        <p class="reservarEquipo">Equipo</p>
    </div>
    @endif

@endforeach
</div>

@endsection