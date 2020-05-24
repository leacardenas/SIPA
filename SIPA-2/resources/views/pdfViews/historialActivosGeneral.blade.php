@php
$reservas = App\Reserva::all();
$numReservas = count($reservas);
@endphp

<html>
    <h1 id="editarEstado" class="tituloModal">Historial de Reservas de Activos</h1>
    <br>
    <table class="table table-striped table-hover" id="table-usuarios">
        <thead>
            <tr>
                <th style = "border: 1px solid black; border-collapse: collapse;" scope="col" class="text-center">Placa del activo</th>
                <th style = "border: 1px solid black; border-collapse: collapse;" scope="col" class="text-center">Nombre del activo</th>
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
            <b>No hay historial de reservas de activos</b>
           </tr>
        @else
        <tbody class="text-center" id="tablaReservas">
            @foreach ($reservas as $reserva)
            @php
              $activos = $reserva->activos;
              $funcionario = App\User::find($reserva->sipa_reservas_activos_funcionario); 
            @endphp
            <tr id="{{$reserva->sipa_reservas_activos_id}}"> 
                <td style = "border: 1px solid black; border-collapse: collapse;" data-label="Placa del activo">
                    @foreach($activos as $activo)
                    {{$activo->sipa_activos_codigo}}<br>
                    @endforeach </td>
                <td style = "border: 1px solid black; border-collapse: collapse;" data-label="Nombre del activo">
                    @foreach($activos as $activo)
                    {{$activo->sipa_activos_nombre}} <br>
                    @endforeach </th>
                </td>
                <td style = "border: 1px solid black; border-collapse: collapse;" data-label="Fecha Inicial"> {{$reserva->sipa_reservas_activos_fecha_inicio}}</td>
                <td style = "border: 1px solid black; border-collapse: collapse;" data-label="Hora Inicial"> {{$reserva->sipa_reservas_activos_hora_inicio}}</td>
                <td style = "border: 1px solid black; border-collapse: collapse;" data-label="Fecha Final"> {{$reserva->sipa_reservas_activos_fecha_fin}}</td>
                <td style = "border: 1px solid black; border-collapse: collapse;" data-label="Hora Final"> {{$reserva->sipa_reservas_activos_hora_fin}}</td>
                <td style = "border: 1px solid black; border-collapse: collapse;" data-label="Funcionario"> {{$funcionario->sipa_usuarios_nombre}}</td>
                <td style = "border: 1px solid black; border-collapse: collapse;" data-label="Estado"> {{$reserva->sipa_reserva_estado}}</td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</html>