@extends('plantillas.inicio')

@section('content')

@php
$cedula = session('idUsuario');
$permisos = App\User::where('sipa_usuarios_identificacion',$cedula)->get()[0]->rol->permisos;
$user = App\User::where('sipa_usuarios_identificacion',$cedula)->get()[0];
@endphp

<div class="row justify-content-center col-sm-12 mt-5">

@foreach($permisos as $permiso)
    @if($permiso->modulo->sipa_opciones_menu_codigo == 'RESERVAR')
    <div class="cuadro">
        <form method="get" action="{{ url('/reservas') }}">
            <button class="cuadrado btn btn-lg" type="submit"><img class="menu-icons"  src="imagenes/booking.png"></button>
        </form>
        <p class="reservar mt-3">Reservar</p>
    </div>
    @endif

    @if($permiso->modulo->sipa_opciones_menu_codigo == 'INV')
    <div class="cuadro">
        <form method="get" action="{{ url('/inventario') }}">
            <button class="cuadrado btn btn-lg" type="submit"><img class="menu-icons"  src="imagenes/supplier.png"></button>
        </form>
        <p class="inventario mt-3">Inventario</p>
    </div>
    @endif

    @if($permiso->modulo->sipa_opciones_menu_codigo == 'CONFIG')
    <div class="cuadro  ">
        <form method="get" action="{{ url('/configuraciones') }}">
            <button class="cuadrado btn btn-lg" type="submit"><img class="menu-icons" src="imagenes/wheel.png"></button>
        </form>
        <p class="configuraciones mt-3">Configuraciones</p>
    </div>
    @endif

    @if($permiso->modulo->sipa_opciones_menu_codigo == 'CONFIG')
    <!-- Este menu es para que el administrador configure reservas -->
    <div class="cuadro  ">
        <form method="get" action="{{ url('/configReservas') }}">
            <button class="cuadrado btn btn-lg" type="submit"><img class="menu-icons" src="imagenes/reservas-historial.png"></button>
        </form>
        <p class="configuraciones mt-3">Reservas</p>
    </div>
    @endif

    @if($permiso->modulo->sipa_opciones_menu_codigo == 'RESERVAR')
    <!-- Este menu es para que el funcionario vea el historial de sus reservas -->
    <div class="cuadro  ">
        <form method="get" action="{{ url('/misReservas/principal') }}">
            <button class="cuadrado btn btn-lg" type="submit"><img class="menu-icons" src="imagenes/mis-reservas.png"></button>
        </form>
        <p class="configuraciones mt-3">Mis Reservas</p>
    </div>
    @endif

@endforeach
</div>
@endsection