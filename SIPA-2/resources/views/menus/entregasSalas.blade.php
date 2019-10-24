@extends('plantillas.inicio')
@section('content')

@php
$cedula = session('idUsuario');
$permisos = App\User::where('sipa_usuarios_identificacion',$cedula)->get()[0]->rol->permisos;
$user = App\User::where('sipa_usuarios_identificacion',$cedula)->get()[0];
@endphp

<div id="cuadros">
@foreach($permisos as $permiso)
    @if($permiso->modulo->sipa_opciones_menu_codigo == 'ENTREG_SALA_ANTICIPADA')
    <div class="cuadro">
        <form method="get" action="{{ url('/entregaSalasAnticipadas') }}">
            <button class="cuadrado" type="submit"><img class="menu-icons" style="width: 110px;" src="/imagenes/svgs/solid/user-tag.svg"></button>
        </form>
        <p class="entregasSalasAnticipadas">Reservas anticipadas</p>
    </div>
    @endif

    @if($permiso->modulo->sipa_opciones_menu_codigo == 'ENTREG_SALA_RAPIDAS')
    <div class="cuadro">
        <form method="get" action="{{ url('/entregaSalasRapidas') }}">
            <button class="cuadrado" type="submit"><img class="menu-icons" style="width: 110px;" src="/imagenes/svgs/solid/user-tag.svg"></button>
        </form>
        <p class="entregasSalasRapidas">Reservas rápidas</p>
    </div>
    @endif
@endforeach
</div>

@endsection