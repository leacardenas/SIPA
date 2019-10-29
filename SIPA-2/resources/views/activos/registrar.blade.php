<div id="modalRegistrarActivo" class="modal">
    <div class="contenidoModal" id="contenidoRegistrar">
        <span class="cerrar" onclick="cerrarModal(event, 'modalRegistrarActivo')">&times;</span>
        <h1 id="registrarActivo">Registrar activo</h1>
        <div id="registrarActivoForm">
            @php
            $usuarios = App\User::all();
            $edificios = App\Edifico::all();
            $seleccionado = $edificios->get(0);
            $unidades = App\Unidad::where('sipa_edificios_unidades_edificio',$seleccionado->id);
            @endphp
            <script>
                function verificarResponsable(cedula) {
                    var url = "/verificar/" + cedula.value;
                    console.log(cedula.value);
                    fetch(url).then(r => {
                        return r.json();
                    }).then(d => {
                        var obj = JSON.stringify(d);
                        var obj2 = JSON.parse(obj);
                        console.log(obj2);
                        var responsable = document.getElementById('nomResponsableAct');
                        responsable.value = obj2.nombreUsuario;

                    });
                }

                function verificarEncargado(cedula) {
                    var url = "/verificar/" + cedula.value;
                    console.log(cedula.value);
                    fetch(url).then(r => {
                        return r.json();
                    }).then(d => {
                        var obj = JSON.stringify(d);
                        var obj2 = JSON.parse(obj);
                        console.log(obj2);
                        var encargado = document.getElementById('nomEncargadoAct');
                        encargado.value = obj2.nombreUsuario;

                    });

                }

                function actualizar(elemento) {
                    console.log('si entra');
                    var nom = elemento.options[elemento.selectedIndex].innerHTML;
                    console.log(nom);
                    var url = "/cbbx/" + nom;
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
                        seleccionUnPiso.innerHTML = "Seleccione una planta";
                        pisos.appendChild(seleccionUnPiso);

                        for (var i = 0; i < obj2.pisos; i++) {
                            var option = document.createElement('option');
                            option.innerHTML = i + 1;
                            pisos.appendChild(option);
                        }

                        var seleccionUnaUnidad = document.createElement('option');
                        seleccionUnaUnidad.innerHTML = "Seleccione una unidad";
                        unidades.appendChild(seleccionUnaUnidad);

                        for (var i = 0; i < obj2.items.length; i++) {
                            var option = document.createElement('option');
                            option.innerHTML = obj2.items[i];
                            unidades.appendChild(option);
                        }
                    });
                }
            </script>
            <form method="POST" action="{{ route('activos.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="placaActivo" id="labelPlacaActivo">Placa</label>
                    <input id="inputPlacaActivo" type="text" name="placaActivo" placeholder="Ingrese el número de placa del activo" required>
                </div>
                <div class="form-group">
                    <label for="nombreActivo" id="labelNombreActivo">Nombre</label>
                    <input id="nombreActivo" type="text" name="nombreActivo" placeholder="Ingrese el nombre del activo" required>
                </div>
                <div class="form-group">
                    <label for="estadoActivo" id="labelEstadoActivo">Estado</label>
                    <select id="estadoActivo" name="estadoActivo" required>
                        <option disabled selected value>Seleccione un estado</option>
                        <option value="0">Excelente</option>
                        <option value="1">Bueno</option>
                        <option value="2">Regular</option>
                        <option value="3">Con problemas</option>
                        <option value="4">Inutilizable</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="descripcionActivo" id="labelDescripcionActivo">Descripción</label>
                    <textarea rows="5" cols="70" id="descripcionActivo" type="text" name="descripcionActivo" placeholder="Ingrese la descripción del activo" required></textarea>
                </div>
                <!-- <div class="form-group">
                    <label for="estadoTextarea" id="labelEstadoTextarea">Estado</label><br>
                    <textarea rows="5" cols="70" id="estadoTextarea" name="estadoActivo" placeholder="Ingrese el estado actual del activo" required></textarea>
                </div> -->
                <div class="form-group">
                    <label for="marcaActivo" id="labelMarcaActivo">Marca</label>
                    <input id="inputMarcaActivo" type="text" placeholder="Ingrese la marca del activo" name="marcaActivo" required>
                </div>
                <div class="form-group">
                    <label for="modeloActivo" id="labelModeloActivo">Modelo</label>
                    <input id="inputModeloActivo" type="text" placeholder="Ingrese el modelo del activo" name="modeloActivo" required>
                </div>
                <div class="form-group">
                    <label for="serieActivo" id="labelSerieActivo">Serie</label>
                    <input id="inputSerieActivo" type="text" placeholder="Ingrese la serie del activo" name="serieActivo" required>
                </div>
                <div class="form-group">
                    <label for="precio" id="labelPrecioActivo">Precio</label>
                    <input id="precioActivo" type="number" name="precioActivo" placeholder="Ingrese el modelo del activo" min="30000" required>
                </div>
                <div class="form-group">
                    <label for="unidadActivo" id="labelUnidadActivo">Unidad</label>
                    <input id="inputUnidadActivo" type="text" placeholder="Ingrese la unidad del activo" name="unidadActivo" required>
                </div>
                <div class="form-group">
                    <label for="responsableActivo" id="labelResponsableActivo">Funcionario responsable</label>
                    <select onchange="verificarResponsable(this);" id="selectResponsableActivo" placeholder="Seleccione funcionario..." name="selectResponsableActivo">
                    <option disabled selected value>Seleccione un responsable</option>
                        @foreach($usuarios as $usuario)
                        <option value="{{$usuario->sipa_usuarios_identificacion}}">{{$usuario->sipa_usuarios_identificacion}} - {{$usuario->sipa_usuarios_nombre}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="responsableNombre" id="labelNomResponsableAct">Nombre del Responsable</label>
                    <input id="nomResponsableAct" type="text" name="nomResponsableAct" placeholder="Responsable del activo" readonly>
                </div>
                <div class="form-group">
                    <label for="encargadoActivo" id="labelEncargadoActivo">Funcionario encargado</label>
                    <select onchange="verificarEncargado(this);" id="selectEncargadoActivo" placeholder="Seleccione funcionario..." name="selectEncargadoActivo" required>
                    <option disabled selected value>Seleccione un encargado</option>
                        @foreach($usuarios as $usuario)
                        <option value="{{$usuario->sipa_usuarios_identificacion}}">{{$usuario->sipa_usuarios_identificacion}} - {{$usuario->sipa_usuarios_nombre}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="encargadoNombre" id="labelencargadoNombre">Nombre del Encargado</label>
                    <input id="nomEncargadoAct" type="text" name="nomEncargadoAct" placeholder="Encargado del activo" readonly>
                </div>
                <div class="form-group">
                    <label for="edificioActivo" id="labelEdificioActivo">Edificio</label>
                    <select onchange="actualizar(this);" id="selectEdificioActivo" placeholder="Seleccione edificio..." name="selectEdificioActivo" required>
                    <option disabled selected value>Seleccione un edificio</option>
                        @foreach($edificios as $edificio)
                        <option value="{{$edificio->sipa_edificios_nombre}}">{{$edificio->sipa_edificios_nombre}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="plantaActivo" id="labelPlantaActivo">Planta</label>
                    <select id="selectPlantaActivo" placeholder="Seleccione planta..." name="selectPlantaActivo" required>
                    <option disabled selected value>Seleccione una planta</option>
                        @for ($i = 0; $i < $seleccionado->sipa_edificios_cantidad_pisos; $i++)
                            <option value="{{$i+1}}">{{$i+1}}</option>
                            @endfor
                    </select>
                </div>
                <div class="form-group">
                    <label for="unidadEjecutoraActivo" id="labelUnidadEjecutoraActivo">Unidad Ejecutora</label>
                    <select id="selectUnidadEjecutoraActivo" placeholder="Seleccione unidad ejecutora..." name="selectUnidadEjecutoraActivo" required>
                        <option disabled selected value>Seleccione una unidad</option>
                        @foreach($unidades->cursor() as $unidad)
                        <option value="{{$unidad->sipa_edificios_unidades_nombre}}">{{$unidad->sipa_edificios_unidades_nombre}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="imagen" id="labelimagen">Imagen</label>
                    <input id="imagenAct" type="file" name="imagenAct" placeholder="Inserte la imagen del activo" required>
                </div>
                <button type="submit" class="btn btn-primary" id="registrarActivoBoton">
                    Registrar activo
                </button>
            </form>
        </div>
    </div>
</div>