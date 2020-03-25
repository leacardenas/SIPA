@extends('plantillas.inicio')

@section('content')
<div class="row col-sm-12">
    <form method="get" action="{{url('/configuraciones')}}">
        <button type="submit" type="button" class="btn btn-secondary volver">
            <span class="glyphicon glyphicon-chevron-left"></span> Volver
        </button>
    </form>
</div>

<div class="row justify-content-center col-sm-12">
    <h1 id="editarResponsable" class="tituloModal">Tipos de usuarios del sistema</h1>
</div>

<div class="col-sm-12 table-responsive-sm">
     <table class="table table-striped" id="table-usuarios">
        <thead>
            <tr>
                <th scope="col" class="text-center">Cédula</th>
                <th scope="col" class="text-center">Nombre</th>
                <th scope="col" class="text-center">Rol</th>
                <th scope="col" class="text-center">Acciones</th>
            </tr>
        </thead>
        @php
        $usuarios= App\User::where('sipa_usuarios_rol',null)->get();
        $roles = App\Rol::all();
        @endphp
        <tbody class="text-center">
        @foreach($usuarios as $usuario)
            <tr>
                <th class="text-center" id='{{$usuario->sipa_usuarios_identificacion}}id' value="{{$usuario->sipa_usuarios_identificacion}}" scope="row"> {{$usuario->sipa_usuarios_identificacion}} </th>
                <td> {{$usuario->sipa_usuarios_nombre}} </td>
                <td> <!-- NOMBRE DE ROL DEL USUARIO -->  </td>
                <td> 
                <div class="row justify-content-center">
                    <form  method="get" action="{{url('editarTipoUsuario', $usuario->sipa_usuarios_nombre)}}">
                        <button class="btn btn-primary ver-btn">
                            <span class="glyphicon glyphicon-edit"></span> Editar
                        </button>
                    </form>
                </div>
                </td>
            </tr>
        </tbody>
        </table>
        @endforeach
        
</div>
@endsection