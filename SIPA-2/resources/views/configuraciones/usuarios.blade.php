@extends('plantillas.inicio')

@section('title')
Usuarios Registrados
@stop

@section('ruta')
<p id="rol" class="navbar-text navbar-center">Solicitudes de Registro</p>
@stop

@section('content')

<div class="row col-sm-12">
    <form method="get" action="{{url('/configuraciones')}}">
    <button type="submit" type="button" class="btn btn-secondary volver">
        <span class="glyphicon glyphicon-chevron-left"></span> Volver
    </button>
    </form>
</div>

<div class="row col-sm-12">
   <div class="row justify-content-center col-sm-12">
        <h1 id="usuarios-registrados">Usuarios Registrados</h1>
    </div>

    <div class="col-sm-12 table-responsive-sm">
    <table class="table table-striped" id="table-usuarios">
        <thead>
            <tr>
                <th scope="col" class="text-center">Cédula</th>
                <th scope="col" class="text-center">Nombre</th>
                <th scope="col" class="text-center">Destinar Rol</th>
                <th scope="col" class="text-center">Acciones</th>
            </tr>
        </thead>

        <tbody class="text-center">
        @php
        $usuarios= App\User::where('sipa_usuarios_rol',null)->get();
        $roles = App\Rol::all();
        @endphp

            <!-- @if($usuarios!==null) -->
            @foreach($usuarios as $usuario)
            <tr>
                <th class="text-center" id='{{$usuario->sipa_usuarios_identificacion}}id' value="{{$usuario->sipa_usuarios_identificacion}}" scope="row">{{$usuario->sipa_usuarios_identificacion}}</th>
                <td>{{$usuario->sipa_usuarios_nombre}}</td>
                <td>
                    <select  class="browser-default custom-select" id="{{$usuario->sipa_usuarios_identificacion}}" name="selectRolRegistrar">
                        <option selected>Seleccione un rol</option>
                        @foreach($roles as $role)
                        <option value="{{$role->sipa_roles_nombre}}">{{$role->sipa_roles_nombre}}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <button onclick="actualizar({{$usuario->sipa_usuarios_identificacion}});" class="btn btn-primary">
                        Aceptar
                    </button>
                    <button onclick="eliminar();" class="btn btn-danger">
                        Eliminar
                    </button>
                </td>
            </tr>
            @endforeach
            <!-- @else
            <p>No hay roles</p>
            @endif -->

        </tbody>
    </table>

    </div>
</div>

<script type='text/javascript'>
function actualizar(nombre){
    var id = document.getElementById(nombre+'id').innerHTML;
    // var nombre = 'asdasd';
        console.log(id);
        var elemento = document.getElementById(id);
        console.log(elemento);
        var rolNombre = elemento.options[elemento.selectedIndex].value;
        console.log(rolNombre);
        var url = "aceptarUsuario/"+id+"/"+nombre+"/"+rolNombre;
        fetch(url).then(r => {
                console.log(r);
                return r.json();
        }).then(d => {
                var obj = JSON.stringify(d);
                var obj2 = JSON.parse(obj);
                console.log(obj2);
                document.location.reload();
        });
}

function eliminar(){
    console.log('Fiorella');
}
</script>

@endsection
