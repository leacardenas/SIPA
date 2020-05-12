@extends('plantillas.inicio')

@section('ruta')
<p id="rol" class="navbar-text navbar-center">Inventario</p>
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


<div class="row col-sm-12 justify-content-center mt-5">
@foreach($permisos as $permiso)
    @if($permiso->modulo->sipa_opciones_menu_codigo == 'INV_SALA')
    <div class="cuadro">
        <form method="get" action="{{ url('/inventarioSalasBlade') }}">
            <button class="cuadrado btn btn-lg" type="submit"><img class="menu-icons"  src="/imagenes/meeting-room.png"></button>
        </form>
        <p class="inventarioSalas">Salas</p>
    </div>
    @endif

    @if($permiso->modulo->sipa_opciones_menu_codigo == 'INV_EQUIPO')
    <div class="cuadro">
        <form method="get" action="{{ url('/inventarioEquipos') }}">
            <button class="cuadrado btn btn-lg" type="submit"><img class="menu-icons"  src="imagenes/activos.png"></button>
        </form>
        <p class="inventarioEquipos">Activos</p>
    </div>
    @endif

    @if($permiso->modulo->sipa_opciones_menu_codigo == 'INV_INSUMO')
    <div class="cuadro">
        <form method="get" action="{{ url('/inventarioInsumos') }}">
            <button class="cuadrado btn btn-lg" type="submit"><img class="menu-icons"  src="/imagenes/stationary.png"></button>
        </form>
        <p class="inventarioInsumos">Insumos</p>
    </div>
    @endif

    @if($permiso->modulo->sipa_opciones_menu_codigo == 'INV_USO_EQUIPO')
    <div class="cuadro">
        <form method="get" action="{{ url('/miInventario') }}">
            <button class="cuadrado btn btn-lg" type="submit"><img class="menu-icons"  src="/imagenes/mi-inventario.png"></button>
        </form>
        <p class="inventarioInsumos">Mi Inventario</p>
    </div>
    @endif
@endforeach
</div>

@endsection