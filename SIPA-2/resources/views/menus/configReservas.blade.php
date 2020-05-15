@extends('plantillas.inicio')
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

<div class="row col-sm-12 justify-content-center mt-5">

@foreach($permisos as $permiso)
    @if($permiso->modulo->sipa_opciones_menu_codigo == 'DEVOLU')
    <div class="cuadro">
        <form method="get" action="{{ url('/devoluciones') }}">
            <button class="cuadrado btn btn-lg" type="submit"><img class="menu-icons"  src="imagenes/return.png"></button>
        </form>
        <p class="devolucionSalas mt-3">Devoluciones</p>
    </div>
    @endif

    @if($permiso->modulo->sipa_opciones_menu_codigo == 'ENTREG')
    <div class="cuadro">
        <form method="get" action="{{ url('/entregas') }}">
            <button class="cuadrado btn btn-lg" type="submit"><img class="menu-icons"  src="imagenes/badge.png"></button>
        </form>
        <p class="devolucionEquipos mt-3">Entregas</p>
    </div>
    @endif

    @if($permiso->modulo->sipa_opciones_menu_codigo == 'HISTO')
    <div class="cuadro">
        <form method="get" action="{{ url('/historialReservas/admin') }}">
            <button class="cuadrado btn btn-lg" type="submit"><img class="menu-icons"  src="imagenes/date.png"></button>
        </form>
        <p class="devolucionEquipos mt-3">Historial de Reservas</p>
    </div>
    @endif
@endforeach
</div>

@endsection