@php
$reservas = App\ReservaSala::all();
$numReservas = count($reservas);
@endphp

<html>
    <h1 id="editarEstado" class="tituloModal">Historial de Reservas de Salas </h1>
    <br>
    <table class="table table-striped table-hover" id="table-usuarios">
        <thead>
            <tr>
                <th style = "border: 1px solid black; border-collapse: collapse;" scope="col" class="text-center">Número de sala</th>
                <th style = "border: 1px solid black; border-collapse: collapse;" scope="col" class="text-center">Ubicación de sala</th>
                <th style = "border: 1px solid black; border-collapse: collapse;" scope="col" class="text-center">Fecha Inicial</th>
                <th style = "border: 1px solid black; border-collapse: collapse;" scope="col" class="text-center">Hora Inicial</th>
                <th style = "border: 1px solid black; border-collapse: collapse;" scope="col" class="text-center">Fecha Final</th>
                <th style = "border: 1px solid black; border-collapse: collapse;" scope="col" class="text-center">Hora Final</th>
                <th style = "border: 1px solid black; border-collapse: collapse;" scope="col" class="text-center">Funcionario</th>
                <th style = "border: 1px solid black; border-collapse: collapse;" scope="col" class="text-center">Estado</th>
            </tr>
        </thead>
        @if ($numReservas == 0)
            <tr>
             <b>No hay historial de reservas de salas</b>
            </tr>
        @else
        <tbody class="text-center" id="tablaReservas">
            @foreach ($reservas as $reserva)
            @php
              $salas = $reserva->salas;
              $funcionario = App\User::find($reserva->sipa_reservas_salas_funcionario); 
            @endphp
            <tr id="{{$reserva->sipa_reservas_activos_id}}"> 
                <td style = "border: 1px solid black; border-collapse: collapse;" data-label="Placa del activo">
                    @foreach($salas as $sala)
                    Sala {{$sala->sipa_salas_codigo}}<br>
                    @endforeach </td>
                <td style = "border: 1px solid black; border-collapse: collapse;" data-label="Nombre del activo">
                    @foreach($salas as $sala)
                    {{$sala->sipa_sala_ubicacion}} <br>
                    @endforeach </th>
                </td>
                <td style = "border: 1px solid black; border-collapse: collapse;" data-label="Fecha Inicial"> {{$reserva->sipa_reservas_salas_fecha_inicio}} </td>
                <td style = "border: 1px solid black; border-collapse: collapse;" data-label="Hora Inicial"> {{$reserva->sipa_reservas_salas_hora_inicio}} </td>
                <td style = "border: 1px solid black; border-collapse: collapse;" data-label="Fecha Final"> {{$reserva->sipa_reservas_salas_fecha_fin}} </td>
                <td style = "border: 1px solid black; border-collapse: collapse;" data-label="Hora Final"> {{$reserva->sipa_reservas_salas_hora_fin}} </td>
                <td style = "border: 1px solid black; border-collapse: collapse;" data-label="Funcionario"> {{$funcionario->sipa_usuarios_nombre}} </td>
                <td style = "border: 1px solid black; border-collapse: collapse;" data-label="Estado"> {{$reserva->sipa_reservas_sala_estado}} </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</html>