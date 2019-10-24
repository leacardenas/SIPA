<div id="modalRegistrarActivo" class="modal">
    <div class="contenidoModal" id="contenidoRegistrar">
        <span class="cerrar" onclick="cerrarModal(event, 'modalRegistrarActivo')">&times;</span>
        <h1 id="registrarActivo">Registrar activo</h1>
        <div id="registrarActivoForm">
            @php
            $usuarios = App\User::all();
            $edificios = App\Edifico::all();
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
            </script>
            <form method="POST" action="{{ route('activos.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="placaActivo" id="labelPlacaActivo">Placa</label>
                    <input id="inputPlacaActivo" type="text" name="placaActivo" placeholder="Ingrese el número de placa del activo">
                </div>
                <div class="form-group">
                    <label for="nombreActivo" id="labelNombreActivo">Nombre del activo</label>
                    <input id="nombreActivo" type="text" name="nombreActivo" placeholder="Ingrese el nombre del activo">
                </div>
                <div class="form-group">
                    <label for="nombreResponsable" id="labelNombreResponsable">Estado de
                        activo</label><br>
                    <textarea rows="10" cols="98" id="estadoTextarea" name="estadoActivo" placeholder="Ingrese el estado actual del activo"></textarea>
                </div>
                <div class="form-group">
                    <label for="descripcionActivo" id="labelDescripcionActivo">Descripción del activo</label>
                    <input id="descripcionActivo" type="text" name="descripcionActivo" placeholder="Ingrese la descripción del activo">
                </div>
                <div class="form-group">
                    <label for="marcaActivo" id="labelMarcaActivo">Marca</label>
                    <input id="inputMarcaActivo" type="text" placeholder="Ingrese la marca del activo" name="marcaActivo">
                </div>
                <div class="form-group">
                    <label for="modeloActivo" id="labelModeloActivo">Modelo</label>
                    <input id="inputModeloActivo" type="text" placeholder="Ingrese el modelo del activo" name="modeloActivo">
                </div>
                <div class="form-group">
                    <label for="serieActivo" id="labelSerieActivo">Serie</label>
                    <input id="inputSerieActivo" type="text" placeholder="Ingrese la serie del activo" name="serieActivo">
                </div>
                <div class="form-group">
                    <label for="precio" id="labelPrecioActivo">Precio</label>
                    <input id="precioActivo" type="number" name="precioActivo" placeholder="Ingrese el modelo del activo" min="30000">
                </div>
                <div class="form-group">
                    <label for="unidadActivo" id="labelUnidadActivo">Unidad</label>
                    <input id="inputUnidadActivo" type="text" placeholder="Ingrese la unidad del activo" name="unidadActivo">
                </div>
                <div class="form-group">
                    <label for="responsableActivo" id="labelResponsableActivo">Funcionario responsable del activo</label>
                    <select onchange="verificarResponsable(this);" id="selectResponsableActivo" placeholder="Seleccione funcionario..." name="selectResponsableActivo">
                        <option></option>
                        @foreach($usuarios as $usuario)
                        <option value="{{$usuario->sipa_usuarios_identificacion}}">{{$usuario->sipa_usuarios_identificacion}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="responsableNombre" id="labelNomResponsableAct">Nombre del Responsable</label>
                    <input id="nomResponsableAct" type="text" name="nomResponsableAct" placeholder="Responsable del activo" readonly>
                </div>
                <div class="form-group">
                    <label for="encargadoActivo" id="labelEncargadoActivo">Funcionario encargado del activo</label>
                    <select onchange="verificarEncargado(this);" id="selectEncargadoActivo" placeholder="Seleccione funcionario..." name="selectEncargadoActivo">
                        <option></option>
                        @foreach($usuarios as $usuario)
                        <option value="{{$usuario->sipa_usuarios_identificacion}}">{{$usuario->sipa_usuarios_identificacion}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="encargadoNombre" id="labelencargadoNombre">Nombre del Encargado</label>
                    <input id="nomEncargadoAct" type="text" name="nomEncargadoAct" placeholder="Encargado del activo" readonly>
                </div>
                <div class="form-group">
                    <label for="unidadEjecutoraActivo" id="labelUnidadEjecutoraActivo">Unidad Ejecutora</label>
                    <select id="selectUnidadEjecutoraActivo" placeholder="Seleccione unidad ejecutora...">
                        <option value="volvo">Volvo</option>
                        <option value="saab">Saab</option>
                        <option value="mercedes">Mercedes</option>
                        <option value="audi">Audi</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="edificioActivo" id="labelEdificioActivo">Edificio</label>
                    <select id="selectEdificioActivo" placeholder="Seleccione edificio...">
                        <option></option>
                        @foreach($edificios as $edificio)
                        <option value="{{$edificio->sipa_edificios_nombre}}">{{$edificio->sipa_edificios_nombre}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="plantaActivo" id="labelPlantaActivo">Planta</label>
                    <select id="selectPlantaActivo" placeholder="Seleccione planta...">
                        <option value="volvo">Volvo</option>
                        <option value="saab">Saab</option>
                        <option value="mercedes">Mercedes</option>
                        <option value="audi">Audi</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="ubicacionActivo" id="labelUbicacionActivo">Ubicación</label>
                    <select id="selectUbicacionActivo" placeholder="Seleccione ubicación...">
                        <option value="volvo">Volvo</option>
                        <option value="saab">Saab</option>
                        <option value="mercedes">Mercedes</option>
                        <option value="audi">Audi</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="imagen" id="labelimagen">Imagen del Activo</label>
                    <input id="imagenAct" type="file" name="imagenAct" placeholder="Inserte la imagen del activo">
                </div>
                <button type="submit" class="btn btn-primary" id="registrarActivoBoton">
                    Registrar activo
                </button>
            </form>
        </div>
    </div>
</div>