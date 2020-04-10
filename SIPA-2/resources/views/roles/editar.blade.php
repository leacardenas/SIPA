@extends('plantillas.inicio')

@section('ruta')
<p id="rol" class="navbar-text navbar-center">Configurar Roles</p>
@stop

@php
    $roles =  App\Rol::all();   
@endphp

@section('content')
{{-- @php
$cedula = session('idUsuario');
$user = App\User::where('sipa_usuarios_identificacion',$cedula)->get()[0];
$modulo = App\Modulo::where('sipa_opciones_menu_codigo',"INV_EQUIPO")->get()[0];
$permiso = App\Permiso::where('sipa_permisos_roles_role', $user->rol->sipa_roles_id)->where('sipa_permisos_roles_opciones_menu', $modulo->sipa_opciones_menu_id)->get()[0];
@endphp --}}

<div class="row col-sm-12">
    <form method="get" action="{{url('/configuracionesRoles')}}">
        <button type="submit" type="button" class="btn btn-secondary volver">
            <span class="glyphicon glyphicon-chevron-left"></span> Volver
        </button>
    </form>
</div>

<div class="row col-sm-12 justify-content-center">
    <h1 class="tituloModal">Editar Rol</h1>
</div>

<div class="row col-sm-12 justify-content-center configActivo">
    <form method="POST" action="{{ url('/editaNomRol') }}" class="configForm">
    @csrf
    <div class="form-group">
        <label for="nombreRolEditar" id="labelNombreRol">Seleccione el rol que desea editar</label>
        <select class="form-control" onchange="rolFetch(this);" id="selectEditarRol" name ="selectEditarRol"placeholder="Seleccione rol..." required>
            <option value="volvo"></option>
            @foreach($roles as $rol)
            <option value="{{$rol->sipa_roles_codigo}}">{{$rol->sipa_roles_nombre}}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label for = "nombreRol" id ="labelNomRol"> Nombre del rol </label>
        <input class="form-control" id="nuevoNombreRol" type="text"  name="nuevoNombreRol" placeholder="Ingrese el nuevo nombre del rol">
    </div>

    <div class="form-group">
        <ul id="tareasSeleccionadas">
        </ul>
    </div>

    <button type="submit" class="btn btn-primary boton-config" id="crearRolBoton"> Editar </button>
    </form>

</div>

<script>
$('.configForm').submit(function(){
    Swal.fire({
            icon: 'success',
            title: '¡Realizado con éxito!',
            text: 'La información del rol se ha editado correctamente',
            timer: 6000,
            showConfirmButton: false,
            showCloseButton: true,
            });
});
</script>
@endsection
