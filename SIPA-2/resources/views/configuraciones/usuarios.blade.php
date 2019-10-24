@extends('plantillas.inicio')

@section('content')

<div class="container">
    <h2>Usuarios Registrados</h2>
    <ul class="responsive-table">
        <li class="table-header">
            <div class="col col-1">Cedula</div>
            <div class="col col-2">Nombre</div>
            <div class="col col-4">Destinar Rol</div>
            <div class="col col-3">Acciones</div>
        </li>
        @php
        $usuarios= App\User::where('sipa_usuarios_rol',null)->get();
        $roles = App\Rol::all();
        @endphp

        <!-- @if($usuarios!==null) -->

        @foreach($usuarios as $usuario)
        <li class="table-row">
            <div class="col col-1">
                <p>{{$usuario->sipa_usuarios_identificacion}}</p>
            </div>
            <div class="col col-2">
                <p>{{$usuario->sipa_usuarios_nombre}}</p>
            </div>
            <div class="col col-4">
                <select id="selectRolRegistrar" name="selectRolRegistrar">
                    <option></option>
                    @foreach($roles as $role)
                    <option value="{{$role->sipa_roles_nombre}}">{{$role->sipa_roles_nombre}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col col-3">
                <button class="edit-modal btn btn-info">
                    <span class="glyphicon glyphicon-edit"></span> Aceptar
                </button>
            </div>
        </li>
        @endforeach
        <!-- @else
        <p>No hay roles</p>
        @endif -->
    </ul>
</div>
</div>


@endsection