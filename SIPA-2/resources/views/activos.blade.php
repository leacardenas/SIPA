@extends('plantillas.inicio')

@section('content')
<script>
    $(document).ready(function() {
        $('#table').DataTable();
    } );
    </script>
				<button class="edit-modal btn btn-info">
							<span class="glyphicon glyphicon-edit"></span> Crear
						</button>

			@if(count($activos) > 0)
							<table class="table table-striped" id="table">
							<thead>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">Código</th>
                <th class="text-center">Nombre</th>
                <th class="text-center">Precio</th>
                <th class="text-center">Acciones</th>
            </tr>
        </thead>
			@foreach($activos as $activo)
			<tbody>
				<tr class="item{{$activo->id}}">
					<td>{{$activo->sipa_activos_id}}</td>
					<td>{{$activo->sipa_activos_codigo}}</td>
					<td>{{$activo->sipa_activos_nombre}}</td>
					<td>{{$activo->sipa_activos_precio}}</td>
					<td><button class="edit-modal btn btn-info">
							<span class="glyphicon glyphicon-edit"></span> Editar
						</button>
						<button class="edit-modal btn btn-info">
						<span class="glyphicon glyphicon-edit"></span> Ver
						</button>
						<button class="delete-modal btn btn-danger">
							<span class="glyphicon glyphicon-trash"></span> Borrar
						</button>
					</td>
				</tr>
			</tbody>
			@endforeach
				</table>
			@else
            <table class="table table-striped" id="table">
							<thead>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">Código</th>
                <th class="text-center">Nombre</th>
                <th class="text-center">Precio</th>
                <th class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
        </table>

        <h2>
            No hay activos en el sistema.
        </h2>
			@endif
    </table>
@endsection

