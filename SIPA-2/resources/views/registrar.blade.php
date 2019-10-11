<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="{{ asset('sass/app.css') }}" rel="stylesheet">

        <title>Registrarse</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Mukta|Sanchez|Vidaloka&display=swap" rel="stylesheet">

    </head>
    <body id="cuerpoLogin">
        <div class="container">
            <div id="pantalla">
                <div id="seccionRojaRegistro">
                    <img src="imagenes/seccionRoja_der.svg" class="img-fluid" id="seccionRojaImgRegistro">
                    <h4 id="sipaRegistro">SIPA</h4>
                    <img src="imagenes/logo_vicerrectoria_blanco_transparente.png"class="img-fluid"  id="logoVicerrectoriaLoginImgRegistro">
                </div>
                
                <div id="formularioRegistro">  
                    <h3 id="tituloFormularioRegistro">Regístrese en SIPA</h3>
                    <!--<form method="POST" action="/users/{}">
                      
                        <input type="hidden" name="_method" value="PUT">
                -->
                        <form method="POST" action="{{ url('/userso') }}">
                        
                        @csrf
                        
                        <div class="form-group">
                            <label for="username" id="labelUsuarioRegistro">Usuario</label>
                            <!--input id="inputUsuarioRegistro" type="text" value="{{ $user->sipa_usuarios_identificacion}}" name="id" disabled-->
                            <input id="inputUsuarioRegistro" type="text" class="form-control @error('username') is-invalid @enderror" name="id" value="{{ $user->sipa_usuarios_identificacion}}" readonly>
                        </div>
                        <div class="form-group">
                                <label for="funcionario" id="labelFuncionarioRegistro">Nombre de Funcionario</label>
                                <input id="inputFuncionarioRegistro" type="text" value="{{ $user->name }}" name="nombre" readonly>
                        </div>
                        <div class="form-group">
                                <label for="correo" id="labelCorreoRegistro">Correo electrónico</label>
                                <input id="inputCorreoRegistro" type="text"  name="correo" value="{{ $user->email  }}">
                        </div>
                        <div class="form-group">
                                <label for="telefono" id="labelTelefonoRegistro">Teléfono</label>
                                <input id="inputTelefonoRegistro" type="text"  name="telefono" placeholder="Ingrese su número de teléfono">
                        </div>
                        @php
                                $edificios = App\Edifico::all();
                                $seleccionado = $edificios->get(0);
                                $unidades = App\Unidad::where('sipa_edificios_unidades_edificio',$seleccionado->id);
                                
                        @endphp
                        <div class="form-group">
                                <label for="edificio" id="labelEdificioRegistro">Edificio</label>
                                <select id="edificioSelect" name="edificioSelect">
                                        @foreach($edificios as $edificio)
                                                <option value="opc1" onclick="
                                                        function (){
                                                                $edificioNombre = this.options[this.selectedIndex].value}
                                                                
                                                
                                                        }
                                                "> {{$edificio->sipa_edificios_nombre}}</option>
                                        @endforeach
                                </select>
                        </div>
                        <div class="form-group">
                                <label for="piso" id="labelPisoRegistro">Piso</label>
                                <select id="pisoSelect" name="pisoSelect">
                                        @for ($i = 0; $i < $seleccionado->sipa_edificios_cantidad_pisos; $i++)
                                                <option value="opc1">{{$i+1}}</option>
                                        @endfor
                                        
                                </select>
                        </div>
                        <div class="form-group">
                                <label for="unidad" id="labelUnidadRegistro">Unidad</label>
                                <select id="unidadSelect" name ="unidadSelect">
                                        @foreach($unidades->cursor() as $unidad)
                                                <option value="opc1">{{$unidad->sipa_edificios_unidades_nombre}}</option>
                                        @endforeach
                                </select>
                        </div>
                        <button type="submit" class="btn btn-primary" id="acceder">Registrarse</button>
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
    </body>
</html>
