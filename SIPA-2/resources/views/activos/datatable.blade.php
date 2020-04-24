
@extends('plantillas.navbar')

@section('content')

@php
    // session(['idUsuario' => '207630059']);
    $cedula = session('idUsuario');
    $disponible = 1;
    $fecha_carbon = \Carbon\Carbon::parse($fecha_inicial);
    //$activos = App\Activo:: where('sipa_activos_disponible',1)->get();
    $activos = App\Activo:: all();
    
    $fecha_inicial = DateTime::createFromFormat('d-m-Y', $fecha_inicial)->format('Y-m-d');
    $fecha_final = DateTime::createFromFormat('d-m-Y', $fecha_final)->format('Y-m-d');
    $range = App\reserva :: getDatesFromRange($fecha_inicial, $fecha_final);

    foreach ($activos as $k=> $activo) {
        $activoEnReserva = false;
        $reservas = $activo->reservas;
        
        foreach ($reservas as  $reserva ) {
            
            $fecha_inicio_temporal = $reserva ->sipa_reservas_activos_fecha_inicio;
            $fecha_fin_temporal = $reserva ->sipa_reservas_activos_fecha_fin;
            $hora_inicio_temporal = $reserva ->sipa_reservas_activos_hora_inicio;
            $hora_fin_temporal = $reserva ->sipa_reservas_activos_hora_fin;
            // dd(\Carbon\Carbon::createFromFormat('H:i:s',$hora_inicio_temporal)->format('h:i') );
            if(($fecha_inicial>= $fecha_inicio_temporal && $fecha_inicial <=$fecha_fin_temporal)//pregunta si fecha inicial seleccionada esta dentro del rango de la reserva actual
            ||
            ($fecha_final>= $fecha_inicio_temporal && $fecha_final <=$fecha_fin_temporal)//pregunta si fecha final seleccionada esta dentro del rango de la reserva actual
            ||
            ($fecha_inicio_temporal>= $fecha_inicial && $fecha_inicio_temporal <=$fecha_final)//pregunta si fecha inicial temporal seleccionada esta dentro del rango de la reserva actual
            ||
            ($fecha_fin_temporal>= $fecha_inicial && $fecha_fin_temporal <=$fecha_final)){ //pregunta si fecha final temporal seleccionada esta dentro del rango de la reserva actual
                
                if(($hora_inicial>= $hora_inicio_temporal && $hora_inicial <=$hora_fin_temporal)//pregunta si hora inicial seleccionada esta dentro del rango de la reserva actual
                ||
                ($hora_final>= $hora_inicio_temporal && $hora_final <=$hora_fin_temporal)//pregunta si hora final seleccionada esta dentro del rango de la reserva actual
                ||
                ($hora_inicio_temporal>= $hora_inicial && $hora_inicio_temporal <=$hora_final)//pregunta si hora inicial temporal seleccionada esta dentro del rango de la reserva actual
                ||
                ($hora_fin_temporal>= $hora_inicial && $hora_fin_temporal <=$hora_final)){ //pregunta si hora final temporal seleccionada esta dentro del rango de la reserva actual
                    unset($activos[$k]); 
                    break;
                }
            }

        }
    }

@endphp

<div class="row col-sm-12">
    <form method="get" action="{{url('/reservasEquipos')}}">
    <button type="submit" type="button" class="btn btn-secondary volver">
        <span class="fa fa-chevron-left"></span> Volver
    </button>
    </form>
</div>

<div class="row">
    <div class="row justify-content-center col-sm-12 mb-5">
        <h1 id="activos-registrados">Reservar Activo</h1>
    </div>

    <div class="row col-sm-12 justify-content-center">
        
        <div class="col-sm-6">
             <table id='dataTableActivos'>
                <thead>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Estado</th>
                </thead>
                <tbody>
                    @foreach ($activos as $activo)
                        <tr onclick="selectActivo({{$activo->sipa_activos_id}},this);" id= "{{$activo->sipa_activos_id}}">
                            <td>{{$activo->sipa_activos_nombre}}</td>
                            <td>{{$activo->sipa_activos_descripcion}}</td>
                            <td>{{$activo->sipa_activos_estado}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="col-sm-6">
             <table id='tabla_activos_seleccionados'>
                <thead>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Estado</th>
                </thead>
                <tbody id='tbody_tabla_activos_seleccionados'>

                </tbody>
            </table>
        </div>
    </div>
</div>


<div class="row col-sm-12 justify-content-center">
    <button onclick="reservar();" class="btn boton-reserva">Reservar</button>
</div>


<p id = "fi" hidden>{{$fecha_inicial}}</p>
<!-- <p>{{$fecha_carbon->addDays(2)}}</p>
<p>{{$fecha_carbon->addWeek()}}</p> -->
<p hidden>{{$fecha_carbon->toDateString()}}</p>
<p id = "ff" hidden>{{$fecha_final}}</p>
<p id = "hi" hidden>{{$hora_inicial}}</p>
<p id = "hf" hidden>{{$hora_final}}</p>
<p id = "cant" hidden>{{$cantidad}}</p>
<p id = "semanas_meses" hidden>{{$semanas_meses}}</p>
<p id = "cedula" hidden>{{$cedula}}</p>
{{-- <p>{{$range}}</p> --}}

<script src = "https://code.jquery.com/jquery-3.3.1.js"></script>
<script src = "https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src = "https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">

<script>

    $(document).ready(function() {
        $('#dataTableActivos').DataTable({
            "language": {
                "lengthMenu": "Mostrar _MENU_ ",
                "zeroRecords": "Sin resultados encontrados",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Activos",
                "infoEmpty": "Mostrando 0 de 0 Activos",
                "infoFiltered": "(Filtrado de _MAX_ total Activos)",
                "processing": "Procesando...",
                "loadingRecords": "Cargando...",
                "search": "Buscar",
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
                "lengthMenu": "Mostrar _MENU_ ",
                "zeroRecords": "Sin resultados encontrados",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Activos",
                "infoEmpty": "Mostrando 0 de 0 Activos",
                "infoFiltered": "(Filtrado de _MAX_ total Activos)",
                "processing": "Procesando...",
                "loadingRecords": "Cargando...",
                "search": "Buscar",
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
    function reservar(){

        let table = document.getElementById('tabla_activos_seleccionados');   
 
        let ff = document.getElementById('ff').innerHTML;
        let fi = document.getElementById('fi').innerHTML;
        let hi = document.getElementById('hi').innerHTML;
        let hf = document.getElementById('hf').innerHTML;
        let cant = document.getElementById('cant').innerHTML; //cantidad de semanas o meses
        let semanas_meses = document.getElementById('semanas_meses').innerHTML; // si son semanas o meses
        let cedula = document.getElementById('cedula').innerHTML;

        var list = table.rows;
        var listIDS= [];
        for(let i = 1; i< list.length;i++){
            // console.log(list[i].id);  
            listIDS.push(list[i].id);
        }
        var archJson = JSON.stringify(listIDS);

        var url = "reservarActivos/"+fi+"/"+ff+"/"+hi+"/"+hf+"/"+cant+"/"+semanas_meses+"/"+cedula+"/"+archJson;
        console.log('url: '+url);
                fetch(url).then(r => {
                    return r.json();
                }).then(d => {
                    var obj = JSON.stringify(d);
                    var obj2 = JSON.parse(obj);
                    console.log(obj2);
                });  
    }
</script>

@endsection