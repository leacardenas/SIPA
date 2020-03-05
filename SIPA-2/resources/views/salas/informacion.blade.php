@extends('plantillas.inicio')
@section('content')

<section class="info_container">
            <h1 class="info_h1">Información de Salas</h1>
            <article class="info_sala_article">
                <img src="imagenes/salasImg.png" class="sala_img" />
                <div class="div_info_salas">
                    <h3 class="numero_sala">Sala X</h3>
                    <label class="ubicacion_label"><i><b>Ubicación:</b></i></label>
                    <p class="ubicacion_text">
                        Vicerrectoría de Docencia, Segundo Piso.
                    </p>
                    <br>
                    <br>
                    <label class="info_label"><i><b>Información:</b></i></label>
                    <p class="info_text">
                        Capacidad para 10 personas. Cuenta con una mesa para 10 personas,
                        10 sillas, una television con conexion HDMI.
                    </p>
                    <br>
                    <label class="estado_title"><i><b>Estado:</b></i></label>
                    <a class="estado_link" href="#">Click para ver estado de reserva</a>
                    <button class="editar_sala_button" onclick="location.href='/editarSala'">Editar sala</button>
                    <button class="dar_baja_sala_button" oncick="openModal()">Dar de baja</button>
                </div>
            </article>
        </section>

@endsection