@extends('plantillas.inicio')

@section('content')

<div class="row col-sm-12">
    <form method="get" action="{{url('/roles')}}">
        <button type="submit" type="button" class="btn btn-secondary volver">
            <span class="glyphicon glyphicon-chevron-left"></span> Volver
        </button>
    </form>
</div>

@php
$rol = App\Rol::where('sipa_roles_id',$id)->get();
@endphp

<div class="row justify-content-center col-sm-12">
    @foreach ($rol as $r)
    <h1 class="tituloModal">Permisos del <b>{{$r->sipa_roles_nombre}}</b></h1>
</div>

<div class="row col-sm-12 justify-content-center">

     <div class="col-sm-12 table-responsive-sm">
    @php
        $permisos = $r->permisos;
    @endphp 
        <table class="table table-striped" name="table-roles" id="table-usuarios">
            <thead>
                <tr>
                    <th scope="col" class="text-center">Permiso</th>
                    <th scope="col" class="text-center">Acceso</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach ($permisos as $permiso)
                <tr>
                    <th class="text-center">{{$permiso->modulo->sipa_opciones_menu_nombre}}</th>
                    <td>{{$permiso->modulo->sipa_opciones_menu_descripcion }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endforeach
    </div>
</div>
@endsection

