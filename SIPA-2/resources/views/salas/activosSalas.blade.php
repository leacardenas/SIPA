@extends('plantillas.inicio')
@section('content')

<div class="row col-sm-12">
    <form method="get" action="{{url('/configuraciones')}}">
    <button type="submit" type="button" class="btn btn-secondary volver">
        <span class="glyphicon glyphicon-chevron-left"></span> Volver
    </button>
    </form>
</div>

<div class="row justify-content-center col-sm-12">
    <h1 id="editarEstado" class="tituloModal">Asignar activos a salas</h1>
</div>

<div class="row col-sm-12 justify-content-center">
 @php
 $salas = App\Sala::all();
 $activos = App\Activo::all();
 @endphp

    <form class="configForm">
    @csrf
        <div class="form-group">
            <label>Seleccione la sala</label>
            <select class="form-control">
                <option disabled selected value>Seleccione la sala</option>
                @foreach($salas as $sala)
                <option value="{{$sala->sipa_salas_codigo}}">Sala #{{$sala->sipa_salas_codigo}}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn boton-config">Guardar</button>
    </form>
</div>

@endsection