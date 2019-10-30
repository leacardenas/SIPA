@extends('plantillas.inicio')

@section('content')
@php
$cedula = session('idUsuario');
$user = App\User::where('sipa_usuarios_identificacion',$cedula)->get()[0];
@endphp

<form method="get" action="{{url('/inventarioEquipos')}}">
    <button type="submit" type="button" class="btn btn-secondary">
        <span class="glyphicon glyphicon-circle-arrow-left"></span> Volver
    </button>
</form>

<h1 id="verActivo">Ver activo</h1>
<div id="verActivoForm">
    <div class="form-group">
        <label for="placaActivo" id="labelPlacaActivo">Placa</label>
        <input id="inputPlacaActivo" type="text" name="placaActivo" value="{{$activo->sipa_activos_codigo}}" disabled>
    </div>
    <div class="form-group">
        <label for="nombreActivo" id="labelNombreActivo">Nombre</label>
        <input id="nombreActivo" type="text" name="nombreActivo" value="{{$activo->sipa_activos_nombre}}" disabled>
    </div>
    <div class="form-group">
        <label for="estadoActivo" id="labelEstadoActivo">Estado</label>
        <select id="estadoActivo" name="estadoActivo" disabled>
            <option disabled selected value>
                <?php switch ($activo->sipa_activos_estado):
                    case 0: ?>
                        <div>
                            Excelente
                        </div>
                        <?php break; ?>
                    <?php
                    case 1: ?>
                        <div>
                            Bueno
                        </div>
                        <?php break; ?>
                    <?php
                    case 2: ?>
    </div>
    Regular
    <div>
        <?php break; ?>
    <?php
    case 3: ?>
        <div>
            Con problemas
        </div>
        <?php break; ?>
    <?php
    case 4: ?>
        <div>
            Inutilizable
        </div>
        <?php break; ?>
    <?php
    default: ?>
        <div>
            NA
        </div>
        <?php break; ?>
    <?php endswitch; ?>
    </div>
    </option>
    </select>
</div>
<div class="form-group">
    <label for="descripcionActivo" id="labelDescripcionActivo">Descripción</label>
                <br/>
    <textarea rows="5" cols="70" id="descripcionActivo" type="text" name="descripcionActivo" disabled>{{$activo->sipa_activos_descripcion}}</textarea>
</div>
<div class="form-group">
    <label for="marcaActivo" id="labelMarcaActivo">Marca</label>
    <input id="inputMarcaActivo" type="text" value="{{$activo->sipa_activos_marca}}" name="marcaActivo" disabled>
</div>
<div class="form-group">
    <label for="modeloActivo" id="labelModeloActivo">Modelo</label>
    <input id="inputModeloActivo" type="text" value="{{$activo->sipa_activos_modelo}}" name="modeloActivo" disabled>
</div>
<div class="form-group">
    <label for="serieActivo" id="labelSerieActivo">Serie</label>
    <input id="inputSerieActivo" type="text" value="{{$activo->sipa_activos_serie}}" name="serieActivo" disabled>
</div>
<div class="form-group">
    <label for="precio" id="labelPrecioActivo">Precio</label>
    <input id="precioActivo" type="number" name="precioActivo" value="{{$activo->sipa_activos_precio}}" min="30000" disabled>
</div>
<div class="form-group">
    <label for="responsableActivo" id="labelResponsableActivo">Funcionario responsable</label>
    <select id="selectResponsableActivo" name="selectResponsableActivo" disabled>
        @php
        $responsable = App\User::where('id',$activo->sipa_activos_responsable)->get()[0];
        @endphp
        <option disabled selected value>{{$responsable->sipa_usuarios_identificacion}} - {{$responsable->sipa_usuarios_nombre}}</option>
    </select>
</div>
<div class="form-group">
    <label for="encargadoActivo" id="labelEncargadoActivo">Funcionario encargado</label>
    <select id="selectEncargadoActivo" value="{{$activo->sipa_activos_encargado}}" name="selectEncargadoActivo" disabled>
        @php
        $encargado = App\User::where('id',$activo->sipa_activos_encargado)->get()[0];
        @endphp
        <option disabled selected value>{{$encargado->sipa_usuarios_identificacion}} - {{$encargado->sipa_usuarios_nombre}}</option>
    </select>
</div>
<div class="form-group">
    <label for="edificioActivo" id="labelEdificioActivo">Edificio</label>
    <select onchange="actualizar(this);" id="selectEdificioActivo" value={{$activo->sipa_activos_codigo}}" name="selectEdificioActivo" disabled>
        @php
        $edificio = App\Edifico::where('id',$activo->sipa_activos_edificio)->get()[0];
        @endphp
        <option disabled selected value>{{$edificio->sipa_edificios_nombre}}</option>
    </select>
</div>
<div class="form-group">
    <label for="plantaActivo" id="labelPlantaActivo">Planta</label>
    <select id="selectPlantaActivo" value="{{$activo->sipa_activos_codigo}}" name="selectPlantaActivo" disabled>
        <option disabled selected value>{{$activo->sipa_activos_piso_edificio}}</option>
    </select>
</div>
<div class="form-group">
    <label for="unidadEjecutoraActivo" id="labelUnidadEjecutoraActivo">Unidad Ejecutora</label>
    <select id="selectUnidadEjecutoraActivo" value="{{$activo->sipa_activos_codigo}}" name="selectUnidadEjecutoraActivo" disabled>
        @php
        $unidad = App\Unidad::where('sipa_edificios_unidades_id',$activo->sipa_activos_unidad)->get()[0];
        @endphp
        <option disabled selected value>{{$unidad->sipa_edificios_unidades_nombre}}</option>
    </select>
</div>
<div class="form-group">
    <!-- <label for="imagen" id="labelimagen">Imagen</label>
    <img src="<?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $activo->sipa_activos_foto ).'"/>';?>"/> -->
</div>

@endsection