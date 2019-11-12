@extends('plantillas.inicio')

@section('ruta')
<p id="rol" class="navbar-text navbar-center">Solicitudes de Registro</p>
@stop

@section('content')

<form method="get" action="{{url('/configuraciones')}}">
    <button type="submit" type="button" class="btn btn-secondary">
        <span class="glyphicon glyphicon-circle-arrow-left"></span> Volver
    </button>
</form>

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
            <script type='text/javascript'>
                function actualizar(nombre){
                    var id = document.getElementById(nombre+'id').innerHTML;
                    // var nombre = 'asdasd';
                        console.log(id);
                        elemento = document.getElementById(id);
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
            </script>
        <!-- @if($usuarios!==null) -->

        @foreach($usuarios as $usuario)
   
            <li class="table-row">
                <div class="col col-1">
                    <p id='{{$usuario->sipa_usuarios_identificacion}}id' value="{{$usuario->sipa_usuarios_identificacion}}">{{$usuario->sipa_usuarios_identificacion}}</p>
                </div>
                <div class="col col-2">
                    <p>{{$usuario->sipa_usuarios_nombre}}</p>
                </div>
                <div class="col col-4">
                    <select id="{{$usuario->sipa_usuarios_identificacion}}" name="selectRolRegistrar">
                        <option></option>
                        @foreach($roles as $role)
                        <option value="{{$role->sipa_roles_nombre}}">{{$role->sipa_roles_nombre}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col col-3">
                    <button onclick="actualizar({{$usuario->sipa_usuarios_identificacion}});" class="edit-modal btn btn-info">
                        <span class="glyphicon glyphicon-edit">Aceptar</span> 
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
</div>

@endsection
