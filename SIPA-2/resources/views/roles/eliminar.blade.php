@extends('plantillas.inicio')

@section('ruta')
<p id="rol" class="navbar-text navbar-center">Configurar Roles</p>
@stop

@section('content')


@php
    $roles =  App\Rol::all();   
@endphp

<div class="row col-sm-12">
    <form method="get" action="{{url('/configuracionesRoles')}}">
        <button type="submit" type="button" class="btn btn-secondary volver">
            <span class="glyphicon glyphicon-chevron-left"></span> Volver
        </button>
    </form>
</div>


<div class="row col-sm-12 justify-content-center">
    <h1 class="rol">Eliminar Rol</h1>
</div>

<div class="row col-sm-12 justify-content-center configActivo">
    <form method="POST" action="{{ url('/eliminarRol') }}" class="configForm">
    @csrf
        <div class="form-group">
            <label for="nombreRol" id="labelNombreRol">Seleccione el rol que desea eliminar</label>
            <select class="form-control" id="selectEliminarRol" name ="selectEliminarRol" placeholder="Seleccione un rol" required>
                <option></option>
                @foreach($roles as $rol)
                <option value="{{$rol->sipa_roles_codigo}}">{{$rol->sipa_roles_nombre}}</option>
                @endforeach
        </select>
        </div>

        <button type="submit" class="btn btn-primary boton-config" id="eliminarRolBoton">Eliminar</button>
    </form>
</div>

<script>
//click on x to delete toDo
    $("#tareasSeleccionadas").on("click", "span", function(event) {
        $(this).parent().fadeOut(500, function() {
            $(this).remove();
        });
        event.stopPropagation();
    });

    $("#tareasSeleccionadas").on("click", "li", function(event) {
        $(this).fadeOut(500, function() {
            $(this).remove();
        });
        event.stopPropagation();
    });

    $("#agregar").on("click", function(event) {

        event.preventDefault();

        let tarea = $('#selectTareasRol').find("option:selected").text();

        $("#tareasSeleccionadas").append(
            "<li class='tareaSeleccionada'><span><i class='fa fa-trash'></i></span>     " +
            tarea + "</li>");
    });
</script>

@endsection