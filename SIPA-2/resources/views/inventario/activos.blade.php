@extends('plantillas.inicio')

@section('content')
@php
$cedula = session('idUsuario');
$user = App\User::where('sipa_usuarios_identificacion',$cedula)->get()[0];
$modulo = App\Modulo::where('sipa_opciones_menu_codigo',"INV_EQUIPO")->get()[0];
$permiso = App\Permiso::where('sipa_permisos_roles_role', $user->rol->sipa_roles_id)->where('sipa_permisos_roles_opciones_menu', $modulo->sipa_opciones_menu_id)->get()[0];
@endphp

<form method="get" action="{{url('/inventario')}}">
    <button type="submit" type="button" class="btn btn-secondary">
        <span class="glyphicon glyphicon-circle-arrow-left"></span> Volver
    </button>
</form>

@if($permiso->sipa_permisos_roles_crear)
<button type="button" class="edit-modal btn btn-info" onclick="abrirModal(event, 'modalRegistrarActivo')">
    <span class="glyphicon glyphicon-plus-sign"></span> Crear
</button>
@endif

@if($permiso->sipa_permisos_roles_editar)
<button class="edit-modal btn btn-info" onClick="document.location.href='editarActivo'">
    <span class="glyphicon glyphicon-edit"></span> Editar
</button>
@endif

<table class="table table-striped" id="table">
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
                <?php switch ($activo->sipa_activos_estado):
                    case 0: ?>
                        <div>
                            Excelente
                        </div>
                        <?php break; ?>
                    <?php
                    case 1: ?>
                        <div>
                            Bueno
                        </div>
                        <?php break; ?>
                    <?php
                    case 2: ?>
                        </div>
                        Regular
                        <div>
                            <?php break; ?>
                        <?php
                        case 3: ?>
                            <div>
                                Con problemas
                            </div>
                            <?php break; ?>
                        <?php
                        case 4: ?>
                            <div>
                                Inutilizable
                            </div>
                            <?php break; ?>
                        <?php
                        default: ?>
                            <div>
                                NA
                            </div>
                            <?php break; ?>
                        <?php endswitch; ?>
                        </div>
            </td>

            <td>
                <form method="get" action="{{url('verEquipos', $activo->sipa_activos_id)}}">
                    @if($permiso->sipa_permisos_roles_ver)
                    <button class="edit-modal btn btn-info">
                        <span class="glyphicon glyphicon-eye-open"></span> Ver
                    </button>
                    @endif
                </form>

                @if($permiso->sipa_permisos_roles_borrar)
                <button class="delete-modal btn btn-danger" onclick="abrirModal(event, 'modalBorrarActivo', {{$activo->sipa_activos_id}})">
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
</table>

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