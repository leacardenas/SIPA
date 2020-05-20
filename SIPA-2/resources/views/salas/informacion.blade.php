@extends('plantillas.inicio')
@section('content')
@php 
    $SalasLista = App\Salas:: where('sipa_sala_activo',1)->get();
@endphp

<div class="row col-sm-12">
    <form method="get" action="{{url('/inventarioSalasBlade')}}">
    <button type="submit" type="button" class="btn btn-secondary volver">
        <span class="glyphicon glyphicon-chevron-left"></span> Volver
    </button>
    </form>
</div>

<div class="row justify-content-center col-sm-12">
    <h1 id="editarEstado" class="info_h1">Información de Salas</h1>
</div>

<div class="row col-sm-12 justify-content-center">
    <section class="info_container">
    @if(count($SalasLista) > 0)
            @foreach ($SalasLista as $sala)
                <article class="info_sala_article">
                    
                @if($sala->sipa_salas_nombre_img)
                    <img src="<?php echo "../..//archivosDelSistema/salas/imagenes/" . $sala->sipa_salas_nombre_img ?>" height="300" width="300">
                @else
                    <img src="{{asset('imagenes/sala.webp')}}" class="sala_img" />    
                @endif
                    <!-- @if($sala->sipa_salas_imagen == null) -->
                    <!-- @else
                        <img src="data:image/{{$sala->sipa_salas_tipo_img}};base64,{{$sala->sipa_salas_imagen}}" class="sala_img" />    
                    @endif -->
                    <div class="div_info_salas">
                        <div class="row col-sm-12">
                            <h3 class="numero_sala"><b>Sala {{$sala->sipa_salas_codigo}} </b></h3>
                        </div>

                        <div class="row col-sm-12">
                            <label class="ubicacion_label"><i><b>Ubicación: </b></i></label>
                            <p class="ubicacion_text">
                                    {{$sala->sipa_sala_ubicacion}}
                            </p>
                        </div>

                        <div class="row col-sm-12">
                            <label class="info_label"><i><b>Información: </b></i></label>
                            <p class="info_text">
                                    Capacidad para {{$sala->sipa_sala_capacidad}} personas. {{$sala->sipa_sala_informacion}}
                            </p>
                        </div>

                        <div class="row col-sm-12">
                            <label class="estado_title"><i><b>Estado: </b></i></label>
                            <a class="estado_link" href="/detalleReservaSala">Click para ver estado de reserva</a>
                        </div>
                            
                        <div class="row col-sm-5">
                            <div class="">
                                <a class="btn boton" href="{{url('irEditar', $sala->sipa_salas_codigo)}}">Editar</a>
                            </div>
                            <div class="ml-3">
                                <a class="btn boton" href="{{url('irDarDeBaja', $sala->sipa_salas_codigo)}}">Dar de baja</a>
                            </div>
                        </div>
                    </div>
                </article>
            @endforeach
            @else
                <div class="alerta mt-5">
                    <i class="fas fa-exclamation-triangle"></i> No hay salas registradas en el sistema
                </div>
            @endif
    </section>
</div>
@endsection 