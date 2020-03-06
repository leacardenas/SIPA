@extends('plantillas.inicio')
@section('content')
@php 
    $SalasLista = App\Salas:: all();
@endphp
<section class="info_container">
            <h1 class="info_h1">Información de Salas</h1>
                @foreach ($SalasLista as $sala)
                    <article class="info_sala_article">
                        <img src="data:image/{{$sala->sipa_salas_tipo_img}};base64,{{$sala->sipa_salas_imagen}}" class="sala_img" />
                        <div class="div_info_salas">
                        <h3 class="numero_sala">Sala {{$sala->sipa_salas_codigo}}</h3>
                            <label class="ubicacion_label"><i><b>Ubicación:</b></i></label>
                            <p class="ubicacion_text">
                                {{$sala->sipa_sala_ubicacion}}
                            </p>
                            <br>
                            <br>
                            <label class="info_label"><i><b>Información:</b></i></label>
                            <p class="info_text">
                                {{$sala->sipa_sala_informacion}}
                            </p>
                            <br>
                            <label class="estado_title"><i><b>Estado:</b></i></label>
                            <a class="estado_link" href="#">Click para ver estado de reserva</a>
                            <form method="get" action="{{url('irEditar', $sala->sipa_salas_codigo)}}">
                                <button class="editar_sala_button">Editar sala</button>
                            </form>

                            <form method="get" action="{{url('irDarDeBaja', $sala->sipa_salas_codigo)}}">
                                <button class="dar_baja_sala_button" >Dar de baja</button>
                            </form>
<<<<<<< HEAD
=======
                            <button class="dar_baja_sala_button" oncick="openModal()">Dar de baja</button>
>>>>>>> sipa-frontend
                        </div>
                    </article>
                @endforeach
        </section>

@endsection