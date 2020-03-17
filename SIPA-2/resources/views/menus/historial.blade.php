@extends('plantillas.inicio')
@section('content')

@php
$cedula = session('idUsuario');
$permisos = App\User::where('sipa_usuarios_identificacion',$cedula)->get()[0]->rol->permisos;
$user = App\User::where('sipa_usuarios_identificacion',$cedula)->get()[0];
@endphp

    @foreach($permisos as $permiso)
    @if($permiso->modulo->sipa_opciones_menu_codigo == 'HISTO_EQUIPO')
    <div class="cuadro col">
        <form method="get" action="{{ url('/historialesEquipos') }}">
            <button class="cuadrado" type="submit"><img class="menu-icons"  src="imagenes/activos.png"></button>
        </form>
        <p class="historialEquipos">Equipo</p>
    </div>
    @endif

    @if($permiso->modulo->sipa_opciones_menu_codigo == 'HISTO_SALA')
    <div class="cuadro col">
        <form method="get" action="{{ url('/historialesSalas') }}">
            <button class="cuadrado" type="submit"><img class="menu-icons"  src="imagenes/meeting-room.png"></button>
        </form>
        <p class="historialSalas">Salas</p>
    </div>
    @endif
    @endforeach

@endsection