
@php
$activos = App\Activo::all(); 
@endphp

<html>
    <h1 id="editarEstado" class="tituloModal">Historial de Activos Registrados</h1>

<table class="table table-striped" id="table-usuarios">
    <thead>
    <tr>
        <th style = "border: 1px solid black; border-collapse: collapse;"scope="col" class="text-center">Placa</th>
        <th style = "border: 1px solid black; border-collapse: collapse;"scope="col" class="text-center">Nombre</th>
        <th style = "border: 1px solid black; border-collapse: collapse;"scope="col" class="text-center">Estado</th>
        <th style = "border: 1px solid black; border-collapse: collapse;"scope="col" class="text-center">Tipo</th>
        <th style = "border: 1px solid black; border-collapse: collapse;"scope="col" class="text-center">Responsable</th>
        <th style = "border: 1px solid black; border-collapse: collapse;"scope="col" class="text-center">Encargado</th>
       
    </tr>
    </thead>

    <tbody class="text-center" id="tablaActivos">
    @if(count($activos) > 0)
   
    @foreach($activos as $activo)
    @php
    $enUso = "Activo";
    if($activo->sipa_activo_activo == 0){
        $enUso = "Dado de Baja";
    }
    $usabilidad = $activo->sipa_activo_usabilidad;
    @endphp
        <tr id="{{$activo->sipa_activos_id}}">
            <td style = "border: 1px solid black; border-collapse: collapse;"data-label="Placa"> <b>{{$activo->sipa_activos_codigo}}</b></td>
            <td style = "border: 1px solid black; border-collapse: collapse;"data-label="Nombre"> {{$activo->sipa_activos_nombre}} </td>
            <td style = "border: 1px solid black; border-collapse: collapse;"data-label="Estado"> {{$activo->sipa_activos_estado}}/{{$enUso}} </td>
            @if ($usabilidad == 0)
                <td style = "border: 1px solid black; border-collapse: collapse;"data-label="Tipo"> Para asignar </td>
            @else
                @if($usabilidad == 1)
                <td style = "border: 1px solid black; border-collapse: collapse;"data-label="Tipo"> Para prestamo </td>
                @else
                <td style = "border: 1px solid black; border-collapse: collapse;"data-label="Tipo"> Sin definir </td>
                @endif
            @endif
            <td style = "border: 1px solid black; border-collapse: collapse;"data-label="Responsable"> {{$activo->usuarioR->sipa_usuarios_nombre}} </td>
            <td style = "border: 1px solid black; border-collapse: collapse;"data-label="Encargado"> {{$activo->usuarioE->sipa_usuarios_nombre}} </td>
          
            @endforeach
            @else
            <div class="alerta mb-5">
                <i class="fas fa-exclamation-triangle"></i> No hay activos registrados en el sistema
            </div>
            @endif
        </tbody>
    </table>
</html>