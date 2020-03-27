<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="{{ asset('sass/app.css') }}" rel="stylesheet">

        <title>Login</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Mukta|Sanchez|Vidaloka&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="@sweetalert2/theme-borderless/borderless.css">

    </head>
    <body id="cuerpoLogin">
        <div class="container">
            
            <div id="pantallaLogin">
                <div id="seccionRojaLogin">
                    <img src="imagenes/seccionRoja.svg" class="img-fluid" id="seccionRojaImgLogin">
                    <h4 id="sipa">SIPA</h4>
                    <img src="imagenes/logo_vicerrectoria_blanco_transparente.png" class="img-fluid"  id="logoVicerrectoriaLoginImg">
                    <img src="imagenes/logo_vicerrectoria__rojo_transparente.png" class="img-fluid"  id="logoVicerrectoriaRojoLoginImg">
                </div>
                <div id="formularioLogin">  
                    <h3 id="tituloFormularioLogin">Acceda a su cuenta</h3>
                    <form method="POST" action="{{ route('users.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="username" id="labelUsuarioLogin">Usuario</label>
                            <input id="inputUsuarioLogin" type="text" placeholder="Ingrese su cédula" class="form-control @error('username') is-invalid @enderror" name="username"  required autocomplete="username" autofocus>
                        </div>
                        <div class="form-group">
                                <label for="password" id="labelClaveLogin">Contraseña</label>
                                <input id="inputClaveLogin" type="password" placeholder="Ingrese su contraseña" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        </div>
                        <button type="submit" class="btn btn-primary" id="acceder">Acceder</button>
                        <!-- modal contrase;a incorrecta-->
                        <p class="form-text text-muted"><a href="https://www.claves.una.ac.cr/" id="olvidoClave">Olvidé mi contraseña</a></p>
                    </form>
                </div>
            </div>
        </div>
             <!-- Footer -->
             <footer id="footerLogin">
                    <div class="contenedorFooter">
                    <span id="copyright">© 2019 Copyright:
                      <a href="https://www.una.ac.cr/" id="footerLink"> Universidad Nacional de Costa Rica</a>
                    </span>
                    </div>
            </footer>
            
            <script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js">
            </script>
            <script src="{{ asset('js/app.js') }}"></script>
            <script src="{{ asset('js/codigo.js') }}"></script>
            @include('sweet::alert')
    </body>
</html>
