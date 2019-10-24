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
            <form method="get" action="{{ url('menu/reservar') }}">
                @csrf
                <button class="cuadrado" type="submit"><img src="imagenes/process.png"></button>
            </form>
            <p class="reservar">Reservar</p>
        </div>
        @endif

        @if($permiso->modulo->sipa_opciones_menu_codigo == 'ENUSO')
        <div class="cuadro">
            <form method="get" action="{{ url('menu/inventarioEnUso') }}">
                @csrf
                <button class="cuadrado" type="submit"><img src="imagenes/process.png"></button>
            </form>
            <p class="inventario">Inventario en uso</p>
        </div>
        @endif

        @if($permiso->modulo->sipa_opciones_menu_codigo == 'HIST')
        <div class="cuadro">
            <form method="get" action="{{ url('menu/historial') }}">
                @csrf
                <button class="cuadrado" type="submit"><img src="imagenes/process.png"></button>
            </form>
            <p class="historial">Historial</p>
        </div>
        @endif

        @if($permiso->modulo->sipa_opciones_menu_codigo == 'ENTREG')
        <div class="cuadro">
            <form method="get" action="{{ url('menu/entregas') }}">
                @csrf
                <button class="cuadrado" type="submit"><img src="imagenes/process.png"></button>
            </form>
            <p class="entregas">Entregas</p>
        </div>
        @endif

        @if($permiso->modulo->sipa_opciones_menu_codigo == 'DEVOL')
        <div class="cuadro">
            <form method="get" action="{{ url('menu/devoluciones') }}">
                @csrf
                <button class="cuadrado" type="submit"><img src="imagenes/process.png"></button>
            </form>
            <p class="devoluciones">Devoluciones</p>
        </div>
        @endif

        @if($permiso->modulo->sipa_opciones_menu_codigo == 'INV')
        <div class="cuadro">
            <form method="get" action="{{ url('menu/inventario') }}">
                @csrf
                <button class="cuadrado" type="submit"><img src="imagenes/process.png"></button>
            </form>
            <p class="inventario">Inventario</p>
        </div>
        @endif

        @if($permiso->modulo->sipa_opciones_menu_codigo == 'CONFIG')
        <div class="cuadro">
            <form method="get" action="{{ url('menu/configuraciones') }}">
                @csrf
                <button class="cuadrado" type="submit"><img src="imagenes/process.png"></button>
            </form>
            <p class="configuraciones">Configuraciones</p>
        </div>
        @endif

        @if($permiso->modulo->sipa_opciones_menu_codigo == 'ACTV')
        <div class="cuadro">
            <form method="get" action="{{ url('/configurarRoles') }}">
                @csrf
                <button class="cuadrado" type="submit"><img src="imagenes/process.png"></button>
            </form>
            <p class="rol">Configurar Roles</p>
        </div>
        @endif

        @if($permiso->modulo->sipa_opciones_menu_codigo == 'ACTV')
        <div class="cuadro">
            <button class="cuadrado"><img src="imagenes/email.png"></button>
            <p class="correos">Configurar cuerpo de los correos</p>
        </div>
        @endif

        @if($permiso->modulo->sipa_opciones_menu_codigo == 'ACTV')
        <div class="cuadro">
            <button class="cuadrado"><img src="imagenes/addUser.png"></button>
            <p class="usuarios">Configurar usuarios nuevos</p>
        </div>
        @endif

        @if($permiso->modulo->sipa_opciones_menu_codigo == 'ACTV')
        <div class="cuadro">
            <button class="cuadrado"><img src="imagenes/value.png"></button>
            <p class="usuarios_tipos">Configurar tipos de usuarios</p>
        </div>
        @endif

        @if($permiso->modulo->sipa_opciones_menu_codigo == 'ACTV')
        <div class="cuadro">
            <form method="get" action="{{ url('/activos') }}">
                @csrf
                <button class="cuadrado" type="submit"><img src="imagenes/give.png"></button>
            </form>
            <p class="activos">Activos</p>
        </div>
        @endif
    </div>
</div>
</div>
@endforeach

@endsection