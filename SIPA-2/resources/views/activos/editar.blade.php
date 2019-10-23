@extends('plantillas.inicio')
@section('content')

<div id="cuadros">
                <div class="cuadro">
                    <button type="button" class="cuadrado" id="botonCuadrado"
                        onclick="abrirModal(event, 'modalResponsable')"><img
                            src="imagenes/man-in-office-desk-with-computer.png"></button>
                    <p>Editar responsable de activo</p>
                    <div id="modalResponsable" class="modal">
                        <div class="contenidoModal" id="contenidoResponsable">
                            <span class="cerrar" onclick="cerrarModal(event, 'modalResponsable')">&times;</span>
                            <h1 id="editarResponsable">Editar responsable de activo</h1>
                            <div id="editarResponsableForm">
                                @php
                                    $usuarios = App\User::all();
                                    $activos = App\Activo::all(); 
                                @endphp
                                 <script>
                                        function verificarResponsable(elemento){
                                            var url = "/verificar/"+elemento.value;
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
                                        function verificarEncargado(elemento,elemento2){
                                            //labeltrasladoFun
                                            //labelNombreEncargado
                                            var url = "/verificar/"+elemento.value;
                                            console.log(elemento.value);
                                                            fetch(url).then(r => {
                                                                    return r.json();
                                                            }).then(d => {
                                                                    var obj = JSON.stringify(d);
                                                                    var obj2 = JSON.parse(obj);
                                                                    console.log(obj2);
                                                                    if(elemento2.id == 'labelNombreEncargado'){ 
                                                                        var encargado = document.getElementById('nomEncargadoAct');
                                                                        encargado.value = obj2.nombreUsuario; 
                                                                    }else if(elemento2.id == 'labeltrasladoFun'){
                                                                        var encargado = document.getElementById('nomEncargadoAct2');
                                                                        encargado.value = obj2.nombreUsuario;
                                                                    }
                                                                    
                                                            });
                                        }
                                        function verficarActv(elemento,elemento2){
                                            var url = "/verificarAct/"+elemento.value;
                                            console.log(elemento.value);
                                                            fetch(url).then(r => {
                                                                    return r.json();
                                                            }).then(d => {
                                                                    var obj = JSON.stringify(d);
                                                                    var obj2 = JSON.parse(obj);
                                                                    console.log(obj2); 
                                                                    if(elemento2.id == 'editarRespon'){
                                                                        var activo = document.getElementById('nombreActivo');
                                                                        activo.value = obj2.nombreActivo;
                                                                    }else if(elemento2.id == 'editarEncarg'){
                                                                        var activo = document.getElementById('nombreActivo2');
                                                                        activo.value = obj2.nombreActivo;
                                                                    }else if(elemento2.id == 'editEstado'){
                                                                        var activo = document.getElementById('nombreActivo3');
                                                                        activo.value = obj2.nombreActivo;
                                                                    }else if(elemento2.id == 'darDeBaja'){
                                                                        var activo = document.getElementById('nombreActivo4');
                                                                        activo.value = obj2.nombreActivo;
                                                                    }
                                                                    
                                                            });
                                        }
                                        
                                    </script>
                                <form id = "editarRespon" method="POST" action="{{ url('/editaResp') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="nombreActivo" id="labelNombreActivo" name = "nombreActivo">Seleccione el activo que desea
                                            editar</label>
                                        <select onchange="verficarActv(this,document.getElementById('editarRespon'));" id="selectActivoResponsable" placeholder="Seleccione activo..." name="selectActivoResponsable">
                                            <option></option>  
                                            @foreach($activos as $activo)
                                                <option value="{{$activo->sipa_activos_codigo}}" >{{$activo->sipa_activos_codigo}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                            <label for="nombreActivo" id="labelNombreActivo">Nombre del activo</label>
                                            <input id="nombreActivo" type="text"  name="nombreActivo" placeholder="Nombre del activo">
                                    </div>
                                    <div class="form-group">
                                        <label for="nombreResponsable" id="labelNombreResponsable" name= "labelNombreResponsable">Nuevo funcionario
                                            responsable</label>
                                        <select onchange="verificarResponsable(this);" id="nombreResponsable" placeholder="Seleccione funcionario..." name = "nombreResponsable">
                                            <option></option>   
                                            @foreach($usuarios as $usuario)
                                                <option value="{{$usuario->sipa_usuarios_identificacion}}" >{{$usuario->sipa_usuarios_identificacion}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                            <label for="responsableNombre" id="labelNomResponsableAct">Nombre del Responsable</label>
                                            <input id="nomResponsableAct" type="text"  name="nomResponsableAct" placeholder="Responsable del activo" readonly>
                                    </div>
                                    <button type="submit" class="btn btn-primary" id="responsableBoton">
                                        Editar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="cuadro">
                    <button type="button" class="cuadrado" id="botonCuadrado"
                        onclick="abrirModal(event, 'modalEncargado')"><img src="imagenes/pc-administrator.png"></button>
                    <p>Editar encargado de activo</p>
                    <div id="modalEncargado" class="modal">
                        <div class="contenidoModal" id="contenidoEncargado">
                            <span class="cerrar" onclick="cerrarModal(event, 'modalEncargado')">&times;</span>
                            <h1 id="editarEncargado">Editar encargado de activo</h1>
                            <div id="editarEncargadoForm">
                                <form id = "editarEncarg" method="POST" action="{{ url('/editaEnc') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="nombreActivo" id="labelNombreActivo">Seleccione el activo que desea
                                            editar</label>
                                        <select onchange="verficarActv(this,document.getElementById('editarEncarg'));" id="selectActivoEncargado" placeholder="Seleccione activo..." name = "selectActivoEncargado">
                                            <option></option>    
                                            @foreach($activos as $activo)
                                                <option value="{{$activo->sipa_activos_codigo}}" >{{$activo->sipa_activos_codigo}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                            <label for="nombreActivo" id="labelNombreActivo">Nombre del activo</label>
                                            <input id="nombreActivo2" type="text"  name="nombreActivo2" placeholder="Nombre del activo">
                                    </div>
                                    <div class="form-group">
                                        <label for="nombreEncargado" id="labelNombreEncargado">Nuevo funcionario
                                            encargado</label>
                                        <select onchange="verificarEncargado(this,document.getElementById('labelNombreEncargado'));" id="nombreEncargado" placeholder="Seleccione funcionario..." name = "nombreEncargado">
                                            <option></option>    
                                            @foreach($usuarios as $usuario)
                                                <option value="{{$usuario->sipa_usuarios_identificacion}}" >{{$usuario->sipa_usuarios_identificacion}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                            <label for="encargadoNombre" id="labelNomEncargadoAct">Nombre del Responsable</label>
                                            <input id="nomEncargadoAct" type="text"  name="nomEncargadoAct" placeholder="Responsable del activo" readonly>
                                    </div>
                                    <button type="submit" class="btn btn-primary" id="encargadoBoton">
                                        Editar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="cuadro">
                    <button type="button" class="cuadrado" id="botonCuadrado"
                        onclick="abrirModal(event, 'modalEstado')"><img src="imagenes/broken-laptop.png"></button>
                    <p>Editar estado de activo</p>
                    <div id="modalEstado" class="modal">
                        <div class="contenidoModal" id="contenidoEstado">
                            <span class="cerrar" onclick="cerrarModal(event, 'modalEstado')">&times;</span>
                            <h1 id="editarEstado">Editar estado de activo</h1>
                            <div id="editarEstadoForm">
                                <form id = "editEstado" method="POST" action="{{ url('/editaEstado') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="nombreActivo" id="labelNombreActivo">Seleccione el activo que desea
                                            editar</label>
                                        <select onchange="verficarActv(this,document.getElementById('editEstado'));"  id="selectActivoEstado" placeholder="Seleccione activo..." name = "selectActivoEstado">
                                            <option></option>    
                                            @foreach($activos as $activo)
                                                <option value="{{$activo->sipa_activos_codigo}}" >{{$activo->sipa_activos_codigo}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                            <label for="nombreActivo" id="labelNombreActivo">Nombre del activo</label>
                                            <input id="nombreActivo3" type="text"  name="nombreActivo3" placeholder="Nombre del activo">
                                    </div>
                                    <div class="form-group">
                                        <label for="nombreResponsable" id="labelNombreResponsable">Estado de
                                            activo</label><br>
                                        <textarea rows="10" cols="98" id="estadoTextarea"
                                            name="estadoActivo" placeholder="Ingrese el estado actual del activo"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary" id="estadoBoton">
                                        Enviar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="cuadro">
                    <button type="button" class="cuadrado" id="botonCuadrado"
                        onclick="abrirModal(event, 'modalUbicacion')"><img src="imagenes/placeholder.png"></button>
                    <p>Editar ubicación de activo</p>
                    <div id="modalUbicacion" class="modal">
                        <div class="contenidoModal" id="contenidoUbicacion">
                            <span class="cerrar" onclick="cerrarModal(event, 'modalUbicacion')">&times;</span>
                            <h1 id="editarUbicacionActivo">Editar ubicación de activo</h1>
                            <div id="editarUbicacionForm">
                                <form method="POST" action="{{ route('roles.store') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="nombreActivo" id="labelNombreActivo">Seleccione el activo que desea
                                            editar</label>
                                        <select id="selectActivoUbicacion" placeholder="Seleccione activo...">
                                            <option value="volvo">Volvo</option>
                                            <option value="saab">Saab</option>
                                            <option value="mercedes">Mercedes</option>
                                            <option value="audi">Audi</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="ubicacionActivo" id="labelUbicacion"><b>Seleccione la nueva
                                                ubicación:</b></label><br><br>
                                        <label for="ubicacionActivo" id="labelUnidadEjecutora">Unidad ejecutora</label>
                                        <select id="unidadEjecutora" placeholder="Seleccione unidad ejecutora...">
                                            <option value="volvo">Volvo</option>
                                            <option value="saab">Saab</option>
                                            <option value="mercedes">Mercedes</option>
                                            <option value="audi">Audi</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="ubicacionActivo" id="labelEdificio">Edificio</label>
                                        <select id="edificio" placeholder="Seleccione edificio...">
                                            <option value="volvo">Volvo</option>
                                            <option value="saab">Saab</option>
                                            <option value="mercedes">Mercedes</option>
                                            <option value="audi">Audi</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="ubicacionActivo" id="labelPlanta">Planta</label>
                                        <select id="planta" placeholder="Seleccione planta...">
                                            <option value="volvo">Volvo</option>
                                            <option value="saab">Saab</option>
                                            <option value="mercedes">Mercedes</option>
                                            <option value="audi">Audi</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="ubicacionActivo" id="labelUbicacion">Ubicación</label>
                                        <select id="ubicacion" placeholder="Seleccione ubicacion...">
                                            <option value="volvo">Volvo</option>
                                            <option value="saab">Saab</option>
                                            <option value="mercedes">Mercedes</option>
                                            <option value="audi">Audi</option>
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
                    <button type="button" class="cuadrado" id="botonCuadrado"
                        onclick="abrirModal(event, 'modalTrasladoMasivo')"><img src="imagenes/exchange.png"></button>
                    <p>Traslado masivo de activo</p>
                    <div id="modalTrasladoMasivo" class="modal">
                        <div class="contenidoModal" id="contenidoTrasladoMasivo">
                            <span class="cerrar" onclick="cerrarModal(event, 'modalTrasladoMasivo')">&times;</span>
                            <h1 id="trasladoMasivo">Traslado masivo de activo</h1>
                            <div id="trasladoMasivoForm">
                                <form method="POST" action="{{ url('/trasladoMasivo') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="nombreActivo" id="labelNombreActivoBaja">Seleccione los activos que
                                            desea trasladar</label>
                                        <select id="selectActivoTraslado" placeholder="Seleccione activo...">
                                            <option></option>
                                            @foreach($activos as $activo)
                                                <option value="{{$activo->sipa_activos_codigo}}" >{{$activo->sipa_activos_codigo}}</option>
                                            @endforeach
                                        </selfdaect>
                                        <button id="agregar">Agregar</button>
                                    </div>
                                    <div class="form-group">
                                        <ul id="activosSeleccionados" name = "activosSeleccionados">
                                        </ul>
                                    </div>
                                    <div class="form-group">
                                        <label for="boleta" id="labeltrasladoFun">Seleccione el funcionario al que se le
                                            trasladarán los activos</label>
                                        <select onchange="verificarEncargado(this,document.getElementById('labeltrasladoFun'));" id="selectFuncionario" placeholder="Seleccione funcionario...">
                                            <option></option>
                                            @foreach($usuarios as $usuario)
                                                <option value="{{$usuario->sipa_usuarios_identificacion}}" >{{$usuario->sipa_usuarios_identificacion}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="encargadoNombre" id="labelNomEncargadoAct">Nombre del Responsable</label>
                                        <input id="nomEncargadoAct2" type="text"  name="nomEncargadoAct2" placeholder="Responsable del activo" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="boleta" id="labelBoleta">Seleccione la boleta</label>
                                        <input type="file" name="boletaImagen">
                                    </div>
                                    <button type="submit" class="btn btn-primary" id="trasladar">
                                        Trasladar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="cuadro">
                    <button type="button" class="cuadrado" id="botonCuadrado"
                        onclick="abrirModal(event, 'modalDarBaja')"><img src="imagenes/storage-box.png"></button>
                    <p>Dar de baja un activo</p>
                    <div id="modalDarBaja" class="modal">
                        <div class="contenidoModal" id="contenidoDarBaja">
                            <span class="cerrar" onclick="cerrarModal(event, 'modalDarBaja')">&times;</span>
                            <h1 id="darBaja">Dar de baja un activo</h1>
                            <div id="darBajaForm">
                                <form id = "darDeBaja" method="POST" action="{{ url('/darBaja') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="nombreActivo" id="labelNombreActivo">Seleccione el activo que desea
                                            dar de baja</label>
                                        <select onchange="verficarActv(this,document.getElementById('darDeBaja'));" id="selectActivoBaja" placeholder="Seleccione activo..." name = "selectActivoBaja">
                                            <option></option>
                                            @foreach($activos as $activo)
                                                <option value="{{$activo->sipa_activos_codigo}}" >{{$activo->sipa_activos_codigo}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="nombreActivo" id="labelNombreActivo">Nombre del activo</label>
                                        <input id="nombreActivo4" type="text"  name="nombreActivo4" placeholder="Nombre del activo">
                                    </div>
                                    <div class="form-group">
                                        <label for="razonBajaActivo" id="labelRazonBajaActivo">Razón por la que se da de
                                            baja el activo</label>
                                        <textarea rows="10" cols="95"
                                            name="razonBajaActivo" placeholder= "Ingrese la razón por la que da de baja este activo"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="boleta" id="labelBoleta">Seleccione la boleta(Debe ser un archivo .pdf)</label>
                                        <input id = "boletaImagen" type="file" name="boletaImagen">
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

            <!-- Footer -->
            <footer id="footer">
                <div class="contenedorFooter">
                    <span id="copyright">© 2019 Copyright:
                        <a href="https://www.una.ac.cr/" id="footerLink"> Universidad Nacional de Costa Rica</a>
                    </span>
                </div>
            </footer>

            <!-- jQuery CDN -->
            <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
            <!-- Bootstrap Js CDN -->
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

            <script type="text/javascript">
                $(document).ready(function () {
                    $('#sidebarCollapse').on('click', function () {
                        $('#sidebar').toggleClass('active');
                        $(this).toggleClass('active');
                    });
                });

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

                window.onclick = function (event) {
                    var modals = document.getElementsByClassName("modal");
                    var i;

                    for (i = 0; i < modals.length; i++) {
                        if (event.target == modals[i]) {
                            modals[i].style.display = "none";
                        }
                    }

                }

                //click on x to delete toDo
                $("#activosSeleccionados").on("click", "span", function (event) {
                    $(this).parent().fadeOut(500, function () {
                        $(this).remove();
                    });
                    event.stopPropagation();
                });

                $("#activosSeleccionados").on("click", "li", function (event) {
                    $(this).fadeOut(500, function () {
                        $(this).remove();
                    });
                    event.stopPropagation();
                });

                $("#agregar").on("click", function (event) {

                    event.preventDefault();


                    let activo = $('#selectActivoTraslado').find("option:selected").text();

                    $("#activosSeleccionados").append(
                        "<li class='activoSeleccionado' name = 'activSeleccionados'><span><i class='fa fa-trash'></i></span>     " +
                        activo + "</li>");
                });

                $(function(){
                    $('select').selectize({})
                });
            </script>
@endsection