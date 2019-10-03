<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link href="{{ asset('sass/app.css') }}" rel="stylesheet">

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
                            <li><a  class="links" href="#">Configurar Roles</a></li>
                            <li><a class="links" href="#">Configurar cuerpos de correos</a></li>
                            <li><a class="links" href="#">Configurar usuarios nuevos</a></li>
                            <li><a class="links" href="#">Configurar tipos de usuarios</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false">Configurar cuerpo de los correos</a>
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
                    <li><img src="imagenes/logo_vicerrectoria_blanco_transparente.png" class="img-fluid"  id="logoVicerrectoriaInicioImg"></li>
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
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                            <button class="cuadrado"><img src="imagenes/resume.png"></button>
                            <p class="rol">Crear Rol</p>
                    </div>
                    <div class="cuadro">
                            <button class="cuadrado"><img src="imagenes/view-files.png"></button>
                            <p class="rol">Ver Roles</p>
                    </div>
                    <div class="cuadro">
                            <button class="cuadrado"><img src="imagenes/content.png"></button>
                            <p class="rol">Editar Rol</p>
                    </div>
                    <div class="cuadro">
                        <button class="cuadrado"><img src="imagenes/delete.png"></button>
                        <p class="rol">Eliminar Rol</p>
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
         </script>
    </body>
</html>