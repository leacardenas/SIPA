@extends('plantillas.inicio')
@section('content')

@php
$cedula = session('idUsuario');
$permisos = App\User::where('sipa_usuarios_identificacion',$cedula)->get()[0]->rol->permisos;
$user = App\User::where('sipa_usuarios_identificacion',$cedula)->get()[0];
@endphp

@foreach($permisos as $permiso)
    @if($permiso->modulo->sipa_opciones_menu_codigo == 'DEVOLU_SALA')
    <div class="cuadro col">
        <form method="get" action="{{ url('/devolucionesSalas') }}">
            <button class="cuadrado" type="submit"><img class="menu-icons"  src="imagenes/meeting-room.png"></button>
        </form>
        <p class="devolucionSalas">Salas</p>
    </div>
    @endif

    @if($permiso->modulo->sipa_opciones_menu_codigo == 'DEVOLU_EQUIPO')
    <div class="cuadro col">
        <form method="get" action="{{ url('/devolucionesEquipos') }}">
            <button class="cuadrado" type="submit"><img class="menu-icons"  src="imagenes/activos.png"></button>
        </form>
        <p class="devolucionEquipos">Equipos</p>
    </div>
    @endif
@endforeach

@endsection