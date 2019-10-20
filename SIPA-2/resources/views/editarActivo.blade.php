<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="{{ asset('sass/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <script type="text/javascript" src="../public/js/standalone/selectize.js"></script>
    <link rel="stylesheet" type="text/css" href="../public/css/selectize.css" />
    

    <title>Editar activo</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Mukta|Sanchez|Vidaloka&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

</head>

<body id="cuerpoInicio">
    <div class="wrapper">
        <!-- Sidebar Holder -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3 id="sipaInicio">SIPA</h3>
            </div>

            <ul class="list-unstyled components">
                <p id="accesos">Accesos rápidos</p>
                <li class="active">
                    <a class="links" href="#homeSubmenu" data-toggle="collapse" aria-expanded="false">Inicio</a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li><a class="links" href="#">Configurar Roles</a></li>
                        <li><a class="links" href="#">Configurar cuerpos de correos</a></li>
                        <li><a class="links" href="#">Configurar usuarios nuevos</a></li>
                        <li><a class="links" href="#">Configurar tipos de usuarios</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false">Configurar cuerpo de los
                        correos</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li><a href="#">Page 1</a></li>
                        <li><a href="#">Page 2</a></li>
                        <li><a href="#">Page 3</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false">Configurar usuarios nuevos</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li><a href="#">Page 1</a></li>
                        <li><a href="#">Page 2</a></li>
                        <li><a href="#">Page 3</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false">Configurar tipos de usuarios</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li><a href="#">Page 1</a></li>
                        <li><a href="#">Page 2</a></li>
                        <li><a href="#">Page 3</a></li>
                    </ul>
                </li>
            </ul>

            <ul class="list-unstyled CTAs">
                <li><img src="imagenes/logo_vicerrectoria_blanco_transparente.png" class="img-fluid"
                        id="logoVicerrectoriaInicioImg"></li>
            </ul>
        </nav>

        <!-- Page Content Holder -->
        <div id="content">

            <nav class="navbar">
                <div class="container-fluid">

                    <div class="navbar-header">
                        <button type="button" id="sidebarCollapse" class="navbar-btn">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                    <p id="ruta" class="navbar-text navbar-left">Inicio</p>
                    <p id="rol" class='navbar-text navbar-center'>Super Administrador</p>
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="imagenes/iconoUsuario.png">
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="#" id="user">Ver Perfil</a>
                                    <a class="dropdown-item" href="#" id="user">Salir</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

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
                                <form method="POST" action="{{ route('roles.store') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="nombreActivo" id="labelNombreActivo">Seleccione el activo que desea
                                            editar</label>
                                        <select id="selectActivoResponsable" placeholder="Seleccione activo...">
                                            <option value="volvo">Volvo</option>
                                            <option value="saab">Saab</option>
                                            <option value="mercedes">Mercedes</option>
                                            <option value="audi">Audi</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="nombreResponsable" id="labelNombreResponsable">Nuevo funcionario
                                            responsable</label>
                                        <select id="nombreResponsable" placeholder="Seleccione funcionario...">
                                            <option value="volvo">Volvo</option>
                                            <option value="saab">Saab</option>
                                            <option value="mercedes">Mercedes</option>
                                            <option value="audi">Audi</option>
                                        </select>
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
                                <form method="POST" action="{{ route('roles.store') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="nombreActivo" id="labelNombreActivo">Seleccione el activo que desea
                                            editar</label>
                                        <select id="selectActivoEncargado" placeholder="Seleccione activo...">
                                            <option value="volvo">Volvo</option>
                                            <option value="saab">Saab</option>
                                            <option value="mercedes">Mercedes</option>
                                            <option value="audi">Audi</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="nombreEncargado" id="labelNombreEncargado">Nuevo funcionario
                                            encargado</label>
                                        <select id="nombreEncargado" placeholder="Seleccione funcionario...">
                                            <option value="volvo">Volvo</option>
                                            <option value="saab">Saab</option>
                                            <option value="mercedes">Mercedes</option>
                                            <option value="audi">Audi</option>
                                        </select>
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
                                <form method="POST" action="{{ route('roles.store') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="nombreActivo" id="labelNombreActivo">Seleccione el activo que desea
                                            editar</label>
                                        <select id="selectActivoEstado" placeholder="Seleccione activo...">
                                            <option value="volvo">Volvo</option>
                                            <option value="saab">Saab</option>
                                            <option value="mercedes">Mercedes</option>
                                            <option value="audi">Audi</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="nombreResponsable" id="labelNombreResponsable">Estado de
                                            activo</label><br>
                                        <textarea rows="10" cols="98" id="estadoTextarea"
                                            name="estadoActivo">Ingrese el estado actual del activo</textarea>
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
                                <form method="POST" action="{{ route('roles.store') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="nombreActivo" id="labelNombreActivo">Seleccione los activos que
                                            desea trasladar</label>
                                        <select id="selectActivoTraslado" placeholder="Seleccione activo...">
                                            <option value="volvo">Volvo</option>
                                            <option value="saab">Saab</option>
                                            <option value="mercedes">Mercedes</option>
                                            <option value="audi">Audi</option>
                                        </select>
                                        <button id="agregar">Agregar</button>
                                    </div>
                                    <div class="form-group">
                                        <ul id="activosSeleccionados">
                                        </ul>
                                    </div>
                                    <div class="form-group">
                                        <label for="boleta" id="labelBoleta">Seleccione el funcionario al que se le
                                            trasladarán los activos</label>
                                        <select id="selectFuncionario" placeholder="Seleccione funcionario...">
                                            <option value="volvo">Volvo</option>
                                            <option value="saab">Saab</option>
                                            <option value="mercedes">Mercedes</option>
                                            <option value="audi">Audi</option>
                                        </select>
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
                                <form method="POST" action="{{ route('roles.store') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="nombreActivo" id="labelNombreActivo">Seleccione el activo que desea
                                            dar de baja</label>
                                        <select id="selectActivoBaja" placeholder="Seleccione activo...">
                                            <option value="volvo">Volvo</option>
                                            <option value="saab">Saab</option>
                                            <option value="mercedes">Mercedes</option>
                                            <option value="audi">Audi</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="razonBajaActivo" id="labelRazonBajaActivo">Razón por la que se da de
                                            baja el activo</label>
                                        <textarea rows="10" cols="98"
                                            name="razonBajaActivo">Ingrese la razón por la que da de baja este activo</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="boleta" id="labelBoleta">Seleccione la boleta</label>
                                        <input type="file" name="boletaImagen">
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
                        "<li class='activoSeleccionado'><span><i class='fa fa-trash'></i></span>     " +
                        activo + "</li>");
                });

                $(document).ready(function () {
                    $('select').selectize({
                        sortField: 'text'
                    });
                });
            </script>
</body>

</html>