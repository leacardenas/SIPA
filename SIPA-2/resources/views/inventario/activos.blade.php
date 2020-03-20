@extends('plantillas.inicio')

@section('ruta')
<p id="rol" class="navbar-text navbar-center">Ver Activos</p>
@stop

@section('content')
@php
$cedula = session('idUsuario');
$user = App\User::where('sipa_usuarios_identificacion',$cedula)->get()[0];
$modulo = App\Modulo::where('sipa_opciones_menu_codigo',"INV_EQUIPO")->get()[0];
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
            <h1 id="activos-registrados">Activos Registrados</h1>
        </div>
    
    <div class="row botones-activos">
        <div class="col-sm-6">
            @if($permiso->sipa_permisos_roles_crear)
            <button type="button" class="btn btn-primary" onclick="abrirModal(event, 'modalRegistrarActivo')">
                <span class="glyphicon glyphicon-plus"></span> Crear
            </button>
            @endif
        </div>
        <div class="col-sm-6">
            @if($permiso->sipa_permisos_roles_editar)
            <button class="btn btn-primary" id="editar_activo_inv" onClick="document.location.href='editarActivo'">
                <span class="glyphicon glyphicon-edit"></span> Editar
            </button>
            @endif
        </div>
    </div>
    
    <div class="row col-sm-12 justify-content-center">

        <div class="col-sm-12 table-responsive-sm">
            <table class="table table-striped" id="table-usuarios">
                <thead>
                <tr>
                    <th scope="col" class="text-center">#</th>
                    <th scope="col" class="text-center">Código</th>
                    <th scope="col" class="text-center">Nombre</th>
                    <th scope="col" class="text-center">Estado</th>
                    <th scope="col" class="text-center">Acciones</th>
                </tr>
                </thead>

                @if(count($activos) > 0)
                @foreach($activos as $activo)
                <tbody class="text-center">
                    <tr id="{{$activo->sipa_activos_id}}">
                        <th class="text-center"> {{$activo->sipa_activos_id}} </th>
                        <td> {{$activo->sipa_activos_codigo}} </td>
                        <td> {{$activo->sipa_activos_nombre}} </td>
                        <td> {{$activo->sipa_activos_estado}} </td>
                        <td> 
                            <div class="col-sm-12">
                                <div class="col-sm-6">
                                    <form method="get" action="{{url('verEquipos', $activo->sipa_activos_id)}}" >
                                    @if($permiso->sipa_permisos_roles_ver)
                                        <button class="btn btn-primary ver-btn">
                                            <span class="far fa-eye"></span> Ver
                                        </button>
                                    @endif
                                    </form>
                                </div>
                                <div class="col-sm-6">
                                    @if($permiso->sipa_permisos_roles_borrar)
                                    <button class="btn btn-danger borrar-btn" onclick="abrirModal(event, 'modalBorrarActivo', {{$activo->sipa_activos_id}})">
                                        <span class="glyphicon glyphicon-trash"></span> Borrar
                                    </button>
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
                        No hay activos en el sistema.
                    </h2>
                </tbody>
                @endif
            </table>
        </div>
    </div>
</div>


<!-- <table class="table table-striped" id="table">
    <thead>
        <tr>
            <th class="text-center">#</th>
            <th class="text-center">Código</th>
            <th class="text-center">Nombre</th>
            <th class="text-center">Estado</th>
            <th class="text-center">Acciones</th>
        </tr>
    </thead>

    @if(count($activos) > 0)
    @foreach($activos as $activo)
    <tbody>
        <tr id="{{$activo->sipa_activos_id}}" class="text-center">
            <td>{{$activo->sipa_activos_id}}</td>
            <td>{{$activo->sipa_activos_codigo}}</td>
            <td>{{$activo->sipa_activos_nombre}}</td>

            <td>
                <div>
                    {{$activo->sipa_activos_estado}}
                </div>
            </td>

            <td>
                <form method="get" action="{{url('verEquipos', $activo->sipa_activos_id)}}" id="ver_inv_form">
                    @if($permiso->sipa_permisos_roles_ver)
                    <button class="activo_inv_button" id="ver_inv_button">
                        <span class="glyphicon glyphicon-eye-open"></span> Ver
                    </button>
                    @endif
                </form>

                @if($permiso->sipa_permisos_roles_borrar)
                <button class="activo_inv_button" id="borrar_inv_button" onclick="abrirModal(event, 'modalBorrarActivo', {{$activo->sipa_activos_id}})">
                    <span class="glyphicon glyphicon-trash"></span> Borrar
                </button>
                @endif
                
            </td>
        </tr>
    </tbody>
    @endforeach
    @else
    <tbody>
        <h2>
            No hay activos en el sistema.
        </h2>
    </tbody>
    @endif
</table> -->




<!--Modals-->
@extends('activos.registrar')
@extends('activos.borrar')

<!--Scripts-->

{{-- <script type="text/javascript">
	function borrarActivo() {
		console.log(seleccionado);
		var url = "/activos/"+seleccionado;

		fetch(url)
		.then(r => {
			console.log(r.json());
			return r.json();
		}).then(d => {
			// var obj = JSON.stringify(d);
			 var obj2 = JSON.parse(obj);
			// doSomthing(r);
			console.log(d);

		});
	}
	function doSomthing(json){
		var obj2 = JSON.parse(json);
		// var obj = JSON.stringify(d);
			// var obj2 = JSON.parse(obj);
		console.log(obj2);

	}

</script> --}}

@endsection