@extends('plantillas.inicio')
@section('content')
@php
$reservas = $sala->reservas;
// dd($sala);
@endphp
<div class="row col-sm-12">
    <form method="get" action="{{url('/informacionSalas')}}">
    <button type="submit" type="button" class="btn btn-secondary volver">
        <span class="fa fa-chevron-left"></span> Volver
    </button>
    </form>
</div>

<div class="row col-sm-12 justify-content-center configActivo">

    <div class="row col-sm-12 mb-5">
        <h1 id="h3ActivoReserva">Detalle de reservas de <b>Sala #{{$sala->sipa_salas_codigo }}</b></h1>
    </div>

    <div class="col-sm-12 table-responsive-sm table-wrapper-scroll-y">
        <h4>Buscar reserva</h4>
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
                    <th scope="col" class="text-center">ID de reserva</th>
                    <th scope="col" class="text-center">Fecha Inicial</th>
                    <th scope="col" class="text-center">Hora Inicial</th>
                    <th scope="col" class="text-center">Fecha Final</th>
                    <th scope="col" class="text-center">Hora Final</th>
                    <th scope="col" class="text-center">Funcionario</th>
                    <th scope="col" class="text-center">Estado</th>
                </tr>
            </thead>

            <tbody class="text-center" id="tablaReservas">
                @foreach ($reservas as $reserva)
                @php
                    $funcionario = App\User::find($reserva->sipa_reservas_salas_funcionario); 
                @endphp
                    <tr id="{{$reserva->sipa_reserva_salas_id}}"> 
                        <td data-label="ID de reserva"> <b> {{$reserva->sipa_reserva_salas_id}} </b></td>
                        <td data-label="Fecha Inicial"> {{$reserva->sipa_reservas_salas_fecha_inicio}} </td>
                        <td data-label="Hora Inicial"> {{$reserva->sipa_reservas_salas_hora_inicio}} </td>
                        <td data-label="Fecha Final"> {{$reserva->sipa_reservas_salas_fecha_fin}} </td>
                        <td data-label="Hora Final"> {{$reserva->sipa_reservas_salas_hora_fin}} </td>
                        <td data-label="Funcionario"> {{$funcionario->sipa_usuarios_nombre}} </td>
                        <td data-label="Estado"> {{$reserva->sipa_reservas_sala_estado}} </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

@endsection