@php
    $disponible = 1;
    //$activos = App\Activo:: where('sipa_activos_disponible',1)->get();
    $activos = App\Activo:: all();
@endphp
<script src = "https://code.jquery.com/jquery-3.3.1.js"></script>
<script src = "https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src = "https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">
<table id = 'tableoftables'>
    <tbody>
        <tr>
            <td>
                <table id='dataTableActivos'>
                    <thead>
                        <th>sipa_activos_nombre</th>
                        <th>sipa_activos_descripcion</th>
                        <th>sipa_activos_estado</th>
                        <th>sipa_activos_foto</th>
                    </thead>
                    <tbody>
                        @foreach ($activos as $activo)
                            <tr onclick="selectActivo({{$activo->sipa_activos_id}},this);" id= "{{$activo->sipa_activos_id}}">
                                <td>{{$activo->sipa_activos_nombre}}</td>
                                <td>{{$activo->sipa_activos_descripcion}}</td>
                                <td>{{$activo->sipa_activos_estado}}</td>
                                <td><img src="data:image/{{$activo->tipo_imagen}};base64,{{$activo->sipa_activos_foto}}" height="100" width="100"></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </td>
            <td>
                <table id='tabla_activos_seleccionados'>
                    <thead>
                        <th>sipa_activos_nombre</th>
                        <th>sipa_activos_descripcion</th>
                        <th>sipa_activos_estado</th>
                        <th>sipa_activos_foto</th>
                    </thead>
                    <tbody>
                        {{-- @foreach ($activos as $activo)
                            <tr onclick="selectActivo({{$activo->sipa_activos_id}});">
                                <td>{{$activo->sipa_activos_nombre}}</td>
                                <td>{{$activo->sipa_activos_descripcion}}</td>
                                <td>{{$activo->sipa_activos_estado}}</td>
                                <td><img src="data:image/{{$activo->tipo_imagen}};base64,{{$activo->sipa_activos_foto}}" height="100" width="100"></td>
                            </tr>
                        @endforeach --}}
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>


<script>

    $(document).ready(function() {
        $('#dataTableActivos').DataTable({
            "language": {
                "lengthMenu": "Mostrar _MENU_ Profesores",
                "zeroRecords": "Sin resultados encontrados",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Profesores",
                "infoEmpty": "Mostrando 0 to 0 of 0 Profesores",
                "infoFiltered": "(Filtrado de _MAX_ total Profesores)",
                "processing": "Procesando...",
                "loadingRecords": "Cargando...",
                "search": "Buscar:",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            }
        });
    });

    $(document).ready(function() {
        $('#tabla_activos_seleccionados').DataTable({
            "language": {
                "lengthMenu": "Mostrar _MENU_ Profesores",
                "zeroRecords": "Sin resultados encontrados",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Profesores",
                "infoEmpty": "Mostrando 0 to 0 of 0 Profesores",
                "infoFiltered": "(Filtrado de _MAX_ total Profesores)",
                "processing": "Procesando...",
                "loadingRecords": "Cargando...",
                "search": "Buscar:",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            }
        });
    });

    function selectActivo(x,xthis){
 
        var row = $('#dataTableActivos').DataTable().row( $(xthis) );
        var rowNode = row.node();
        row.remove().draw();
    
        $('#tabla_activos_seleccionados').DataTable() 
        .row.add( rowNode )
        .draw();

        var activoTR = document.getElementById(x);
        activoTR.onclick = function(){unSelectActivo(x,xthis);};
    }

    function unSelectActivo(x,xthis){
    
        var row = $('#tabla_activos_seleccionados').DataTable().row( $(xthis) );
        var rowNode = row.node();
        row.remove().draw();

        $('#dataTableActivos').DataTable() 
        .row.add( rowNode )
        .draw();

        var activoTR = document.getElementById(x);
        activoTR.onclick = function(){selectActivo(x,xthis);};
    }

</script>
