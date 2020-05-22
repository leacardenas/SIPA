@extends('plantillas.inicio')
@section('content')

@php
$cedula = session('idUsuario');
$permisos = App\User::where('sipa_usuarios_identificacion',$cedula)->get()[0]->rol->permisos;
$user = App\User::where('sipa_usuarios_identificacion',$cedula)->get()[0];
@endphp

<div class="row col-sm-12">
    <form method="get" action="{{url('/configReservas')}}">
    <button type="submit" type="button" class="btn btn-secondary volver">
        <span class="glyphicon glyphicon-chevron-left"></span> Volver
    </button>
    </form>
</div>

<div class="row col-sm-12 justify-content-center mt-5">

@foreach($permisos as $permiso)
    @if($permiso->sipa_permisos_roles_opcion_menu_codigo == 'ENTREG_SALA')
    <div class="cuadro">
        <form method="get" action="{{ url('/entregaSalas') }}">
            <button class="cuadrado btn btn-lg" type="submit"><img class="menu-icons"  src="{{asset('imagenes/meeting-room.png')}}"></button>
        </form>
        <p class="entregasSalas mt-3">Salas</p>
    </div>
    @endif

    @if($permiso->sipa_permisos_roles_opcion_menu_codigo == 'ENTREG_ACTIVO')
    <div class="cuadro">
        <form method="get" action="{{ url('/entregaActivos') }}">
            <button class="cuadrado btn btn-lg" type="submit"><img class="menu-icons"  src="{{asset('imagenes/activos.png')}}"></button>
        </form>
        <p class="entregasEquipos mt-3">Activos</p>
    </div>
    @endif
@endforeach
</div>

@endsection