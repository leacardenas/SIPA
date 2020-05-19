@extends('plantillas.inicio')
@section('content')
@php
$reserva = App\Reserva::find($id);
$activos = $reserva->activos;   
$estados = App\estadoReservas::all();
@endphp
<div class="row col-sm-12">
    <form method="get" action="{{url('/devolucionActivo')}}">
        <button type="submit" type="button" class="btn btn-secondary volver">
            <span class="glyphicon glyphicon-chevron-left"></span> Volver
        </button>
    </form>
</div>

<div class="row justify-content-center col-sm-12">
    <h1 id="editarEstado" class="tituloModal">Devolución de Activos</h1>
</div>

<div class="row col-sm-12 justify-content-center configActivo">
    <form method="POST" action="{{ url('/devolucionActivos') }}" class="configForm" id="editarEncarg" enctype="multipart/form-data">
        <div class="form-group">
            <label>Observación</label>
            <textarea name = "observacion" class="form-control" rows="5" type="text" placeholder="Digite una observación sobre la devolución de los activos de esta reserva"></textarea>
        </div>
        
        <legend>Estado de Activos Devueltos</legend>

        <h4>Seleccione los activos que han sido devueltos</h4>
        
        <div class="form-group mt-5">
            @foreach ($activos as $activo)
                @php
                    $activoNoDevuelto = App\ActivosOcupados::where('sipa_activosOcupados_activo',$activo->sipa_activos_id)
                    ->where('sipa_activosOcupados_fi',$reserva->sipa_reservas_activos_fecha_inicio)
                    ->where('sipa_activosOcupados_hi',$reserva->sipa_reservas_activos_hora_inicio);
                @endphp
                    @if($activoNoDevuelto)
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="{{$activoNoDevuelto->activo->sipa_activos_id }}" name = "activosDevueltos[]">
                        <label class="ml-4 form-check-label" for= "{{$activoNoDevuelto->activo->sipa_activos_id }}">{{$activoNoDevuelto->activo->sipa_activos_codigo}} - {{$activoNoDevuelto->activo->sipa_activos_nombre}}</label>
                    </div>
                    
                    @endif
            @endforeach
                
            <div class=" mt-3 ml-4 row">
                <label>Estado actual del activo</label>
                <div class="col-sm-10">
                    <select class="form-control selectModal select2 w-25" id="estadoActivo" name="estadoActivo">
                        <option disabled selected value>Seleccione un estado</option>
                        @foreach ($estados as $estado)
                            <option value="{{$estado->sipa_estado_reservas_id }}">{{$estado->sipa_estado_reservas_estados}}</option>
                        @endforeach
                
                    </select>
                </div>
            </div>
        </div>
        <input type = "hidden" value = "{{$id}}" name ="reservaId">
        <button type="submit" class="btn botonLargo mt-4"> Guardar </button>

    </form>
</div>

<script>
    $(document).ready(function() {
    $('.select2').select2();
});
</script>
@endsection