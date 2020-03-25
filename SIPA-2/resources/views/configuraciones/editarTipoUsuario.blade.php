@extends('plantillas.inicio')

@section('content')
<div class="row col-sm-12">
    <form method="get" action="{{url('/configuraciones')}}">
        <button type="submit" type="button" class="btn btn-secondary volver">
            <span class="glyphicon glyphicon-chevron-left"></span> Volver
        </button>
    </form>
</div>

@php
$usuarios= App\User::where('sipa_usuarios_identificacion',$id)->get(); 
$roles = App\Rol::all();
@endphp

<div class="row justify-content-center col-sm-12">
@foreach($usuarios as $usuario)
    <h1 id="editarResponsable" class="tituloModal">Editar usuario <b> {{$usuario->sipa_usuarios_nombre}} </b></h1>
</div>

<div class="row col-sm-12  justify-content-center configActivo">
    <form method="POST" action="{{ url('/editTipoUse') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <input id="userCedula" name="userCedula" type="hidden" value={{$usuario->sipa_usuarios_identificacion}}>
            <label for="nombreActivo" id="labelNombreActivo">Seleccione el nuevo rol del usuario </label>
            <select class="form-control" name = "selectNuevoTipoUsu">
                <option selected>Seleccione un rol</option>
                @foreach($roles as $role)
                <option value="{{$role->sipa_roles_id}}">{{$role->sipa_roles_nombre}}</option>
                @endforeach
            </select>
        </div>
        <button class="btn btn-primary boton-config">Guardar</button>
    </form>
</div>
@endforeach
@endsection