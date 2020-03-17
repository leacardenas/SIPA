@extends('plantillas.inicio')
@section('content')

@php
$cedula = session('idUsuario');
$permisos = App\User::where('sipa_usuarios_identificacion',$cedula)->get()[0]->rol->permisos;
$user = App\User::where('sipa_usuarios_identificacion',$cedula)->get()[0];
@endphp

@foreach($permisos as $permiso)
    @if($permiso->modulo->sipa_opciones_menu_codigo == 'ENTREG_EQUIPO_ANTICIPADA')
    <div class="cuadro col">
        <form method="get" action="{{ url('/entregaEquiposAnticipados') }}">
            <button class="cuadrado" type="submit"><img class="menu-icons"  src="imagenes/svgs/solid/user-tag.svg"></button>
        </form>
        <p class="entregasEquiposAnticipados">Reservas anticipadas</p>
    </div>
    @endif

    @if($permiso->modulo->sipa_opciones_menu_codigo == 'ENTREG_EQUIPO_RAPIDAS')
    <div class="cuadro col">
        <form method="get" action="{{ url('/entregaEquiposRapidos') }}">
            <button class="cuadrado" type="submit"><img class="menu-icons"  src="imagenes/svgs/solid/user-tag.svg"></button>
        </form>
        <p class="entregasEquiposRapidos">Reservas rápidas</p>
    </div>
    @endif
@endforeach

@endsection