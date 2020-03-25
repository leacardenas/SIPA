@extends('plantillas.inicio')

@section('content')
<div class="row col-sm-12">
    <form method="get" action="{{url('/inventarioEquipos')}}">
        <button type="submit" type="button" class="btn btn-secondary volver">
            <span class="glyphicon glyphicon-chevron-left"></span> Volver
        </button>
    </form>
</div>

<div class="row justify-content-center col-sm-12">
    <h1 id="registrarActivo" class="tituloModal">Registrar activo</h1>
</div>

<div class="row col-sm-12 justify-content-center configActivo">
    @php 
    // <!--cambiar -->
    $usuarios = App\User::all();
    $edificios = App\Edifico::all();
    $seleccionado = $edificios->get(0);
    $unidades = App\Unidad::where('sipa_edificios_unidades_edificio',$seleccionado->id);
    $estados = App\EstadoActivo::orderBy('sipa_estado_activo_orden', 'ASC')->get();
    @endphp

    <form method="POST" action="{{ route('activos.store') }}" enctype="multipart/form-data" class="configForm">
        @csrf
        <div class="form-group">
            <label for="placaActivo" id="labelPlacaActivo">Placa</label>
            <br>
            <input class="form-control modal-input" id="inputPlacaActivo" type="text" name="placaActivo" placeholder="Ingrese el número de placa del activo" required>
        </div>
        <div class="form-group">
            <label for="nombreActivo" id="labelNombreActivo">Nombre</label>
            <br>
            <input class=" form-control modal-input" id="nombreActivo" type="text" name="nombreActivo" placeholder="Ingrese el nombre del activo" required>
        </div>
        <div class="form-group">
            <label for="estadoActivo" id="labelEstadoActivo">Estado</label>
            <br>
            <select class="form-control modal-select" id="estadoActivo" name="estadoActivo" required>
                <option disabled selected value>Seleccione un estado</option>
                @foreach($estados as $estado)
                <option value="{{$estado->sipa_estado_activo_nombre}}">{{$estado->sipa_estado_activo_nombre}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="descripcionActivo" id="labelDescripcionActivo">Descripción</label>
            <br>
            <textarea class="form-control modal-textarea" rows="5" id="descripcionActivo" type="text" name="descripcionActivo" placeholder="Ingrese la descripción del activo" required></textarea>
        </div>
        <div class="form-group">
            <label for="marcaActivo" id="labelMarcaActivo">Marca</label>
            <br>
            <input class="form-control modal-input" id="inputMarcaActivo" type="text" placeholder="Ingrese la marca del activo" name="marcaActivo" required>
        </div>
        <div class="form-group">
            <label for="modeloActivo" id="labelModeloActivo">Modelo</label>
            <br>
            <input class="form-control modal-input" id="inputModeloActivo" type="text" placeholder="Ingrese el modelo del activo" name="modeloActivo" required>
        </div>
        <div class="form-group">
            <label for="serieActivo" id="labelSerieActivo">Serie</label>
            <br>
            <input class="form-control modal-input" id="inputSerieActivo" type="text" placeholder="Ingrese la serie del activo" name="serieActivo" required>
        </div>
        <div class="form-group">
            <label for="precio" id="labelPrecioActivo">Precio</label>
            <br>
            <input class="form-control modal-input" id="precioActivo" type="text" name="precioActivo" placeholder="30.000" required>
        </div>
        <script>
                $("#precioActivo").mask('###.###.###.###.###.##0', {reverse: true});
        </script>

        <div class="form-group">
            <label for="responsableActivo" id="labelResponsableActivo">Funcionario responsable</label>
            <br>
            <select class="form-control modal-select" id="selectResponsableActivo" placeholder="Seleccione funcionario..." name="selectResponsableActivo">
                <option disabled selected value>Seleccione un responsable</option>
                @foreach($usuarios as $usuario)
                <option value="{{$usuario->sipa_usuarios_identificacion}}">{{$usuario->sipa_usuarios_identificacion}} - {{$usuario->sipa_usuarios_nombre}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="encargadoActivo" id="labelEncargadoActivo">Funcionario encargado</label>
            <br>
            <select class="form-control modal-select" id="selectEncargadoActivo" placeholder="Seleccione funcionario..." name="selectEncargadoActivo" required>
                <option disabled selected value>Seleccione un encargado</option>
                @foreach($usuarios as $usuario)
                <option value="{{$usuario->sipa_usuarios_identificacion}}">{{$usuario->sipa_usuarios_identificacion}} - {{$usuario->sipa_usuarios_nombre}}</option>
                @endforeach
            </select>
        </div>
        <br>
        <legend>Ubicación del activo</legend>
        <div class="form-group">
            <label for="edificioActivo" id="labelEdificioActivo">Edificio</label>
            <br>
            <select class="form-control modal-select" onchange="actualizar(this);" id="selectEdificioActivo" placeholder="Seleccione edificio..." name="selectEdificioActivo" required>
                <option disabled selected value>Seleccione un edificio</option>
                @foreach($edificios as $edificio)
                <option value="{{$edificio->sipa_edificios_nombre}}">{{$edificio->sipa_edificios_nombre}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="plantaActivo" id="labelPlantaActivo">Planta</label>
            <br>
            <select class="form-control modal-select" id="selectPlantaActivo" placeholder="Seleccione planta..." name="selectPlantaActivo" required>
                <option disabled selected value>Seleccione una planta</option>
                @for ($i = 0; $i < $seleccionado->sipa_edificios_cantidad_pisos; $i++)
                    <option value="{{$i+1}}">{{$i+1}}</option>
                    @endfor
            </select>
        </div>
        <div class="form-group">
            <label for="unidadEjecutoraActivo" id="labelUnidadEjecutoraActivo">Unidad Ejecutora</label>
            <br>
            <select class="form-control modal-select" id="selectUnidadEjecutoraActivo" placeholder="Seleccione unidad ejecutora..." name="selectUnidadEjecutoraActivo" required>
                <option disabled selected value>Seleccione una unidad</option>
                @foreach($unidades->cursor() as $unidad)
                <option value="{{$unidad->sipa_edificios_unidades_nombre}}">{{$unidad->sipa_edificios_unidades_nombre}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="imagen" id="labelimagen">Imagen</label>
            <br>
            <img id="blah" src="#" alt="your image" style="display:none" width="50%"/>
            <input class="form-control modal-input" id="imagenAct" type="file" name="imagenAct" placeholder="Inserte la imagen del activo" onchange="readURL(this);" required>
        </div>
        <div class="form-group">
            <label for="pdfAct" id="labelpdf">Seleccione el documento del registro del activo</label>
            <input class="form-control modal-input" id="inputpdfAct" type="file"  name="inputpdfAct" placeholder="Inserte un archivo pdf">
            <small>Debe seleccionar un archivo .pdf</small>
        </div>
        
        <button type="submit" class="btn btn-primary boton-config" id="registrarActivoBoton">
            Guardar
        </button>
    </form>

<script>
function actualizar(elemento) {
    console.log('si entra');
    var nom = elemento.options[elemento.selectedIndex].innerHTML;
    console.log(nom);
    var url = "cbbx/" + nom;
    fetch(url).then(r => {
        console.log(r);
        return r.json();
    }).then(d => {
        var obj = JSON.stringify(d);
        var obj2 = JSON.parse(obj);
        console.log(obj2);
        var pisos = document.getElementById('selectPlantaActivo');
        var unidades = document.getElementById('selectUnidadEjecutoraActivo');
        for (var i = pisos.length - 1; i >= 0; i--) {
            pisos.remove(i);
        }
        for (var i = unidades.length - 1; i >= 0; i--) {
            unidades.remove(i);
        }
        var seleccionUnPiso = document.createElement('option');

        for (var i = 0; i < obj2.pisos; i++) {
            var option = document.createElement('option');
            option.innerHTML = i + 1;
            pisos.appendChild(option);
        }

        var seleccionUnaUnidad = document.createElement('option');

        for (var i = 0; i < obj2.items.length; i++) {
            var option = document.createElement('option');
            option.innerHTML = obj2.items[i];
            unidades.appendChild(option);
        }
    });
}

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function(e) {
            $('#blah').attr('src', e.target.result);
        }
        document.getElementById("blah").style.display = "";
        reader.readAsDataURL(input.files[0]);
    }
}
</script>

@endsection