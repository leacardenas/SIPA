@extends('plantillas.inicio')

@section('content')
@php
$cedula = session('idUsuario');
$user = App\User::where('sipa_usuarios_identificacion',$cedula)->get()[0];
$modulo = App\Modulo::where('sipa_opciones_menu_codigo',"INV_INSUMO")->get()[0];
$permiso = App\Permiso::where('sipa_permisos_roles_role', $user->rol->sipa_roles_id)->where('sipa_permisos_roles_opciones_menu', $modulo->sipa_opciones_menu_id)->get()[0];
@endphp

<div class="row col-sm-12">
    <form method="get" action="{{url('/inventario')}}">
    <button type="submit" type="button" class="btn btn-secondary volver">
        <span class="glyphicon glyphicon-chevron-left"></span> Volver
    </button>
    </form>
</div>

<div class="row col-sm-12">

        <div class="row justify-content-center col-sm-12">
            <h1 id="activos-registrados">Insumos Registrados</h1>
        </div>
    
    <div class="row botones-activos">
        <div class="col-sm-6">
            @if($permiso->sipa_permisos_roles_crear)
            <form method="get" action="{{url('/registrarInsumo')}}">
            <button type="submit" class="btn btn-primary" >
                <span class="glyphicon glyphicon-plus"></span> Registrar
            </button>
            </form>
            @endif
        </div>
        <div class="col-sm-6">
            @if($permiso->sipa_permisos_roles_editar)
            <form method="GET" action="{{url('/asignarInsumo')}}">
            <button type="submit" class="btn btn-primary">
                <span class="glyphicon glyphicon-edit"></span> Asignar
            </button>
            </form>
            @endif
        </div>
    </div>
    
    <div class="row col-sm-12 justify-content-center">

        <div class="col-sm-12 table-responsive-sm">
            <table class="table table-striped" id="table-usuarios">
                <thead>
                <tr>
                    <th scope="col" class="text-center">Código</th>
                    <th scope="col" class="text-center">Nombre</th>
                    <th scope="col" class="text-center">Descripción</th>
                    <th scope="col" class="text-center">Cantidad</th>
                    <th scope="col" class="text-center">Costo Unitario</th>
                </tr>
                </thead>

                @if(count($insumos) > 0)
                @foreach($insumos as $insumo)
                <tbody class="text-center">
                    <tr id="{{$activo->sipa_activos_id}}">
                        <th class="text-center"> {{$insumo->sipa_insumos_codigo}} </th>
                        <td> {{$activo->sipa_insumos_nombre}} </td>
                        <td> {{$activo->sipa_insumos_descripcion}} </td>
                        <td> {{$activo->sipa_insumos_cantidad}} </td>
                        <td> {{$activo->sipa_insumos_costo_unitario}} </td>
                        <td> 
                            <div class="col-sm-12">
                                <div class="col-sm-6">
                                    @if($permiso->sipa_permisos_roles_ver)
                                        <a class="btn btn-primary ver-btn" href="{{url('verEquipos', $activo->sipa_activos_id)}}">
                                            <span class="far fa-eye"></span> Ver
                                        </a>
                                    @endif
                                </div>
                                <div class="col-sm-6">
                                    @if($permiso->sipa_permisos_roles_borrar)
                                    <a data-toggle="modal" data-target="#borrarModal" class="btn btn-danger borrar-btn" id="$activo->sipa_activos_id">
                                        <span class="glyphicon glyphicon-trash"></span> Borrar
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
                @endforeach
                @else
                <tbody>
                    <h2>
                        No hay insumos en el sistema.
                    </h2>
                </tbody>
                @endif
            </table>
        </div>
    </div>
</div>


@endsection