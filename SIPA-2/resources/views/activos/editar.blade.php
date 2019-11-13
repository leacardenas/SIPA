@extends('plantillas.inicio')

@section('ruta')
<p id="rol" class="navbar-text navbar-center">Editar Activos</p>
@stop

@section('content')

<form method="get" action="{{url('/inventarioEquipos')}}">
    <button type="submit" type="button" class="btn btn-secondary">
        <span class="glyphicon glyphicon-circle-arrow-left"></span> Volver
    </button>
</form>

<div id="cuadros">
    <div class="cuadro">
        <button type="button" class="cuadrado" id="botonCuadrado" onclick="abrirModal(event, 'modalResponsable')"><img src="imagenes/man-in-office-desk-with-computer.png"></button>
        <p>Editar responsable de activo</p>
        <div id="modalResponsable" class="modal">
            <div class="contenidoModal" id="contenidoResponsable">
                <div class="divTituloModal">
                    <span class="cerrar" onclick="cerrarModal(event, 'modalResponsable')">&times;</span>
                    <h1 id="editarResponsable" class="tituloModal">Editar responsable de activo</h1>
                </div>
                <div id="editarResponsableForm" class="modalBody">
                    @php
                    $usuarios = App\User::all();
                    $activos = App\Activo::all();
                    $edificios = App\Edifico::all();
                    $seleccionado = $edificios->get(0);
                    $unidades = App\Unidad::where('sipa_edificios_unidades_edificio',$seleccionado->id);
                    $estados = App\EstadoActivo::all();
                    @endphp
                    <script>
                        function verificarResponsable(elemento) {
                            var url = "verificar/" + elemento.value;
                            console.log(elemento.value);
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

                        function verificarEncargado(elemento, elemento2) {
                            var url = "verificar/" + elemento.value;
                            console.log(elemento.value);
                            fetch(url).then(r => {
                                return r.json();
                            }).then(d => {
                                var obj = JSON.stringify(d);
                                var obj2 = JSON.parse(obj);
                                console.log(obj2);
                                if (elemento2.id == 'labelNombreEncargado') {
                                    var encargado = document.getElementById('nomEncargadoAct');
                                    encargado.value = obj2.nombreUsuario;
                                } else if (elemento2.id == 'labeltrasladoFun') {
                                    var encargado = document.getElementById('nomEncargadoAct2');
                                    encargado.value = obj2.nombreUsuario;
                                }

                            });
                        }

                        function verficarActv(elemento, elemento2) {
                            var url = "verificarAct/" + elemento.value;
                            console.log(elemento.value);
                            fetch(url).then(r => {
                                return r.json();
                            }).then(d => {
                                var obj = JSON.stringify(d);
                                var obj2 = JSON.parse(obj);
                                console.log(obj2);
                                if (elemento2.id == 'editarRespon') {
                                    var activo = document.getElementById('nombreActivo');
                                    activo.value = obj2.nombreActivo;
                                } else if (elemento2.id == 'editarEncarg') {
                                    var activo = document.getElementById('nombreActivo2');
                                    activo.value = obj2.nombreActivo;
                                } else if (elemento2.id == 'editEstado') {
                                    var activo = document.getElementById('nombreActivo3');
                                    activo.value = obj2.nombreActivo;
                                } else if (elemento2.id == 'darDeBaja') {
                                    var activo = document.getElementById('nombreActivo4');
                                    activo.value = obj2.nombreActivo;
                                } else if (elemento2.id == 'labelActivoUbicacion') {
                                    var activo = document.getElementById('activoUbicacion');
                                    activo.value = obj2.nombreActivo;
                                }

                            });
                        }

                        function actualizar(elemento) {
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
                                var pisos = document.getElementById('planta');
                                var unidades = document.getElementById('unidadEjecutora');
                                for (var i = pisos.length - 1; i >= 0; i--) {
                                    pisos.remove(i);
                                }
                                for (var i = unidades.length - 1; i >= 0; i--) {
                                    unidades.remove(i);
                                }
                                var defaultOption = document.createElement('option');
                                pisos.appendChild(defaultOption);
                                unidades.appendChild(defaultOption);
                                for (var i = 0; i < obj2.pisos; i++) {
                                    var option = document.createElement('option');
                                    option.innerHTML = i + 1;
                                    pisos.appendChild(option);
                                }
                                for (var i = 0; i < obj2.items.length; i++) {
                                    var option = document.createElement('option');
                                    option.innerHTML = obj2.items[i];
                                    unidades.appendChild(option);
                                }
                            });
                        }
                    </script>
                    <form id="editarRespon" method="POST" action="{{ url('/editaResp') }}">
                        @csrf
                        <div class="form-group">
                            <label for="nombreActivo" id="labelNombreActivo" name="nombreActivo">Seleccione el activo
                                que desea
                                editar</label>
                            <select onchange="verficarActv(this,document.getElementById('editarRespon'));" id="selectActivoResponsable" placeholder="Seleccione activo..." name="selectActivoResponsable" required>
                                <option disabled selected value>Seleccione una opción</option>
                                @foreach($activos as $activo)
                                <option value="{{$activo->sipa_activos_codigo}}">{{$activo->sipa_activos_codigo}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nombreActivo" id="labelNombreActivo">Nombre del activo</label>
                            <input id="nombreActivo" type="text" name="nombreActivo" placeholder="Nombre del activo" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nombreResponsable" id="labelNombreResponsable" name="labelNombreResponsable">Nuevo funcionario
                                responsable</label>
                            <select onchange="verificarResponsable(this);" id="nombreResponsable" placeholder="Seleccione funcionario..." name="nombreResponsable" required>
                                <option disabled selected value>Seleccione una opción</option>
                                @foreach($usuarios as $usuario)
                                <option value="{{$usuario->sipa_usuarios_identificacion}}">
                                    {{$usuario->sipa_usuarios_identificacion}} - {{$usuario->sipa_usuarios_nombre}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="responsableNombre" id="labelNomResponsableAct">Nombre del Responsable</label>
                            <input id="nomResponsableAct" type="text" name="nomResponsableAct" placeholder="Responsable del activo" readonly>
                        </div>
                        <button type="submit" class="btn btn-primary" id="responsableBoton">
                            Guardar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="cuadro">
        <button type="button" class="cuadrado" id="botonCuadrado" onclick="abrirModal(event, 'modalEncargado')"><img src="imagenes/pc-administrator.png"></button>
        <p>Editar encargado de activo</p>
        <div id="modalEncargado" class="modal">
            <div class="contenidoModal" id="contenidoEncargado">
                <div class="divTituloModal">
                    <span class="cerrar" onclick="cerrarModal(event, 'modalEncargado')">&times;</span>
                    <h1 id="editarEncargado" class="tituloModal">Editar encargado de activo</h1>
                </div>
                <div id="editarEncargadoForm" class="modalBody">
                    <form id="editarEncarg" method="POST" action="{{ url('/editaEnc') }}">
                        @csrf
                        <div class="form-group">
                            <label for="nombreActivo" id="labelNombreActivo">Seleccione el activo que desea
                                editar</label>
                            <select onchange="verficarActv(this,document.getElementById('editarEncarg'));" id="selectActivoEncargado" placeholder="Seleccione activo..." name="selectActivoEncargado" required>
                                <option disabled selected value>Seleccione una opción</option>
                                @foreach($activos as $activo)
                                <option value="{{$activo->sipa_activos_codigo}}">{{$activo->sipa_activos_codigo}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nombreActivo" id="labelNombreActivo">Nombre del activo</label>
                            <input id="nombreActivo2" type="text" name="nombreActivo2" placeholder="Nombre del activo" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nombreEncargado" id="labelNombreEncargado">Nuevo funcionario
                                encargado</label>
                            <select onchange="verificarEncargado(this,document.getElementById('labelNombreEncargado'));" id="nombreEncargado" placeholder="Seleccione funcionario..." name="nombreEncargado" required>
                                <option disabled selected value>Seleccione una opción</option>
                                @foreach($usuarios as $usuario)
                                <option value="{{$usuario->sipa_usuarios_identificacion}}">
                                    {{$usuario->sipa_usuarios_identificacion}} - {{$usuario->sipa_usuarios_nombre}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="encargadoNombre" id="labelNomEncargadoAct">Nombre del Responsable</label>
                            <input id="nomEncargadoAct" type="text" name="nomEncargadoAct" placeholder="Responsable del activo" readonly>
                        </div>
                        <button type="submit" class="btn btn-primary" id="encargadoBoton">
                            Guardar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="cuadro">
        <button type="button" class="cuadrado" id="botonCuadrado" onclick="abrirModal(event, 'modalEstado')"><img src="imagenes/broken-laptop.png"></button>
        <p>Editar estado de activo</p>
        <div id="modalEstado" class="modal">
            <div class="contenidoModal" id="contenidoEstado">
                <div class="divTituloModal" id="estadoTitulo">
                    <span class="cerrar" onclick="cerrarModal(event, 'modalEstado')">&times;</span>
                    <h1 id="editarEstado" class="tituloModal">Editar estado de activo</h1>
                </div>
                <div id="editarEstadoForm" class="modalBody">
                    <form id="editEstado" method="POST" action="{{ url('/editaEstado') }}">
                        @csrf
                        <div class="form-group">
                            <label for="nombreActivo" id="labelNombreActivo">Seleccione el activo que desea
                                editar</label>
                            <select onchange="verficarActv(this,document.getElementById('editEstado'));" id="selectActivoEstado" placeholder="Seleccione activo..." name="selectActivoEstado" required>
                                <option disabled selected value>Seleccione una opción</option>
                                @foreach($activos as $activo)
                                <option value="{{$activo->sipa_activos_codigo}}">{{$activo->sipa_activos_codigo}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nombreActivo" id="labelNombreActivo">Nombre del activo</label>
                            <input id="nombreActivo3" type="text" name="nombreActivo3" placeholder="Nombre del activo" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nombreResponsable" id="labelNombreResponsable">Estado de
                                activo</label><br>
                            <select id="estadoActivo" name="estadoActivo" required>
                                <option disabled selected value>Seleccione un estado</option>
                                @foreach($estados as $estado)
                                <option value="{{$estado->sipa_estado_activo_nombre}}">{{$estado->sipa_estado_activo_nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary" id="estadoBoton">
                            Guardar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="cuadro">
        <button type="button" class="cuadrado" id="botonCuadrado" onclick="abrirModal(event, 'modalUbicacion')"><img src="imagenes/placeholder.png"></button>
        <p>Editar ubicación de activo</p>
        <div id="modalUbicacion" class="modal">
            <div class="contenidoModal" id="contenidoUbicacion">
                <div class="divTituloModal">
                    <span class="cerrar" onclick="cerrarModal(event, 'modalUbicacion')">&times;</span>
                    <h1 id="editarUbicacionActivo" class="tituloModal">Editar ubicación de activo</h1>
                </div>
                <div id="editarUbicacionForm" class="modalBody">
                    <form method="POST" action="{{ url('/editaUbicacion') }}">
                        @csrf
                        <div class="form-group">
                            <label for="nombreActivo" id="labelActivoUbicacion">Seleccione el activo que desea
                                editar</label>
                            <select onchange="verficarActv(this,document.getElementById('labelActivoUbicacion'));" id="selectActivoUbicacion" placeholder="Seleccione activo..." name="selectActivoUbicacion" required>
                                <option disabled selected value>Seleccione una opción</option>
                                @foreach($activos as $activo)
                                <option value="{{$activo->sipa_activos_codigo}}">{{$activo->sipa_activos_codigo}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nombreActivo" id="labelNombreActivo">Nombre del activo</label>
                            <input id="activoUbicacion" type="text" name="activoUbicacion" placeholder="Nombre del activo" readonly>
                        </div>
                        <div class="form-group">
                            <label for="ubicacionActivo" id="labelEdificio">Edificio</label>
                            <select onchange="actualizar(this);" id="edificio" placeholder="Seleccione edificio..." name="edificio" required>
                                <option disabled selected value>Seleccione una opción</option>
                                @foreach($edificios as $edificio)
                                <option value="{{$edificio->sipa_edificios_nombre}}">
                                    {{$edificio->sipa_edificios_nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="ubicacionActivo" id="labelPlanta">Planta</label>
                            <select id="planta" placeholder="Seleccione planta..." name="planta" required>
                                <option disabled selected value>Seleccione una opción</option>
                                @for ($i = 0; $i < $seleccionado->sipa_edificios_cantidad_pisos; $i++)
                                    <option value="{{$i+1}}">{{$i+1}}</option>
                                    @endfor
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="ubicacionActivo" id="labelUbicacion"><b>Seleccione la nueva
                                    unidad:</b></label><br><br>
                            <label for="ubicacionActivo" id="labelUnidadEjecutora">Unidad ejecutora</label>
                            <select id="unidadEjecutora" placeholder="Seleccione unidad ejecutora..." name="unidadEjecutora" required>
                                @foreach($unidades->cursor() as $unidad)
                                <option value="{{$unidad->sipa_edificios_unidades_nombre}}">
                                    {{$unidad->sipa_edificios_unidades_nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary" id="ubicacionBoton">
                            Guardar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="cuadro">
        <button type="button" class="cuadrado" id="botonCuadrado" onclick="abrirModal(event, 'modalTrasladoMasivo')"><img src="imagenes/exchange.png"></button>
        <p>Traslado masivo de activo</p>
        <div id="modalTrasladoMasivo" class="modal">
            <div class="contenidoModal" id="contenidoTrasladoMasivo">
                <div class="divTituloModal" id="trasladoTitulo">
                    <span class="cerrar" onclick="cerrarModal(event, 'modalTrasladoMasivo')">&times;</span>
                    <h1 id="trasladoMasivo" class="tituloModal">Traslado masivo de activo</h1>
                </div>
                <div id="trasladoMasivoForm" class="modalBody">
                    <form method="GET">
                        @csrf
                        <div class="form-group">
                            <label for="nombreActivo" id="labelNombreActivoBaja">Seleccione los activos que
                                desea trasladar</label>
                            <select id="selectActivoTraslado" placeholder="Seleccione activo...">
                                <option disabled selected value>Seleccione una opción</option>
                                @foreach($activos as $activo)
                                <option value="{{$activo->sipa_activos_codigo}}">{{$activo->sipa_activos_codigo}}
                                </option>
                                @endforeach
                            </select>
                            <button id="agregar">Agregar</button>
                        </div>
                        <div id="listaActivos" class="form-group">
                            <ul id="activosSeleccionados" name="activosSeleccionados">
                            </ul>
                        </div>
                        <div class="form-group">
                            <label for="boleta" id="labeltrasladoFun">Seleccione el funcionario al que se le
                                trasladarán los activos</label>
                            <select onchange="verificarEncargado(this,document.getElementById('labeltrasladoFun'));" id="selectFuncionario" placeholder="Seleccione funcionario..." required>
                                <option disabled selected value>Seleccione una opción</option>
                                @foreach($usuarios as $usuario)
                                <option value="{{$usuario->sipa_usuarios_identificacion}}">
                                    {{$usuario->sipa_usuarios_identificacion}} - {{$usuario->sipa_usuarios_nombre}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="encargadoNombre" id="labelNomEncargadoAct">Nombre del Responsable</label>
                            <input id="nomEncargadoAct2" type="text" name="nomEncargadoAct2" placeholder="Responsable del activo" readonly>
                        </div>
                        <div class="form-group">
                            <label for="boleta" id="labelBoleta">Seleccione la boleta</label>
                            <input type="file" name="boletaImagen" required>
                        </div>
                        <button type="submit" class="btn btn-primary" id="trasladar" onclick="trasladoMasivo();">
                            Trasladar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="cuadro">
        <button type="button" class="cuadrado" id="botonCuadrado" onclick="abrirModal(event, 'modalDarBaja')"><img src="imagenes/storage-box.png"></button>
        <p>Dar de baja un activo</p>
        <div id="modalDarBaja" class="modal">
            <div class="contenidoModal" id="contenidoDarBaja">
                <div class="divTituloModal" id="darBajaTitulo">
                    <span class="cerrar" onclick="cerrarModal(event, 'modalDarBaja')">&times;</span>
                    <h1 id="darBaja" class="tituloModal">Dar de baja un activo</h1>
                </div>
                <div id="darBajaForm" class="modalBody">
                    <form id="darDeBaja" method="POST" action="{{ url('/darBaja') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="nombreActivo" id="labelNombreActivo">Seleccione el activo que desea
                                dar de baja</label>
                            <select onchange="verficarActv(this,document.getElementById('darDeBaja'));" id="selectActivoBaja" placeholder="Seleccione activo..." name="selectActivoBaja" required>
                                <option disabled selected value>Seleccione una opción</option>
                                @foreach($activos as $activo)
                                <option value="{{$activo->sipa_activos_codigo}}">{{$activo->sipa_activos_codigo}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nombreActivo" id="labelNombreActivo">Nombre del activo</label>
                            <input id="nombreActivo4" type="text" name="nombreActivo4" placeholder="Nombre del activo" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nombreResponsable" id="labelNombreResponsable">Estado de
                                activo</label><br>
                            <select id="estadoActivoBaja" name="estadoActivoBaja" required>
                                <option disabled selected value>Seleccione un estado</option>
                                @foreach($estados as $estado)
                                <option value="{{$estado->sipa_estado_activo_nombre}}">{{$estado->sipa_estado_activo_nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="razonBajaActivo" id="labelRazonBajaActivo">Razón por la que se da de
                                baja el activo</label>
                            <textarea rows="10" cols="95" name="razonBajaActivo" placeholder="Ingrese la razón por la que da de baja este activo" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="boleta" id="labelBoleta">Seleccione la boleta(Debe ser un archivo .pdf)</label>
                            <input id="boletaImagen" type="file" name="boletaImagen" required>
                        </div>
                        <button type="submit" class="btn btn-primary" id="darBaja">
                            Dar de baja
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>

<script type="text/javascript">
    var arrayActivos = [];

    // When the user clicks the button, open the modal 
    function abrirModal(evt, modal) {
        var i, modals;

        modals = document.getElementsByClassName("modal");
        for (i = 0; i < modals.length; i++) {
            modals[i].style.display = "none";
        }

        document.getElementById(modal).style.display = "block";
    }

    function cerrarModal(evt, modal) {
        document.getElementById(modal).style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it

    window.onclick = function(event) {
        var modals = document.getElementsByClassName("modal");
        var i;

        for (i = 0; i < modals.length; i++) {
            if (event.target == modals[i]) {
                modals[i].style.display = "none";
            }
        }

    }

    //click on x to delete toDo
    $("#activosSeleccionados").on("click", "span", function(event) {
        $(this).parent().fadeOut(500, function() {
            $(this).remove();
        });
        event.stopPropagation();
    });

    $("#activosSeleccionados").on("click", "li", function(event) {
        var actvRemo = $(this).text();
        arrayActivos = arrayActivos.filter(elements => elements !== actvRemo);
        $(this).fadeOut(500, function() {
            $(this).remove();
        });
        event.stopPropagation();
    });

    $("#agregar").on("click", function(event) {

        event.preventDefault();


        let activo = $('#selectActivoTraslado').find("option:selected").text();

        $("#activosSeleccionados").append(
            "<li class='activoSeleccionado' name = 'activSeleccionados'><span><i class='fa fa-trash'></i></span>" +
            activo + "</li>");
        arrayActivos[arrayActivos.length] = activo;
        console.log(arrayActivos);

    });

    $(function() {
        $('select').selectize({})
    });

    function trasladoMasivo() {
        console.log('Hola estoy en el onclick traslado masivo');
        var seleccion = document.getElementById('selectFuncionario');
        var funcSelec = seleccion.options[seleccion.selectedIndex].value;
        var url = "/traspasoMasiv/" + arrayActivos + "/" + funcSelec;
        fetch(url).then(r => {
            return r.json();
        }).then(d => {
            var obj = JSON.stringify(d);
            var obj2 = JSON.parse(obj);
            console.log(obj2);
        });
    }
</script>
@endsection