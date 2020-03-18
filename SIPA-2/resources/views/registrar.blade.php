<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="{{ asset('sass/app.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="sweetalert2.min.css">
        {{-- Nuevo --}}
        <link href = "https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.all.min.css"  rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js">
        </script>
        @include('sweet::alert')
        <!--script type="text/javascript" src="{{ asset('./js/comboboxes.js') }}"></script-->
        <title>Registrarse</title>
        
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Mukta|Sanchez|Vidaloka&display=swap" rel="stylesheet">

    </head>
    <body id="cuerpoLogin">
        <div class="container">
            <div id="pantallaRegistro">
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
                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> 
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.1.60/inputmask/jquery.inputmask.js"></script>
                        <div class="form-group">
                                <label for="telefono" id="labelTelefonoRegistro">Teléfono</label>
                                <input  id="inputTelefonoRegistro" type="tel"  name="telefono" placeholder="+506 8888-88-88">
                        </div>
                        
                        <script>
                                $(":input").inputmask();
                                $("#inputTelefonoRegistro").inputmask({"mask": "+506 9999-9999"});
                                
                        </script>
                        @php
                                $edificios = App\Edifico::all();
                                $seleccionado = $edificios->get(0);
                                $unidades = App\Unidad::where('sipa_edificios_unidades_edificio',$seleccionado->id);
                                
                        @endphp
                        <script type='text/javascript'>
                                function actualizar(elemento){
                                        console.log('si entra');
                                        var nom = elemento.options[elemento.selectedIndex].innerHTML;
                                        console.log(nom);
                                        var url = "/cbbx/"+nom;
                                        fetch(url).then(r => {
                                                console.log(r);
                                                return r.json();
                                        }).then(d => {
                                                var obj = JSON.stringify(d);
                                                var obj2 = JSON.parse(obj);
                                                console.log(obj2);
                                                var pisos = document.getElementById('pisoSelect');
                                                var unidades = document.getElementById('unidadSelect');
                                                for (var i = pisos.length - 1; i >= 0; i--) {
                                                        pisos.remove(i);
                                                }
                                                for (var i = unidades.length - 1; i >= 0; i--) {
                                                        unidades.remove(i);
                                                }
                                                for(var i = 0; i < obj2.pisos; i++){
                                                        var option = document.createElement('option');
                                                        option.innerHTML = i+1;
                                                        pisos.appendChild(option);
                                                }
                                                for(var i = 0; i < obj2.items.length; i++){
                                                        var option = document.createElement('option');
                                                        option.innerHTML = obj2.items[i];
                                                        unidades.appendChild(option);
                                                }
                                        });
                                }
                        </script>
                        <div class="form-group">
                                <label for="edificio" id="labelEdificioRegistro">Edificio</label>
                                <select id="edificioSelect" name="edificioSelect" onchange="actualizar(this);">
                                        @foreach($edificios as $edificio)
                                                <option value="{{$edificio->sipa_edificios_nombre}}" >{{$edificio->sipa_edificios_nombre}}</option>
                                        @endforeach
                                </select>
                        </div>
                        <div class="form-group">
                                <label for="piso" id="labelPisoRegistro">Piso</label>
                                <select id="pisoSelect" name="pisoSelect">
                                        @for ($i = 0; $i < $seleccionado->sipa_edificios_cantidad_pisos; $i++)
                                                <option value="{{$i+1}}">{{$i+1}}</option>
                                        @endfor
                                        
                                </select>
                        </div>
                        <div class="form-group">
                                <label for="unidad" id="labelUnidadRegistro">Unidad</label>
                                <select id="unidadSelect" name ="unidadSelect">
                                        @foreach($unidades->cursor() as $unidad)
                                                <option value="{{$unidad->sipa_edificios_unidades_nombre}}">{{$unidad->sipa_edificios_unidades_nombre}}</option>
                                        @endforeach
                                </select>
                        </div>
                        <button name = "acceder" type="submit" class="btn btn-primary" id="acceder">Registrarse</button>
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
        <script
        src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script
        src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.all.min.js"></script>
        <script>
                // $('#acceder').on('click',function(){
                //         console.log("btn click");
                        
                // })
        function alertaSolicitud(){
                $(document).on('click', '#acceder', function(e){
                        swal(
                                'Registro Exitoso',
                                'Espere a que su solicitud de registro sea aceptada',
                                'success'
                        )
                });
        }

        </script>
        
    </body>
</html>
                                