@extends('plantillas.inicio')
@section('content')
@php
$activo = App\Activo::find($id);
$boletasTasladoLugar = App\UbicacionActivo::where('sipa_ubicacion_activo',$id)->get();
$boletasTrasladoIdiv = App\TrasladoActvosIndv::where('sipa_activo',$id)->get();
@endphp
<div class="row col-sm-12">
    <form method="get" action="{{url('/inventarioEquipos')}}">
        <button type="submit" type="button" class="btn btn-secondary volver">
            <span class="glyphicon glyphicon-chevron-left"></span> Volver
        </button>
    </form>
</div>

<div class="row justify-content-center col-sm-12">
    <h1 id="editarEstado" class="tituloModal">Boletas de Activo <b>{{$activo->sipa_activos_codigo}}</b></h1>
</div>

<div class="row col-sm-12 justify-content-center configActivo">
    <div class="col-sm-12 table-responsive-sm table-wrapper-scroll-y">
        <h4>Buscar activo</h4>
        <div class="input-group-prepend">
            <span class="input-group-text">
                <svg class="bi bi-search" width="1em" height="1em" viewBox="0 0 16 16" fill="#00000" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 011.415 0l3.85 3.85a1 1 0 01-1.414 1.415l-3.85-3.85a1 1 0 010-1.415z" clip-rule="evenodd"/>
                    <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 100-11 5.5 5.5 0 000 11zM13 6.5a6.5 6.5 0 11-13 0 6.5 6.5 0 0113 0z" clip-rule="evenodd"/>
                </svg>
            </span>
            <input class="form-control" id="activos" type="text" placeholder="Ingrese información de la reserva para buscar">
        </div>
        <br>

        <table class="table table-striped table-hover" id="table-usuarios">
            <thead>
                <tr>
                    <th scope="col" class="text-center">Número de Boleta</th>
                    <th scope="col" class="text-center">Fecha de Ingreso</th>
                    <th scope="col" class="text-center">Funcionario actual</th>
                    <th scope="col" class="text-center">Último Funcionario</th>
                    <th scope="col" class="text-center">Acción</th>
                    <th scope="col" class="text-center">Boleta</th>
                </tr>
            </thead>

            <tbody class="text-center" id="tablaActivos">
                @foreach ($boletasTrasladoIdiv as $boleta)
                <tr id=""> 
                    <th class="text-center"> {{$boleta->nombreComprobante}} </th>
                    <td> {{$boleta->created_at }} </td>
                    <td> {{$boleta->usuarioN->sipa_usuarios_nombre}} </td>
                    <td> {{$boleta->usuarioV->sipa_usuarios_nombre}} </td>
                    @if ($boleta->sipa_encargado_o_responsable == 0)
                    <td> Cambio de Responsable </td> 
                    @else
                    <td> Cambio de Encargado </td>
                    @endif
                    <td>
                        <a class="btn botonAzul" href="{{url('boletaFuncionario',$boleta->sipa_traslado_id)}}">
                            <span class="fas fa-file-download" ></span> Descargar Boleta
                        </a>
                    </td>
                </tr>
                @endforeach
                @foreach ($boletasTasladoLugar as $boletaL)
                <tr id=""> 
                    <th class="text-center"> {{$boletaL->nombre_comprobante}} </th>
                    <td> {{$boletaL->created_at }} </td>
                    <td> - </td>
                    <td> - </td>
                    <td> Cambio de Ubicación</td>
                    <td>
                        <a class="btn botonAzul" href="{{url('boletaLugar',$boletaL->sipa_ubicacion_id)}}">
                            <span class="fas fa-file-download" ></span> Descargar Boleta
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>

//BUSCAR INPUT

$(document).ready(function(){

  $("#activos").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#tablaActivos tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});

</script>

@endsection