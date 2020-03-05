@extends('plantillas.inicio')
@section('content')

@php
$cedula = session('idUsuario');
$permisos = App\User::where('sipa_usuarios_identificacion',$cedula)->get()[0]->rol->permisos;
$user = App\User::where('sipa_usuarios_identificacion',$cedula)->get()[0];
@endphp

<div id="cuadros">
@foreach($permisos as $permiso)
    @if($permiso->modulo->sipa_opciones_menu_codigo == 'DEVOLU_SALA')
    <div class="cuadro">
        <form method="get" action="{{ url('/devolucionesSalas') }}">
            <button class="cuadrado" type="submit"><img class="menu-icons" style="width: 110px;" src="imagenes/meeting-room.png"></button>
        </form>
        <p class="devolucionSalas">Salas</p>
    </div>
    @endif

    @if($permiso->modulo->sipa_opciones_menu_codigo == 'DEVOLU_EQUIPO')
    <div class="cuadro">
        <form method="get" action="{{ url('/devolucionesEquipos') }}">
            <button class="cuadrado" type="submit"><img class="menu-icons" style="width: 110px;" src="imagenes/activos.png"></button>
        </form>
        <p class="devolucionEquipos">Equipos</p>
    </div>
    @endif
@endforeach
</div>

@endsection