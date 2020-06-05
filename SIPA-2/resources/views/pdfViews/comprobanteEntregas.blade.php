@php

$insumos = App\AsignarInsumo::where('sipa_entrega_comprobante',null)->get();
$numeroComprobante = App\ComprobanteEntrega::orderBy('sipa_comprobantes_id','desc')->get();
$statement = DB::select("SHOW TABLE STATUS LIKE 'sipa_entregas_comprobantes'");
$nextId = $statement[0]->Auto_increment;
@endphp

<html>
    <h1 id="editarEstado" class="tituloModal">Comprobante de entrega de insumos</h1>
    
    <h3>Comprobante #{{$nextId}}</h3>
  
    <br>
    <table>
        <thead>
            <tr>
                <th style = "border: 1px solid black; border-collapse: collapse;" scope="col" class="text-center">Codigo del insumo</th>
                <th style = "border: 1px solid black; border-collapse: collapse;" scope="col" class="text-center">Nombre del insumo</th>
                <th style = "border: 1px solid black; border-collapse: collapse;" scope="col" class="text-center">Cantidad entregada</th>
                <th style = "border: 1px solid black; border-collapse: collapse;" scope="col" class="text-center">Fecha entregada</th>
                <th style = "border: 1px solid black; border-collapse: collapse;" scope="col" class="text-center">Entregado por</th>
                <th style = "border: 1px solid black; border-collapse: collapse;" scope="col" class="text-center">Entregado a</th>
            </tr>
        </thead>
        <tbody class="text-center" id="tablaReservas">
            @foreach ($insumos as $insumo)
            <tr id="{{$insumo->sipa_entrega_id}}"> 
                <td style = "border: 1px solid black; border-collapse: collapse;" data-label="Placa del activo">{{$insumo->insumo->sipa_insumos_codigo}}</td>
                <td style = "border: 1px solid black; border-collapse: collapse;" data-label="Nombre del activo">{{$insumo->insumo->sipa_insumos_nombre}}</td>
                <td style = "border: 1px solid black; border-collapse: collapse;" data-label="Fecha Inicial"> {{$insumo->sipa_entrega_cantidad}}</td>
                <td style = "border: 1px solid black; border-collapse: collapse;" data-label="Hora Inicial"> {{$insumo->created_at}}</td>
                <td style = "border: 1px solid black; border-collapse: collapse;" data-label="Fecha Final"> {{$insumo->entregadoPor->sipa_usuarios_nombre}}</td>
                <td style = "border: 1px solid black; border-collapse: collapse;" data-label="Hora Final"> {{$insumo->asignadoA->sipa_usuarios_nombre}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</html>