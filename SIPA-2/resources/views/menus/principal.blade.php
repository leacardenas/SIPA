@extends('plantillas.inicio')
@section('content')

@php
$cedula = session('idUsuario');
$permisos = App\User::where('sipa_usuarios_identificacion',$cedula)->get()[0]->rol->permisos;
$user = App\User::where('sipa_usuarios_identificacion',$cedula)->get()[0];
@endphp

@foreach($permisos as $permiso)

<div id="cuadros">
@if($permiso->modulo->sipa_opciones_menu_codigo == 'RESERVAR')
    <div class="cuadro">
        <form method="get" action="{{ url('/') }}">
            <button class="cuadrado" type="submit"><img src="imagenes/give.png"></button>
        </form>
        <p class="reservar">Reservar</p>
    </div>
    @endif

    @if($permiso->modulo->sipa_opciones_menu_codigo == 'INV_USO')
    <div class="cuadro">
        <form method="get" action="{{ url('/') }}">
            <button class="cuadrado" type="submit"><img src="imagenes/give.png"></button>
        </form>
        <p class="inventarioEnUso">Inventario en uso</p>
    </div>
    @endif

    @if($permiso->modulo->sipa_opciones_menu_codigo == 'HISTO')
    <div class="cuadro">
        <form method="get" action="{{ url('/') }}">
            <button class="cuadrado" type="submit"><img src="imagenes/give.png"></button>
        </form>
        <p class="historiales">Historiales</p>
    </div>
    @endif

    @if($permiso->modulo->sipa_opciones_menu_codigo == 'ENTREG')
    <div class="cuadro">
        <form method="get" action="{{ url('/') }}">
            <button class="cuadrado" type="submit"><img src="imagenes/give.png"></button>
        </form>
        <p class="entregas">Entregas</p>
    </div>
    @endif

    @if($permiso->modulo->sipa_opciones_menu_codigo == 'DEVOLU')
    <div class="cuadro">
        <form method="get" action="{{ url('/') }}">
            <button class="cuadrado" type="submit"><img src="imagenes/give.png"></button>
        </form>
        <p class="devoluciones">Devoluciones</p>
    </div>
    @endif

    @if($permiso->modulo->sipa_opciones_menu_codigo == 'INV')
    <div class="cuadro">
        <form method="get" action="{{ url('/') }}">
            <button class="cuadrado" type="submit"><img src="imagenes/give.png"></button>
        </form>
        <p class="inventario">Inventario</p>
    </div>
    @endif

    @if($permiso->modulo->sipa_opciones_menu_codigo == 'CONFIG')
    <div class="cuadro">
        <form method="get" action="{{ url('/') }}">
            <button class="cuadrado" type="submit"><img src="imagenes/give.png"></button>
        </form>
        <p class="configuraciones">Configuraciones</p>
    </div>
    @endif


</div>

@endforeach

@endsection