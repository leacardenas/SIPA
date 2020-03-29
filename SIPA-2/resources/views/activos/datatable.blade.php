@php
    $disponible = 1;
    //$activos = App\Activo:: where('sipa_activos_disponible',1)->get();
    $activos = App\Activo:: all();
    $reservas = App\Reserva :: all();
    $fecha_inicial = DateTime::createFromFormat('d-m-Y', $fecha_inicial)->format('Y-m-d');
    $fecha_final = DateTime::createFromFormat('d-m-Y', $fecha_final)->format('Y-m-d');
    $range = App\reserva :: getDatesFromRange($fecha_inicial, $fecha_final);

    // foreach ($reservas as $reserva) {
    //     dd($reserva ->sipa_reservas_activos_fecha_inicio);
    //     if ()
    // }
    foreach ($activos as $k=> $activo) {
        $activoEnReserva = false;
        foreach ($reservas as  $reserva ) {
            if ($activo == $reserva->activo){
                $fecha_inicio_temporal = $reserva ->sipa_reservas_activos_fecha_inicio;
                $fecha_fin_temporal = $reserva ->sipa_reservas_activos_fecha_fin;
                $hora_inicio_temporal = $reserva ->sipa_reservas_activos_hora_inicio;
                $hora_fin_temporal = $reserva ->sipa_reservas_activos_hora_fin;
                // dd(\Carbon\Carbon::createFromFormat('H:i:s',$hora_inicio_temporal)->format('h:i') );
                if($fecha_inicial>= $fecha_inicio_temporal && $fecha_inicial <=$fecha_fin_temporal){
                    //fecha inicial no contenida en rando
                    //fecha final no contenida en rango
                    //rango de reserva no contenido en rango de fechas solicitadas
                     unset($activos[$k]); 
                    break;
                }
            }
        }
        // if($activoEnReserva == false){
        //     $arrayNoReservados[] = $activo;  

        // }

    }
    // dd($arrayNoReservados[0]->sipa_activos_nombre);

    // $activos = App\Activo::whereNotIn('id', $user)->get();

    // dd($range);
@endphp
<script src = "https://code.jquery.com/jquery-3.3.1.js"></script>
<script src = "https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src = "https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">

<p>{{$fecha_inicial}}</p>
<p>{{$fecha_final}}</p>
<p>{{$hora_inicial}}</p>
<p>{{$hora_final}}</p>
{{-- <p>{{$range}}</p> --}}

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
