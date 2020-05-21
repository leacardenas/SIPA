@php
$idFuncionario = session('idUsuario');
$funcionario = App\User::where('sipa_usuarios_identificacion',$idFuncionario)->get()[0];
$reservas = App\Reserva::where('sipa_reservas_activos_funcionario',$funcionario->sipa_usuarios_id)->get();
$numReservas = count($reservas);
@endphp

<html>
    <h1>Historial de reservas de Activos</h1>
    <br>
    <h1>Funcionario:</h1>
    <h3>{{$funcionario->sipa_usuarios_identificacion}}<br>
        {{$funcionario->sipa_usuarios_nombre}}<br>
    </h3>
    <table class="table table-striped table-hover" id="table-usuarios">
        <thead>
            <tr>
                <th style = "border: 1px solid black; border-collapse: collapse;" scope="col" class="text-center">Placa del activo</th>
                <th style = "border: 1px solid black; border-collapse: collapse;" scope="col" class="text-center">Nombre del activo</th>
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
            <b>No hay historial de reservas de activos</b>
           </tr>
        @else
            @foreach ($reservas as $reserva)
                @php
                    $activos = $reserva->activos;   
                @endphp

            <tr id=""> 
                <td style = "border: 1px solid black; border-collapse: collapse;" data-label="Placa del activo">
                    @foreach ($activos as $activo)
                    <b>{{$activo->sipa_activos_codigo}} </b> <br>
                    @endforeach </th> 
                </td>
                <td style = "border: 1px solid black; border-collapse: collapse;" data-label="Nombre del activo">
                    @foreach ($activos as $activo)
                    {{$activo->sipa_activos_nombre}} <br>
                    @endforeach 
                </td>
                <td style = "border: 1px solid black; border-collapse: collapse;" data-label="Fecha Inicial"> {{$reserva->sipa_reservas_activos_fecha_inicio}} </td>
                <td style = "border: 1px solid black; border-collapse: collapse;" data-label="Hora Inicial"> {{$reserva->sipa_reservas_activos_hora_inicio}} </td>
                <td style = "border: 1px solid black; border-collapse: collapse;" data-label="Fecha Final"> {{$reserva->sipa_reservas_activos_fecha_fin}}</td>
                <td style = "border: 1px solid black; border-collapse: collapse;" data-label="Hora Final"> {{$reserva->sipa_reservas_activos_hora_fin}} </td>
                <td style = "border: 1px solid black; border-collapse: collapse;" data-label="Estado"> {{$reserva->sipa_reserva_estado}} </td>
            </tr>
            @endforeach
        @endif
        </tbody>
    </table>
</html>