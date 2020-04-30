@extends('plantillas.inicio')

@section('content')
<div class="row col-sm-12">
    <form method="get" action="{{url('/configuracionesActivos')}}">
        <button type="submit" type="button" class="btn btn-secondary volver">
            <span class="glyphicon glyphicon-chevron-left"></span> Volver
        </button>
    </form>
</div>

<div class="row justify-content-center col-sm-12">
    <h1 id="editarEncargado" class="tituloModal">Editar encargado de activo</h1>
</div>

<div class="row col-sm-12 justify-content-center configActivo">
@php
$usuarios = App\User::all();
@php

    <div class="col-sm-12 table-responsive-sm table-wrapper-scroll-y">
        <table class="table table-striped table-hover" id="table-usuarios">
                <thead>
                <tr>
                    <th scope="col" class="text-center">Código</th>
                    <th scope="col" class="text-center">Nombre</th>
                    <th scope="col" class="text-center">Fecha inicial</th>
                    <th scope="col" class="text-center">Hora inicial</th>
                    <th scope="col" class="text-center">Fecha final</th>
                    <th scope="col" class="text-center">Hora Final</th>
                    <th scope="col" class="text-center">Funcionario</th>
                    <th scope="col" class="text-center">Acción</th>
                </tr>
                </thead>

                <!-- if() -->
                <tbody class="text-center">
                    <tr id="{{$activo->sipa_activos_id}}">
                        <th class="text-center">  </th>
                        <th class="text-center">  </th>
                        <th class="text-center">  </th>
                        <th class="text-center">  </th>
                        <th class="text-center">  </th>
                        <th class="text-center">  </th>
                        <th class="text-center">  </th>
                        <th class="text-center"> 
                            <a class="btn btn-primary ver-btn" href="{{url('verEquipos', $activo->sipa_activos_id)}}">
                                <span class="glyphicon glyphicon-edit"></span> Editar
                            </a>
                        </th>
                    </tr>
                </tbody>
            </table>
            <!-- @endforeach
            @else
                <div class="alerta mb-5">
                    <i class="fas fa-exclamation-triangle"></i> No hay reservas registradas en el sistema
                </div>
            @endif -->

        <!-- MODAL EDITAR RESERVA-->
        <div class="modal fade" id="editarModal" tabindex="-1" role="dialog" aria-labelledby="editarModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form method="POST" action="{{ url('/editarExistInsumos') }}" class="borrarForm"c id="editarCntInsumos" >
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title">Devolución de Activo</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        <div class="form-group">
                                <label>Estado del activo</label>
                                 <select class="form-control" placeholder="Seleccione activo..." required>
                                    <option disabled selected value>Seleccione una opción</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Observaciones</label>
                                <textarea name = "editMotivo" class="form-control" rows="5" type="text" placeholder="Ingrese observaciones sobre la devoluc" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" id="insumoId" name="insumoId">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                            <button id="submitButton" type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection