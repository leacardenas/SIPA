@extends('plantillas.inicio')
@section('content')
     <section class="editar_sala_container">
        @php
        $salas = App\Salas::all();
        @endphp
            <h1 id="editar_sala_h1">Editar Sala</h1>
            <form method="POST" action="{{ url('/editarSala') }}" class="editar_sala_form">
                @csrf
                <label class="editar_sala_label" id="num_sala_label">Número de sala</label>
                <input name = "num_sala_input" type="text" class="editar_sala_input" id="num_sala_input" value = "{{$sala->sipa_salas_codigo}}" readonly>
                <br>
                <label class="editar_sala_label" id="ubicacion_label">Ubicación</label>
                <input name = "ubicacion_input" type="text" class="editar_sala_input" id="ubicacion_input"
                    placeholder="Ejemplo: Edificio de Vicerrectoría, Segundo Piso">
                <br>
                <label class="editar_sala_label" id="info_label">Información</label>
                <textarea name = "info_input" type="text" class="editar_sala_input" id="info_input" cols="100"
                    placeholder="Ingrese información de la sala"></textarea>
                <br>
                <label class="editar_sala_label" id="foto_sala_label">Foto de la sala</label>              
                <input type="file" name="foto_sala" accept="image/*" onchange="cargarImagen(event)">  
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

@endsection