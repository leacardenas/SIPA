@extends('plantillas.inicio')

@section('ruta')
<p id="rol" class="navbar-text navbar-center">Reservar</p>
@stop

@section('content')

@php
    $cedula = session('idUsuario');
    $rol = App\User::where('sipa_usuarios_identificacion',$cedula)->get()[0]->rol;
    $permisoDePantalla = App\Permiso::where('sipa_permisos_roles_opcion_menu_codigo','INV_SALA')->where('sipa_permisos_roles_role',$rol->sipa_roles_id)->get()[0];
@endphp

<div class="row col-sm-12">
    <form method="get" action="{{url('/inventario')}}">
    <button type="submit" type="button" class="btn btn-secondary volver">
        <span class="glyphicon glyphicon-chevron-left"></span> Volver
    </button>
    </form>
</div>

<div class="row col-sm-12 justify-content-center mt-5">
    @if($permisoDePantalla->sipa_permisos_roles_editar == true)
        <div class="cuadro">
            <form method="get" action="{{ url('/informacionSalas') }}">
                <button class="cuadrado btn btn-lg" type="submit"><img class="menu-icons"  src="{{asset('/imagenes/room-info.png')}}"></button>
            </form>
            <p class="reservarSala mt-3">Información de salas</p>
        </div>
    @endif

    @if($permisoDePantalla->sipa_permisos_roles_editar == true)
        <div class="cuadro">
            <form method="get" action="{{ url('/registrarSala') }}">
                <button class="cuadrado btn btn-lg" type="submit"><img class="menu-icons"  src="{{asset('/imagenes/add-room.png')}}"></button>
            </form>
            <p class="reservarSala mt-3">Registrar sala</p>
        </div>
    @endif
</div>

@endsection