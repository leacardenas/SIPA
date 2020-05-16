    
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
    <!-- PARA EL FUNCIONARIO -->
    @if($permiso->modulo->sipa_opciones_menu_codigo == 'RESERVAR')
    <div class="cuadro">
        <form method="get" action="{{ url('/miHistorialActivos') }}">
            <button class="cuadrado btn btn-lg" type="submit"><img class="menu-icons"  src="imagenes/activos.png"></button>
        </form>
        <p class="historialEquipos mt-3">Mis Activos</p>
    </div>
    @endif

    @if($permiso->modulo->sipa_opciones_menu_codigo == 'RESERVAR')
    <div class="cuadro">
        <form method="get" action="{{ url('/miHistorialSalas') }}">
            <button class="cuadrado btn btn-lg" type="submit"><img class="menu-icons"  src="imagenes/meeting-room.png"></button>
        </form>
        <p class="historialSalas mt-3">Mis Salas</p>
    </div>
    @endif
    @endforeach
</div>

@endsection