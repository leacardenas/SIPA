@extends('plantillas.inicio')

@section('content')
<button type="button" class="edit-modal btn btn-info" onclick="abrirModal(event, 'modalRegistrarActivo')">
	<span class="glyphicon glyphicon-edit"></span> Crear
</button>

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
					case 1: ?>
						<div>
							Activo
						</div>
						<?php break; ?>
					<?php
					case 2: ?>
						</div>
						De baja
						<div>
							<?php break; ?>
						<?php endswitch; ?>
						</div>
			</td>

			<td>
				<button class="edit-modal btn btn-info" onClick="document.location.href='/configurarRoles'">
					<span class="glyphicon glyphicon-edit"></span> Editar
				</button>
				<button class="edit-modal btn btn-info" onclick="abrirModal(event, 'modalVerActivo', null)">
					<span class="glyphicon glyphicon-edit"></span> Ver
				</button>
				<button class="delete-modal btn btn-danger" onclick="abrirModal(event, 'modalBorrarActivo', {{$activo->sipa_activos_id}})">
					<span class="glyphicon glyphicon-trash"></span> Borrar
				</button>
			</td>
		</tr>
	</tbody>
	@endforeach
	@else
	<tbody>
	</tbody>
	<h2>
		No hay activos en el sistema.
	</h2>
	@endif
</table>

<!--Modals-->
@extends('activos.registrar')
@extends('activos.ver')
@extends('activos.borrar')

@endsection