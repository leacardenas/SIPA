@php 
    $disponible = 1;
    $activos = App\Activo:: where('sipa_activos_disponible',1)->get();
    // $activos = App\Activo:: all();
@endphp
<script src = "https://code.jquery.com/jquery-3.3.1.js"></script>
<script src = "https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src = "https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">
<script>

$(document).ready(function() {
    $('#dataTableActivos').DataTable();
} );
</script>

<table id='dataTableActivos'>
    <thead>
        <th>sipa_activos_nombre</th>
        <th>sipa_activos_descripcion</th>
        <th>sipa_activos_estado</th>
        <th>sipa_activos_foto</th>
    </thead>
    <tbody>
        @foreach ($activos as $activo)
            <tr>
                <td>{{$activo->sipa_activos_nombre}}</td>
                <td>{{$activo->sipa_activos_descripcion}}</td>
                <td>{{$activo->estado->sipa_estado_activo_nombre}}</td>
                <td><img src="data:image/{{$activo->tipo_imagen}};base64,{{$activo->sipa_activos_foto}}" height="100" width="100"></td>
            </tr>
        @endforeach
    </tbody>
</table>
