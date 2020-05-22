@extends('plantillas.inicio')

@section('content')

@php
$cedula = session('idUsuario');
$permisos = App\User::where('sipa_usuarios_identificacion',$cedula)->get()[0]->rol->permisos;
$user = App\User::where('sipa_usuarios_identificacion',$cedula)->get()[0];
@endphp

<div class="row justify-content-center col-sm-12 mt-5">

@foreach($permisos as $permiso)
    @if($permiso->sipa_permisos_roles_opcion_menu_codigo == 'RESERVAR' && $permiso->sipa_permisos_roles_ver == true)
    <div class="cuadro">
        <form method="get" action="{{ url('/reservas') }}">
            <button class="cuadrado btn btn-lg" type="submit"><img class="menu-icons"  src="{{asset('imagenes/booking.png')}}"></button>
        </form>
        <p class="reservar mt-3">Reservar</p>
    </div>
    @endif

    @if($permiso->sipa_permisos_roles_opcion_menu_codigo == 'INV' && $permiso->sipa_permisos_roles_ver == true)
    <div class="cuadro">
        <form method="get" action="{{ url('/inventario') }}">
            <button class="cuadrado btn btn-lg" type="submit"><img class="menu-icons"  src="{{asset('imagenes/supplier.png')}}"></button>
        </form>
        <p class="inventario mt-3">Inventario</p>
    </div>
    @endif

    @if($permiso->sipa_permisos_roles_opcion_menu_codigo == 'CONFIG' && $permiso->sipa_permisos_roles_ver == true)
    <div class="cuadro  ">
        <form method="get" action="{{ url('/configuraciones') }}">
            <button class="cuadrado btn btn-lg" type="submit"><img class="menu-icons" src="{{asset('imagenes/wheel.png')}}"></button>
        </form>
        <p class="configuraciones mt-3">Configuraciones</p>
    </div>
    @endif

    @if($permiso->sipa_permisos_roles_opcion_menu_codigo == 'RESERVAS' && $permiso->sipa_permisos_roles_ver == true)
    <!-- Este menu es para que el administrador configure reservas -->
    <div class="cuadro  ">
        <form method="get" action="{{ url('/configReservas') }}">
            <button class="cuadrado btn btn-lg" type="submit"><img class="menu-icons" src="{{asset('imagenes/reservas-historial.png')}}"></button>
        </form>
        <p class="configuraciones mt-3">Reservas</p>
    </div>
    @endif

    @if($permiso->sipa_permisos_roles_opcion_menu_codigo == 'MIS_RESERVAS' && $permiso->sipa_permisos_roles_ver == true)
    <!-- Este menu es para que el funcionario vea el historial de sus reservas -->
    <div class="cuadro  ">
        <form method="get" action="{{ url('/misReservas') }}">
            <button class="cuadrado btn btn-lg" type="submit"><img class="menu-icons" src="{{asset('imagenes/mis-reservas.png')}}"></button>
        </form>
        <p class="configuraciones mt-3">Mis Reservas</p>
    </div>
    @endif

@endforeach
</div>
@endsection