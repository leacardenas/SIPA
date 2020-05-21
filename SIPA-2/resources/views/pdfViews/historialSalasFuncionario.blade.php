@php
$idFuncionario = session('idUsuario');
$funcionario = App\User::where('sipa_usuarios_identificacion',$idFuncionario)->get()[0];   
$reservas = App\ReservaSala::where('sipa_reservas_salas_funcionario',$funcionario->sipa_usuarios_id)->get();
$numReservas = count($reservas);
@endphp

<html>
    <h1>Historial de reservas de Salas</h1>
    <br>
    <h1>Funcionario:</h1>
    <h3>{{$funcionario->sipa_usuarios_identificacion}}<br>
        {{$funcionario->sipa_usuarios_nombre}}<br>
    </h3>
    <table class="table table-striped table-hover" id="table-usuarios">
        <thead>
            <tr>
                <th style = "border: 1px solid black; border-collapse: collapse;" scope="col" class="text-center">Número de sala</th>
                <th style = "border: 1px solid black; border-collapse: collapse;" scope="col" class="text-center">Ubicación de sala</th>
                <th style = "border: 1px solid black; border-collapse: collapse;" scope="col" class="text-center">Fecha Inicial</th>
                <th style = "border: 1px solid black; border-collapse: collapse;" scope="col" class="text-center">Hora Inicial</th>
                <th style = "border: 1px solid black; border-collapse: collapse;" scope="col" class="text-center">Fecha Final</th>
                <th style = "border: 1px solid black; border-collapse: collapse;" scope="col" class="text-center">Hora Final</th>
                <th style = "border: 1px solid black; border-collapse: collapse;" scope="col" class="text-center">Estado</th>
            </tr>
        </thead>

        <tbody class="text-center" id="tablaReservas">
        @if ($numReservas == 0)
            <tr>
            <b>No hay historial de reservas de salas</b>
            </tr>
        @else
            @foreach ($reservas as $reserva)
                @php
                    $salas = $reserva->salas;   
                @endphp
            <tr id="{{$reserva->sipa_reserva_salas_id}}"> 
                <td style = "border: 1px solid black; border-collapse: collapse;" data-label="Número de sala"> 
                    @foreach ($salas as $sala)
                    <b> Sala {{$sala->sipa_salas_codigo}} </b> <br>
                    @endforeach
                </td>
                <td style = "border: 1px solid black; border-collapse: collapse;" data-label="Ubicación de sala">
                    @foreach ($salas as $sala)
                        {{$sala->sipa_sala_ubicacion}} <br>
                    @endforeach 
                </td>
                <td style = "border: 1px solid black; border-collapse: collapse;" data-label="Fecha Inicial"> {{$reserva->sipa_reservas_salas_fecha_inicio}} </td>
                <td style = "border: 1px solid black; border-collapse: collapse;" data-label="Hora Inicial"> {{$reserva->sipa_reservas_salas_hora_inicio}} </td>
                <td style = "border: 1px solid black; border-collapse: collapse;" data-label="Fecha Final"> {{$reserva->sipa_reservas_salas_fecha_fin}} </td>
                <td style = "border: 1px solid black; border-collapse: collapse;" data-label="Hora Final"> {{$reserva->sipa_reservas_salas_hora_fin}} </td>
                <td style = "border: 1px solid black; border-collapse: collapse;" data-label="Estado">{{$reserva->sipa_reservas_sala_estado}}</td>
            </tr>
            @endforeach
        @endif
        </tbody>
    </table>
</html>