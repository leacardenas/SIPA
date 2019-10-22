<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!--<link href="{{ asset('sass/app.css') }}" rel="stylesheet">-->

        <title>Registrarse</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Mukta|Sanchez|Vidaloka&display=swap" rel="stylesheet">

    </head>
    <body id="cuerpoAtv">
        <div class="container">
            <div id="pantalla">
                <div id="formularioRegistro">  
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
                    <h3 id="tituloFormularioActivo">Registro de Activos</h3>
                        <form method="POST" action="{{ route('activos.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="placaActivo" id="labelPlacaActivo">Placa</label>
                            <input id="placaActivo" type="text"  name="placaActivo" placeholder="Ingrese el numero de placa">
                        </div>
                        <div class="form-group">
                                <label for="nombreActivo" id="labelNombreActivo">Nombre</label>
                                <input id="nombreActivo" type="text"  name="nombreActivo" placeholder="Ingrese el nombre del activo">
                        </div>
                        <div class="form-group">
                                <label for="descripcionActivo" id="labelDescripcionActivo">Descripción del activo</label>
                                <input id="descripcionActivo" type="text"  name="descripcionActivo" placeholder="Ingrese la descripción del activo">
                        </div>
                        <div class="form-group">
                                <label for="marca" id="labelMarcaActivo">Marca</label>
                                <input id="marcaActivo" type="text" name="marcaActivo" placeholder="Ingrese la marca del activo">
                        </div>
                        <div class="form-group">
                                <label for="modelo" id="labelModeloActivo">Modelo</label>
                                <input id="modeloActivo" type="text"  name="modeloActivo" placeholder="Ingrese el modelo del activo">
                        </div>
                        <div class="form-group">
                                <label for="precio" id="labelPrecioActivo">Precio</label>
                                <input id="precioActivo" type="number"  name="precioActivo" placeholder="Ingrese el modelo del activo" min = "30000">
                        </div>
                        <div class="form-group">
                                <label for="serie" id="labelSerieActivo">Serie</label>
                                <input id="serieActivo" type="text"  name="serieActivo" placeholder="Ingrese el número de serie del activo">
                        </div>
                        <div class="form-group">
                            <label for="unidad" id="labelUnidadActivo">Unidad</label>
                            <input id="unidadActivo" type="text"  name="unidadActivo" placeholder="Ingrese la unidad del activo">
                        </div>
                        <div class="form-group">
                            <label for="cedulaResponsable" id="labelCedulaResponsable">Ced. Responsable</label>
                            <input onchange="verificarResponsable(this)" id="cedResponsableAct" type="text"  name="cedResponsableAct" placeholder="Ingrese el numero de cedula del responsable del activo">
                        </div>
                        <div class="form-group">
                            <label for="responsableNombre" id="labelNomResponsableAct">Nombre del Responsable</label>
                            <input id="nomResponsableAct" type="text"  name="nomResponsableAct" placeholder="Ingrese el nombre del responsable del activo" readonly>
                        </div>
                        <div class="form-group">
                            <label for="encargadoCedula" id="labelencargadoCedula">Ced. Encargado</label>
                            <input onchange="verificarEncargado(this);" id="cedEncargadoAct" type="text"  name="cedEncargadoAct" placeholder="Ingrese el numero de cedula del encargado del activo" >
                        </div>
                        <div class="form-group">
                            <label for="encargadoNombre" id="labelencargadoNombre">Nombre del Encargado</label>
                            <input id="nomEncargadoAct" type="text"  name="nomEncargadoAct" placeholder="Ingrese el nombre del encargado del activo" readonly>
                        </div>
                        <div class="form-group">
                            <label for="edificio" id="labeledificio">Edificio</label>
                            <input id="edificioAct" type="number"  name="edificioAct" placeholder="Ingrese el edificio del activo" min = "1">
                        </div>
                        <div class="form-group">
                            <label for="ubicacion" id="labelubicacion">Ubicacion</label>
                            <input id="ubicacionAct" type="text"  name="ubicacionAct" placeholder="Ingrese la ubicacion del activo">
                        </div>
                        <div class="form-group">
                            <label for="imagen" id="labelimagen">Imagen del Activo</label>
                            <input id="imagenAct" type="file"  name="imagenAct" placeholder="Inserte la imagen del activo">
                        </div>
                        <button type="submit" class="btn btn-primary" id="acceder">Registrarse</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>