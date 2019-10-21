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

    <title>Configurar Roles</title>

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
                        onclick="abrirModal(event, 'modalRegistrarActivo')"><img src="imagenes/activos.png"></button>
                    <p class="rol">Registrar Activo</p>
                    <div id="modalRegistrarActivo" class="modal">
                        <div class="contenidoModal" id="contenidoRegistrar">
                            <span class="cerrar" onclick="cerrarModal(event, 'modalRegistrarActivo')">&times;</span>
                            <h1 id="registrarActivo">Registrar activo</h1>
                            <div id="registrarActivoForm">
                                @php
                                    $usuarios = App\User::all(); 
                                @endphp
                                <script>
                                        function verificarResponsable(cedula){
                                            var url = "/verificar/"+cedula.value;
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
                                        function verificarEncargado(cedula){
                                            var url = "/verificar/"+cedula.value;
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
                                        <input id="inputPlacaActivo" type="text" name="placaActivo"
                                            placeholder="Ingrese el número de placa del activo">
                                    </div>
                                    <div class="form-group">
                                            <label for="nombreActivo" id="labelNombreActivo">Nombre del activo</label>
                                            <input id="nombreActivo" type="text"  name="nombreActivo" placeholder="Ingrese el nombre del activo">
                                    </div>
                                    <div class="form-group">
                                            <label for="descripcionActivo" id="labelDescripcionActivo">Descripción del activo</label>
                                            <input id="descripcionActivo" type="text"  name="descripcionActivo" placeholder="Ingrese la descripción del activo">
                                    </div>
                                    <div class="form-group">
                                        <label for="marcaActivo" id="labelMarcaActivo">Marca</label>
                                        <input id="inputMarcaActivo" type="text"
                                            placeholder="Ingrese la marca del activo" name="marcaActivo">
                                    </div>
                                    <div class="form-group">
                                        <label for="modeloActivo" id="labelModeloActivo">Modelo</label>
                                        <input id="inputModeloActivo" type="text" placeholder="Ingrese el modelo del activo"
                                            name="modeloActivo">
                                    </div>
                                    <div class="form-group">
                                        <label for="serieActivo" id="labelSerieActivo">Serie</label>
                                        <input id="inputSerieActivo" type="text" placeholder="Ingrese la serie del activo"
                                            name="serieActivo">
                                    </div>
                                    <div class="form-group">
                                            <label for="precio" id="labelPrecioActivo">Precio</label>
                                            <input id="precioActivo" type="number"  name="precioActivo" placeholder="Ingrese el modelo del activo" min = "30000">
                                    </div>
                                    <div class="form-group">
                                        <label for="unidadActivo" id="labelUnidadActivo">Unidad</label>
                                        <input id="inputUnidadActivo" type="text" placeholder="Ingrese la unidad del activo"
                                            name="unidadActivo">
                                    </div>
                                    <div class="form-group">
                                        <label for="responsableActivo" id="labelResponsableActivo">Funcionario responsable del activo</label>
                                        <select onchange="verificarResponsable(this);" id="selectResponsableActivo" placeholder="Seleccione funcionario..." name = "selectResponsableActivo">
                                                @foreach($usuarios as $usuario)
                                                <option></option>
                                                <option value="{{$usuario->sipa_usuarios_identificacion}}" >{{$usuario->sipa_usuarios_identificacion}}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                            <label for="responsableNombre" id="labelNomResponsableAct">Nombre del Responsable</label>
                                            <input id="nomResponsableAct" type="text"  name="nomResponsableAct" placeholder="Responsable del activo" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="encargadoActivo" id="labelEncargadoActivo">Funcionario encargado del activo</label>
                                        <select onchange="verificarEncargado(this);" id="selectEncargadoActivo" placeholder="Seleccione funcionario..." name = "selectEncargadoActivo">
                                                @foreach($usuarios as $usuario)
                                                <option></option>
                                                <option value="{{$usuario->sipa_usuarios_identificacion}}" >{{$usuario->sipa_usuarios_identificacion}}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                            <label for="encargadoNombre" id="labelencargadoNombre">Nombre del Encargado</label>
                                            <input id="nomEncargadoAct" type="text"  name="nomEncargadoAct" placeholder="Encargado del activo" readonly>
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
                                            <option value="volvo">Volvo</option>
                                            <option value="saab">Saab</option>
                                            <option value="mercedes">Mercedes</option>
                                            <option value="audi">Audi</option>
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
                                            <input id="imagenAct" type="file"  name="imagenAct" placeholder="Inserte la imagen del activo">
                                    </div>
                                    <button type="submit" class="btn btn-primary" id="registrarActivoBoton">
                                        Registrar activo
                                    </button>
                                </form>
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
        </script>
</body>

</html>