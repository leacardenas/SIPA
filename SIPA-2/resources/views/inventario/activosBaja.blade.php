@extends('plantillas.inicio')

@section('content')
@php
$cedula = session('idUsuario');
$modulo = App\Modulo::where('sipa_opciones_menu_codigo',"INV_ACTIVO")->get()[0];
$user = App\User::where('sipa_usuarios_identificacion',$cedula)->get()[0];
$permiso = App\Permiso::where('sipa_permisos_roles_role', $user->rol->sipa_roles_id)->where('sipa_permisos_roles_opciones_menu', $modulo->sipa_opciones_menu_id)->get()[0];
$activos = App\ActivoBaja::all();
@endphp

<div class="row col-sm-12">
    <form method="get" action="{{url('/configuracionesActivos')}}">
    <button type="submit" type="button" class="btn btn-secondary volver">
        <span class="glyphicon glyphicon-chevron-left"></span> Volver
    </button>
    </form>
</div>

<div class="row col-sm-12">

    <div class="row justify-content-center col-sm-12">
        <h1 id="activos-registrados">Activos en baja</h1>
    </div>

</div>

<div class="row col-sm-12 justify-content-center">

    <div class="col-sm-12 table-responsive-sm">
        <h4>Buscar activo</h4>
        <div class="input-group-prepend">
            <span class="input-group-text">
                <svg class="bi bi-search" width="1em" height="1em" viewBox="0 0 16 16" fill="#00000" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 011.415 0l3.85 3.85a1 1 0 01-1.414 1.415l-3.85-3.85a1 1 0 010-1.415z" clip-rule="evenodd"/>
                    <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 100-11 5.5 5.5 0 000 11zM13 6.5a6.5 6.5 0 11-13 0 6.5 6.5 0 0113 0z" clip-rule="evenodd"/>
                </svg>
            </span>
            <input class="form-control" id="activos" type="text" placeholder="Ingrese información del activo para buscar">
        </div>
        <br>

        <table class="table table-striped" id="table-usuarios">
            <thead>
                <tr>
                    <th scope="col" class="text-center">Placa</th>
                    <th scope="col" class="text-center">Nombre</th>
                    <th scope="col" class="text-center">Responsable</th>
                    <th scope="col" class="text-center">Encargado</th>
                    <th scope="col" class="text-center">Acciones</th>
                </tr>
            </thead>

            <tbody class="text-center" id="tablaActivos">
            @if(count($activos) > 0)
            
            @foreach($activos as $activo)
            
                <tr id="{{$activo->sipa_activo_baja}}">
                    <td data-label="Placa"> <b>{{$activo->activo->sipa_activos_codigo}} </b></td>
                    <td data-label="Nombre">  {{$activo->activo->sipa_activos_nombre}} </td>
                    <td data-label="Responsable">  {{$activo->activo->usuarioR->sipa_usuarios_nombre}} </td>
                    <td data-label="Encargado">  {{$activo->activo->usuarioE->sipa_usuarios_nombre}} </td>
                    <td data-label="Acciones">
                        <div class="row mb-3 justify-content-center">
                            <a class="btn botonAzul" href="{{url('verEquipos',$activo->activo->sipa_activos_codigo)}}">
                                <span class="far fa-eye"></span> Ver Activo
                            </a>
                        </div>
                        <div class="row justify-content-center">
                            <a class="btn botonAzul" href="{{url('verBoleta', $activo->id)}}">
                                <span class="fas fa-file-download" ></span> Descargar Boleta
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
            @else
                <div class="alerta mb-5">
                    <i class="fas fa-exclamation-triangle"></i> No hay activos dados de baja en el sistema
                </div>
            @endif
        </table>
    </div>
</div>

@endsection