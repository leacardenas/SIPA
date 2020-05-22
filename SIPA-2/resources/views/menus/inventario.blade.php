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
    @if($permiso->sipa_permisos_roles_opcion_menu_codigo == 'INV_SALA' && $permiso->sipa_permisos_roles_ver == true)
    <div class="cuadro">
        <form method="get" action="{{ url('/inventarioSalasBlade') }}">
            <button class="cuadrado btn btn-lg" type="submit"><img class="menu-icons"  src="{{asset('/imagenes/meeting-room.png')}}"></button>
        </form>
        <p class="inventarioSalas mt-3">Salas</p>
    </div>
    @endif

    @if($permiso->sipa_permisos_roles_opcion_menu_codigo == 'INV_ACTIVO' && $permiso->sipa_permisos_roles_ver == true)
    <div class="cuadro">
        <form method="get" action="{{ url('/inventarioEquipos') }}">
            <button class="cuadrado btn btn-lg" type="submit"><img class="menu-icons"  src="{{asset('imagenes/activos.png')}}"></button>
        </form>
        <p class="inventarioEquipos mt-3">Activos</p>
    </div>
    @endif

    @if($permiso->sipa_permisos_roles_opcion_menu_codigo == 'INV_INSUMO' && $permiso->sipa_permisos_roles_ver == true)
    <div class="cuadro">
        <form method="get" action="{{ url('/inventarioInsumos') }}">
            <button class="cuadrado btn btn-lg" type="submit"><img class="menu-icons"  src="{{asset('/imagenes/stationary.png')}}"></button>
        </form>
        <p class="inventarioInsumos mt-3">Insumos</p>
    </div>
    @endif

    @if($permiso->sipa_permisos_roles_opcion_menu_codigo == 'MI_INV' && $permiso->sipa_permisos_roles_ver == true)
    <div class="cuadro">
        <form method="get" action="{{ url('/miInventario') }}">
            <button class="cuadrado btn btn-lg" type="submit"><img class="menu-icons"  src="{{asset('/imagenes/mi-inventario.png')}}"></button>
        </form>
        <p class="inventarioInsumos mt-3">Mi Inventario</p>
    </div>
    @endif
@endforeach
</div>

@endsection