@extends('plantillas.inicio')
@section('content')

<div class="row col-sm-12">
    <form method="get" action="{{url('/inventarioSalasBlade')}}">
    <button type="submit" type="button" class="btn btn-secondary volver">
        <span class="glyphicon glyphicon-chevron-left"></span> Volver
    </button>
    </form>
</div>

<div class="row justify-content-center">
 
 <section class="editar_sala_container">
            <h1 id="editar_sala_h1">Registrar Sala</h1>
            <form method="POST" action="{{ url('/registroSala') }}" class="editar_sala_form" enctype="multipart/form-data">
                @csrf
                <label class="editar_sala_label" id="num_sala_label">Número de sala</label>
                <input name = "num_sala_input" type="text" class="form-control" id="num_sala_input" placeholder="Ejemplo: 5" required>
                <br>
                <label class="editar_sala_label" id="ubicacion_label">Ubicación</label>
                <input name = "ubicacion_input" type="text" class="form-control" id="ubicacion_input"
                    placeholder="Ejemplo: Edificio de Vicerrectoría, Segundo Piso" required>
                <br>
                <label class="editar_sala_label" id="info_label">Información</label>
                <textarea name = "info_input" type="text" class="form-control" id="info_input" cols="100"
                    placeholder="Ingrese información de la sala" required></textarea>
                <br>
                <label class="editar_sala_label" id="foto_sala_label">Foto de la sala</label>
                {{-- <form method="post" enctype="multipart/form-data"> --}}
                    <input type="file" name="foto_sala" accept="image/*" onchange="cargarImagen(event)" required>
                {{-- </form> --}}
                <br>
                <br>
                <label class="editar_sala_label" id="vista_prev_label"><b>Vista previa</b></label>
                <br>
                <img id="img_previa">
                <br>
                <div class="button_div">
                    <button id="editar_sala_button">Guardar</button>
                </div>
            </form>
        </section>

        <script>
        var cargarImagen = function (event) {
            var output = document.getElementById('img_previa');
            output.src = URL.createObjectURL(event.target.files[0]);
        };
    </script>
</div>
    @endsection