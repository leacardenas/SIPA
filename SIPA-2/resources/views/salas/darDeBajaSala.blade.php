@extends('plantillas.inicio')
@section('content')
<div class="row col-sm-12">
    <form method="get" action="{{url('/informacionSalas')}}">
        <button type="submit" type="button" class="btn btn-secondary volver">
            <span class="glyphicon glyphicon-chevron-left"></span> Volver
        </button>
    </form>
</div>

<div class="row justify-content-center col-sm-12">
    <h1 id="editarEstado" class="tituloModal">Dar de baja una sala</h1>
</div>

<div class="row col-sm-12 justify-content-center configActivo">
    <form method="POST" action="{{ url('/darBajaSala') }}" class="configForm" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Número de Sala</label>
            <input name = "num_sala_input" type="text" class="form-control" id="num_sala_input" value = "{{$sala->sipa_salas_codigo}}" readonly>   
        </div>

        <div class="form-group">
            <label>Ingrese la razón por la que desea dar de baja esta sala</label>
            <textarea name = "razon_baja_sala" id="razon_baja_sala" class="form-control" type="text" rows="4" required></textarea>
        </div>

        <div class="form-group">
            <label>Seleccione el formulario de dar de baja de esta sala</label>
            <input class="form-control" type="file" name="formulario_sala" required>
        </div>
        
        <button class="btn btn-primary boton-config">Dar de baja</button>
    </form>
</div>

<script>
$('.configForm').submit(function(){
    Swal.fire({
            icon: 'success',
            title: '¡Realizado con éxito!',
            text: 'La sala se ha dado de baja correctamente',
            timer: 6000,
            showConfirmButton: false,
            showCloseButton: true,
            });
});
</script>
@endsection