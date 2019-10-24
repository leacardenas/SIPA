@extends('plantillas.inicio')
@section('content')

@php
$cedula = session('idUsuario');
$permisos = App\User::where('sipa_usuarios_identificacion',$cedula)->get()[0]->rol->permisos;
$user = App\User::where('sipa_usuarios_identificacion',$cedula)->get()[0];
@endphp

@foreach($permisos as $permiso)

<div id="cuadros">
    @if($permiso->modulo->sipa_opciones_menu_codigo == 'DEVOLU_SALA')
    <div class="cuadro">
        <form method="get" action="{{ url('/') }}">
            <button class="cuadrado" type="submit"><img src="imagenes/give.png"></button>
        </form>
        <p class="reservaSalas">Sala</p>
    </div>
    @endif

    @if($permiso->modulo->sipa_opciones_menu_codigo == 'DEVOLU_EQUIPO')
    <div class="cuadro">
        <form method="get" action="{{ url('/') }}">
            <button class="cuadrado" type="submit"><img src="imagenes/give.png"></button>
        </form>
        <p class="reservaEquipos">Equipo</p>
    </div>
    @endif
</div>

@endforeach

@endsection