@extends('plantillas.inicio')
@section('content')

@php
$reservas = App\Reserva::where('sipa_reserva_estado','Pendiente')->get();
@endphp

<div class="row col-sm-12">
    <form method="get" action="{{url('/entregas')}}">
        <button type="submit" type="button" class="btn btn-secondary volver">
            <span class="glyphicon glyphicon-chevron-left"></span> Volver
        </button>
    </form>
</div>

<div class="row justify-content-center col-sm-12">
    <h1 id="editarEstado" class="tituloModal">Entrega de Activo</h1>
</div>

<div class="row col-sm-12 justify-content-center configActivo">
    <div class="col-sm-12 table-responsive-sm table-wrapper-scroll-y">
        <h4>Reservas de Activos</h4>
        <div class="input-group-prepend">
            <span class="input-group-text">
                <svg class="bi bi-search" width="1em" height="1em" viewBox="0 0 16 16" fill="#00000" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 011.415 0l3.85 3.85a1 1 0 01-1.414 1.415l-3.85-3.85a1 1 0 010-1.415z" clip-rule="evenodd"/>
                    <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 100-11 5.5 5.5 0 000 11zM13 6.5a6.5 6.5 0 11-13 0 6.5 6.5 0 0113 0z" clip-rule="evenodd"/>
                </svg>
            </span>
            <input class="form-control" id="reservas" type="text" placeholder="Ingrese información de la reserva para buscar">
        </div>
        <br>

        <table class="table table-striped table-hover" id="table-usuarios">
            <thead>
                <tr>
                    <th scope="col" class="text-center">Placa del activo</th>
                    <th scope="col" class="text-center">Nombre del activo</th>
                    <th scope="col" class="text-center">Fecha Inicial</th>
                    <th scope="col" class="text-center">Hora Inicial</th>
                    <th scope="col" class="text-center">Fecha Final</th>
                    <th scope="col" class="text-center">Hora Final</th>
                    <th scope="col" class="text-center">Funcionario</th>
                    <th scope="col" class="text-center">Estado</th>
                    <th scope="col" class="text-center">Accion</th>
                </tr>
            </thead>

            <tbody class="text-center" id="tablaReservas">
                @foreach ($reservas as $reserva)
                @php
                 $activos = $reserva->activos;   
                @endphp
                <tr id=""> 
                    <td data-label="Placa del activo"> 
                        @foreach ($activos as $activo)
                        <b> {{$activo->sipa_activos_codigo}} </b> <br>
                        @endforeach
                    </td>
                    <td data-label="Nombre del activo"> 
                        @foreach ($activos as $activo)
                            <b>{{$activo->sipa_activos_nombre}}</b><br>
                        @endforeach
                    </td>
                    <td data-label="Fecha Inicial">{{$reserva->sipa_reservas_activos_fecha_inicio}}</td>
                    <td data-label="Hora Inicial">{{$reserva->sipa_reservas_activos_hora_inicio}}</td>
                    <td data-label="Fecha Final">{{$reserva->sipa_reservas_activos_fecha_fin}}</td>
                    <td data-label="Hora Final">{{$reserva->sipa_reservas_activos_hora_fin}}</td>
                    <td data-label="Funcionario">{{$reserva->user->sipa_usuarios_nombre}}</td>
                    <td data-label="Estado">
                        <select class="form-control select2" required>
                            <option disabled selected value>No Entregado</option>
                            <option>Entregado</option>
                            <option>No Entregado</option>
                        </select>
                    </td>
                    <td>
                        <a type="submit" type="button" class="btn btn-secondary volver">
                            <span class="glyphicon glyphicon-chevron-left"></span> Guardar
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

  $("#reservas").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#tablaReservas tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});

</script>

@endsection