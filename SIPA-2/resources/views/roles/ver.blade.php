@extends('plantillas.inicio')

@section('content')

<div class="row col-sm-12">
    <form method="get" action="{{url('/configuracionesRoles')}}">
        <button type="submit" type="button" class="btn btn-secondary volver">
            <span class="glyphicon glyphicon-chevron-left"></span> Volver
        </button>
    </form>
</div>

<div class="row justify-content-center col-sm-12">
    <h1 class="tituloModal">Roles registrados</h1>
</div>

<div class="row col-sm-12 justify-content-center">
    @php
    $roles = App\Rol::all();
    @endphp

    <div class="col-sm-12 table-responsive-sm">

        <table class="table table-striped" name="table-roles" id="table-usuarios">
            <thead>
                <tr>
                    <th scope="col" class="text-center">Código</th>
                    <th scope="col" class="text-center">Nombre</th>
                    <th scope="col" class="text-center">Descripción</th>
                    <th scope="col" class="text-center">Acción</th>
                </tr>
            </thead>
        
            <tbody class="text-center">
                @foreach ($roles as $rol)
                <tr>
                    <th class="text-center"> {{$rol->sipa_roles_codigo}} </th>
                    <td> {{$rol->sipa_roles_nombre}} </td>
                    <td> {{$rol->sipa_roles_descripcion}} </td>
                    <td> 
                        <form method="get" action = "{{url('/verDetallerRol',$rol->sipa_roles_id)}}">
                            <button type = "submit" class="btn btn-primary ver-btn-roles">
                                <span class="far fa-eye"></span> Ver
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection