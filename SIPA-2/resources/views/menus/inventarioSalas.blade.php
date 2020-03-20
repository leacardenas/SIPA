@extends('plantillas.inicio')

@section('ruta')
<p id="rol" class="navbar-text navbar-center">Reservar</p>
@stop

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

@foreach($permisos as $permiso)
    @if($permiso->modulo->sipa_opciones_menu_codigo == 'INV_SALA')
     <div class="cuadro col">
        <form method="get" action="{{ url('/informacionSalas') }}">
            <button class="cuadrado" type="submit"><img class="menu-icons"  src="/imagenes/room-info.png"></button>
        </form>
        <p class="reservarSala">Información de salas</p>
    </div>
    @endif

    @if($permiso->modulo->sipa_opciones_menu_codigo == 'INV_SALA')
     <div class="cuadro col">
        <form method="get" action="{{ url('/registrarSala') }}">
            <button class="cuadrado" type="submit"><img class="menu-icons"  src="/imagenes/add-room.png"></button>
        </form>
        <p class="reservarSala">Registrar sala</p>
    </div>
    @endif

@endforeach


@endsection