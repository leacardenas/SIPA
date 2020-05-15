@extends('plantillas.inicio')
@section('content')
<div class="row col-sm-12">
    <form method="get" action="{{url('/devoluciones')}}">
        <button type="submit" type="button" class="btn btn-secondary volver">
            <span class="glyphicon glyphicon-chevron-left"></span> Volver
        </button>
    </form>
</div>

<div class="row justify-content-center col-sm-12">
    <h1 id="editarEstado" class="tituloModal">Devolución de Activo</h1>
</div>

@php
$estados = App\estadoReservas::all();
@endphp

<div class="row col-sm-12 justify-content-center configActivo">
    <div class="col-sm-12 table-responsive-sm table-wrapper-scroll-y">
        <h4>Reservas de Activos</h4>
        <div class="input-group-prepend">
            <span class="input-group-text">
                <svg class="bi bi-search" width="1em" height="1em" viewBox="0 0 16 16" fill="#00000" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 011.415 0l3.85 3.85a1 1 0 01-1.414 1.415l-3.85-3.85a1 1 0 010-1.415z" clip-rule="evenodd"/>
                    <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 100-11 5.5 5.5 0 000 11zM13 6.5a6.5 6.5 0 11-13 0 6.5 6.5 0 0113 0z" clip-rule="evenodd"/>
                </svg>
            </span>
            <input class="form-control" id="reservas" type="text" placeholder="Ingrese información de la reserva para buscar">
        </div>
        <br>

        <table class="table table-striped table-hover" id="table-usuarios">
            <thead>
                <tr>
                    <th scope="col" class="text-center">Código del activo</th>
                    <th scope="col" class="text-center">Nombre del activo</th>
                    <th scope="col" class="text-center">Fecha Inicial</th>
                    <th scope="col" class="text-center">Hora Inicial</th>
                    <th scope="col" class="text-center">Fecha Final</th>
                    <th scope="col" class="text-center">Hora Final</th>
                    <th scope="col" class="text-center">Funcionario</th>
                    <th scope="col" class="text-center">Acción</th>
                </tr>
            </thead>

            <tbody class="text-center" id="tablaReservas">
                <tr id=""> 
                    <th class="text-center"> KDMSJD2545 </th>
                    <td> Computadora </td>
                    <td> 15/4/2020 </td>
                    <td> 10:00am </td>
                    <td> 15/4/2020 </td>
                    <td> 11:00am </td>
                    <td> Fiorella Salgado </td>
                    <td>
                        <a data-toggle="modal" class="btn botonRojo" id="">
                            <span class="fas fa-undo-alt"></span> Devolución
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- <button class="btn botonGrande"> Guardar </button> -->

    <!-- MODAL OBSERVACION  -->
    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" id="borrarModal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Devolución de Activos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Observación</label>
                    <textarea name = "observacion" class="form-control" rows="5" type="text" placeholder="Digite una observación sobre la devolución de los activos"></textarea>
                </div>
                <legend>Estado de Activos</legend>
                
                <h4>Seleccione los activos que han sido devueltos</h4>
                
                <!-- Aqui empieza el for para crear los divs -->
                <hr>
                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="{{id del activo}}">
                        <label class="custom-control-label" for="{{id del activo}}">Codigo de activo - Nombre de activo</label>
                    </div>

                    <div class="form-group mt-2">
                        <label>Estado actual del activo</label>
                        <select class="form-control" id="estadoActivo" name="estadoActivo">
                        <option disabled selected value>Seleccione un estado</option>
            
                        <option value=""></option>
                    
                        </select>
                    </div>
                </div>
                <!-- AQUI TERMINA  -->
           
            </div>
            <div class="modal-footer">
            <form method="POST" action="{{ url('/activ') }}" class="borrarForm"c id="editarRespon" >
                @csrf
                <input type="hidden" id="activoId" name="activoId">
                <button type="submit" class="btn btn-primary" name= "aceptar" id="aceptar">Guardar</button>
            </form>
            <form method="GET" action="{{ url ('/devolucionActivo')}}" >
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </form>
            </div>
        </div>
    </div>

</div>

</div>

<script>

//BUSCAR INPUT

$(document).ready(function(){

  $("#reservas").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#tablaReservas tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});

</script>

@endsection