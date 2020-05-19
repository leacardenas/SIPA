@extends('plantillas.inicio')
@section('content')

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
    <form method="POST" action="{{ url('/devolucionActivo') }}" class="configForm" id="editarEncarg" enctype="multipart/form-data">
        <div class="form-group">
            <label>Observación</label>
            <textarea name = "observacion" class="form-control" rows="5" type="text" placeholder="Digite una observación sobre la devolución de los activos de esta reserva"></textarea>
        </div>
        
        <legend>Estado de Activos Devueltos</legend>

        <h4>Seleccione los activos que han sido devueltos</h4>

        <div class="form-group mt-5">
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="{id activo}">
                <label class="ml-4 form-check-label" for="{id activo}">Codigo de activo - Nombre de activo</label>
            </div>

            <div class=" mt-3 ml-4 row">
                <label>Estado actual del activo</label>
                <div class="col-sm-10">
                    <select class="form-control selectModal select2 w-25" id="estadoActivo" name="estadoActivo">
                        <option disabled selected value>Seleccione un estado</option>
            
                        <option value=""></option>
                
                    </select>
                </div>
            </div>
        </div>
        
        <button type="submit" class="btn botonLargo mt-4"> Guardar </button>

    </form>
</div>

<script>
    $(document).ready(function() {
    $('.select2').select2();
});
</script>
@endsection