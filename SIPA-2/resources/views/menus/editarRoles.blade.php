@extends('plantillas.inicio') @section('ruta')
<p id="rol" class="navbar-text navbar-center">Roles</p>
@stop @section('content')

<div class="row col-sm-12">
    <form method="get" action="{{url('/configuraciones')}}">
        <button type="submit" type="button" class="btn btn-secondary volver">
            <span class="glyphicon glyphicon-chevron-left"></span> Volver
        </button>
    </form>
</div>

<div class="row col-sm-12">

    <div class="row justify-content-center col-sm-12">
        <h1 class="tituloModal">Roles</h1>
    </div>

    <div class="row botones-activos">
        <div class="col-sm-6">
            <button type="submit" class="btn btn-primary ver-btn-roles" onclick="window.location='{{url('/crearRol')}}'">
                <span class="glyphicon glyphicon-plus"></span> Crear
            </button>
        </div>
    </div>

    <div class="row col-sm-12 justify-content-center">
        @php $roles = App\Rol::all(); @endphp

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
                            <div class="col-sm-12">
                                <div class="col-sm-4">
                                    <button type="submit" class="btn btn-primary" onclick="window.location='{{url('/editarRol',$rol->sipa_roles_id)}}'">
                                        <span class="glyphicon glyphicon-edit"></span> Editar
                                    </button>
                                </div>
                                <div class="col-sm-4">
                                    <button type="submit" class="btn btn-primary ver-btn-roles" onclick="window.location='{{url('/verDetallerRol',$rol->sipa_roles_id)}}'">
                                        <span class="far fa-eye"></span> Ver
                                    </button>
                                </div>
                                <div class="col-sm-4">
                                    <a data-toggle="modal" data-target="#borrarModal" class="btn btn-danger borrar-btn" id="$rol->sipa_roles_id">
                                        <span class="glyphicon glyphicon-trash"></span> Borrar
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" id="borrarModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Borrar Rol</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>¿Está seguro que desea eliminar el rol?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="aceptar" onclick="borrarRol()">Aceptar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

    @endsection