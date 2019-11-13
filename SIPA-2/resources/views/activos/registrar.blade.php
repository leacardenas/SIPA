<div id="modalRegistrarActivo" class="modal">
    <div class="contenidoModal" id="contenidoRegistrar">
            <div class="divTituloModal" id="registrarTitulo">
                    <span class="cerrar" onclick="cerrarModal(event, 'modalRegistrarActivo')">&times;</span>
                    <h1 id="registrarActivo" class="tituloModal">Registrar activo</h1>
            </div>
        <div id="registrarActivoForm">
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
                        @foreach($estados as $estado)
                        <option value="{{$estado->sipa_estado_activo_id}}">{{$estado->sipa_estado_activo_nombre}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="descripcionActivo" id="labelDescripcionActivo">Descripción</label>
                    <textarea rows="5" cols="70" id="descripcionActivo" type="text" name="descripcionActivo" placeholder="Ingrese la descripción del activo" required></textarea>
                </div>
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
                    <label for="responsableActivo" id="labelResponsableActivo">Funcionario responsable</label>
                    <select id="selectResponsableActivo" placeholder="Seleccione funcionario..." name="selectResponsableActivo">
                        <option disabled selected value>Seleccione un responsable</option>
                        @foreach($usuarios as $usuario)
                        <option value="{{$usuario->sipa_usuarios_identificacion}}">{{$usuario->sipa_usuarios_identificacion}} - {{$usuario->sipa_usuarios_nombre}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="encargadoActivo" id="labelEncargadoActivo">Funcionario encargado</label>
                    <select id="selectEncargadoActivo" placeholder="Seleccione funcionario..." name="selectEncargadoActivo" required>
                        <option disabled selected value>Seleccione un encargado</option>
                        @foreach($usuarios as $usuario)
                        <option value="{{$usuario->sipa_usuarios_identificacion}}">{{$usuario->sipa_usuarios_identificacion}} - {{$usuario->sipa_usuarios_nombre}}</option>
                        @endforeach
                    </select>
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