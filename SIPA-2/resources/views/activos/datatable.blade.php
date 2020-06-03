
@extends('plantillas.navbar')

@section('content')

@php
    // session(['idUsuario' => '207630059']);
    $cedula = session('idUsuario');
    $disponible = 1;
    $fecha_carbon = \Carbon\Carbon::parse($fecha_inicial);
    //$activos = App\Activo:: where('sipa_activos_disponible',1)->get();
    $activos = App\Activo:: all();
    $fiTEMPCopia_seguridad= $fecha_inicial;
    $ffTEMPCopia_seguridad=$fecha_final;

    $fiTEMP= $fecha_inicial;
    $ffTEMP=$fecha_final;
    $fecha_inicial = DateTime::createFromFormat('d-m-Y', $fecha_inicial)->format('Y-m-d');
    $fecha_final = DateTime::createFromFormat('d-m-Y', $fecha_final)->format('Y-m-d');
    $hora_inicial = \Carbon\Carbon::parse($hora_inicial)->format('H:i:s');
    $hora_final = \Carbon\Carbon::parse($hora_final)->format('H:i:s');
    // $range = App\reserva :: getDatesFromRange($fecha_inicial, $fecha_final);
    // dd($cantidad);
    for ($i = 0; $i <= $cantidad; $i++) {
        foreach ($activos as $k=> $activo) {
            $activoEnReserva = false;
            $reservas = $activo->fechas_ocupado;

            
       
            foreach ($reservas as  $reserva ) {
                
                $fecha_inicio_temporal = $reserva ->sipa_activosOcupados_fi;
                $fecha_fin_temporal = $reserva ->sipa_activosOcupados_ff;
                $hora_inicio_temporal = $reserva ->sipa_activosOcupados_hi;
                $hora_fin_temporal = $reserva ->sipa_activosOcupados_hf;
                //dd($hora_inicial.' vs '.$hora_inicio_temporal.' --- '.$hora_final.' vs '.$hora_fin_temporal);

                if(($fecha_inicial>= $fecha_inicio_temporal && $fecha_inicial <=$fecha_fin_temporal)
                ||
                ($fecha_final>= $fecha_inicio_temporal && $fecha_final <=$fecha_fin_temporal)
                ||
                ($fecha_inicio_temporal>= $fecha_inicial && $fecha_inicio_temporal <=$fecha_final)
                ||
                ($fecha_fin_temporal>= $fecha_inicial && $fecha_fin_temporal <=$fecha_final)){ 
                    
                    if(($hora_inicial>= $hora_inicio_temporal && $hora_inicial <=$hora_fin_temporal)
                    ||
                    ($hora_final>= $hora_inicio_temporal && $hora_final <=$hora_fin_temporal)
                    ||
                    ($hora_inicio_temporal>= $hora_inicial && $hora_inicio_temporal <=$hora_final)
                    ||
                    ($hora_fin_temporal>= $hora_inicial && $hora_fin_temporal <=$hora_final)
                    ||
                    ($hora_inicial=== $hora_inicio_temporal && $hora_final ===$hora_fin_temporal)){ 
                        unset($activos[$k]); 
                        break;
                    }
                }

            }
            // $fiTEMP= $fecha_inicial->toDateString();
            $fecha_inicial = \Carbon\Carbon::parse($fiTEMP);
            $fecha_inicial->addWeek();
            $fiTEMP = $fecha_inicial->toDateString();
            $fecha_inicial = \Carbon\Carbon::parse($fecha_inicial->toDateString())->format('Y-m-d');

            // $ffTEMP= $fecha_final->toDateString();
            $fecha_final = \Carbon\Carbon::parse($ffTEMP);
            $fecha_final->addWeek();
            $ffTEMP = $fecha_final->toDateString();
            $fecha_final = \Carbon\Carbon::parse($fecha_final->toDateString())->format('Y-m-d');
        }
    }

    $fecha_inicial = DateTime::createFromFormat('d-m-Y', $fiTEMPCopia_seguridad)->format('Y-m-d');
    $fecha_final = DateTime::createFromFormat('d-m-Y', $ffTEMPCopia_seguridad)->format('Y-m-d');
@endphp

<div class="row col-sm-12">
    <form method="get" action="{{url('/reservasEquipos')}}">
    <button type="submit" type="button" class="btn btn-secondary volver">
        <span class="fa fa-chevron-left"></span> Volver
    </button>
    </form>
</div>

<div class="row col-sm-12">
    <div class="row justify-content-center col-sm-12 mb-5 reserva-activo">
        <h1 id="activos-registrados">Reservar Activo</h1>
    </div>

    <div class="row col-sm-12 justify-content-center ">
        
        <div class="col-sm-6 table-responsive-sm mb-5">
            <div class="row justify-content-center col-sm-12 mb-3">
                <legend class="legend-reserva">Activos disponibles</legend>
            </div>
            <table id='dataTableActivos' class="table table-striped table-bordered" style="width:100%">
                <thead class="datatableHead">
                    <th>Placa</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Estado</th>
                </thead>
                <tbody>
                    @foreach ($activos as $activo)
                        <tr onclick="selectActivo({{$activo->sipa_activos_id}},this);" id= "{{$activo->sipa_activos_id}}">
                            <td data-label="Placa">{{$activo->sipa_activos_codigo }}</td>
                            <td data-label="Nombre">{{$activo->sipa_activos_nombre}}</td>
                            <td>{{$activo->sipa_activos_descripcion}}</td>
                            <td data-label="Estado">{{$activo->sipa_activos_estado}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="col-sm-6 table-responsive-sm">
            <div class="row justify-content-center col-sm-12 mb-3">
                <legend class="legend-reserva">Activos a reservar</legend>
            </div>
            <table id='tabla_activos_seleccionados' class="table table-striped table-bordered" style="width:100%">
                <thead class="datatableHead">
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


<div class="row col-sm-12 justify-content-center mt-5">
    <button onclick="reservar();" class="btn boton-reservar-activo">Reservar</button>
</div>



<p id = "fi" hidden>{{$fecha_inicial}}</p>
<p hidden>{{$fecha_carbon->toDateString()}}</p>
<p id = "ff" hidden>{{$fecha_final}}</p>
<p id = "hi" hidden>{{$hora_inicial}}</p>
<p id = "hf" hidden>{{$hora_final}}</p>
<p id = "cant" hidden>{{$cantidad}}</p>
<p id = "semanas_meses" hidden>hola</p> 
<p id = "cedula" hidden>{{$cedula}}</p>



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
        var aprobado = true; 
        var archJson = JSON.stringify(listIDS);

        var url = "reservarActivos/"+fi+"/"+ff+"/"+hi+"/"+hf+"/"+cant+"/"+semanas_meses+"/"+cedula+"/"+archJson;
        console.log('url: '+url);
                fetch(url).then(r => {
                    return r.json();
                }).then(d => {
                    var obj = JSON.stringify(d);
                    var obj2 = JSON.parse(obj);
                    console.log(obj2);
                    if(obj2.respuesta === 'mal'){
                        aprobado = false;
                    }
                });  
        if(aprogado ===true){
            Swal.fire({
            icon: 'success',
            title: '¡Realizado con éxito!',
            text: 'La reserva del activo se ha realizado correctamente',
            timer: 6000,
            showConfirmButton: false,
            showCloseButton: true,
            });

            window.location.href = "/reservas";
        }else{
            Swal.fire({
            icon: 'success',
            title: '¡Hubo un problema!',
            text: 'Mientras seleccionabas, alguien mas reservo un activo que estas intentando reservar.',
            timer: 6000,
            showConfirmButton: false,
            showCloseButton: true,
            });

            //window.location.href = "/reservas"; recargar la pagina
        }
         
    }



</script>

@endsection