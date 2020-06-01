@extends('plantillas.inicio')

@section('content')

@php
$cedula = session('idUsuario');
$rol = App\User::where('sipa_usuarios_identificacion',$cedula)->get()[0]->rol;
$permisoDePantalla = App\Permiso::where('sipa_permisos_roles_opcion_menu_codigo','INV_ACTIVO')->where('sipa_permisos_roles_role',$rol->sipa_roles_id)->get()[0];
@endphp

<div class="row col-sm-12">
    <form method="get" action="{{url('/configuraciones')}}">
    <button type="submit" type="button" class="btn btn-secondary volver">
        <span class="glyphicon glyphicon-chevron-left"></span> Volver
    </button>
    </form>
</div>


<div class="row col-sm-12 justify-content-center mt-5">
    @if($permisoDePantalla->sipa_permisos_roles_editar == true)
    <div class="cuadro">
        <form method="get" action="{{ url('editarResponsable') }}">
            <button class="cuadrado btn btn-lg" type="submit"><img class="menu-icons" src="{{asset('imagenes/man-in-office-desk-with-computer.png')}}"></button>
        </form>
        <p class="editRespActivo mt-3">Editar Responsable de Activo</p>
    </div>

    <div class="cuadro">
        <form method="get" action="{{ url('editarEncargado') }}">
            <button class="cuadrado btn btn-lg" type="submit"><img class="menu-icons" src="{{asset('imagenes/pc-administrator.png')}}"></button>
        </form>
        <p class="editEncActivo mt-3">Editar Encargado de Activo</p>
    </div>

    <div class="cuadro">
        <form method="get" action="{{ url('editarEstado') }}">
            <button class="cuadrado btn btn-lg" type="submit"><img class="menu-icons" src="{{asset('imagenes/broken-laptop.png')}}"></button>
        </form>
        <p class="editEstActivo mt-3">Editar Estado de Activo</p>
    </div>

    <div class="cuadro">
        <form method="get" action="{{ url('editarUbicacion') }}">
            <button class="cuadrado btn btn-lg" type="submit"><img class="menu-icons" src="{{asset('imagenes/placeholder.png')}}"></button>
        </form>
        <p class="editEstActivo mt-3">Editar Ubicación de Activo</p>
    </div>

    <div class="cuadro">
        <form method="get" action="{{ url('trasladoMasivo') }}">
            <button class="cuadrado btn btn-lg" type="submit"><img class="menu-icons" src="{{asset('imagenes/exchange.png')}}"></button>
        </form>
        <p class="editEstActivo mt-3">Traslado Masivo de Activo</p>
    </div>

    <div class="cuadro">
        <form method="get" action="{{ url('darBajaActivo') }}">
            <button class="cuadrado btn btn-lg" type="submit"><img class="menu-icons" src="{{asset('imagenes/storage-box.png')}}"></button>
        </form>
        <p class="editEstActivo mt-3">Dar de Baja un Activo</p>
    </div>

    <div class="cuadro">
        <form method="get" action="{{ url('activosBaja') }}">
            <button class="cuadrado btn btn-lg" type="submit"><img class="menu-icons" src="{{asset('imagenes/ver-baja.png')}}"></button>
        </form>
        <p class="editEstActivo mt-3">Ver Activos dados de baja</p>
    </div>

    <div class="cuadro">
        <form method="get" action="{{ url('editarTipo') }}">
            <button class="cuadrado btn btn-lg" type="submit"><img class="menu-icons" src="{{asset('imagenes/activos.png')}}"></button>
        </form>
        <p class="editEstActivo mt-3">Editar Tipo de Activo</p>
    </div>
    @endif
</div>

@endsection