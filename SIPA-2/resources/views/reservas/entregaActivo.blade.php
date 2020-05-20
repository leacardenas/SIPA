@extends('plantillas.inicio')
@section('content')
<div class="row col-sm-12">
    <form method="get" action="{{url('/entregas')}}">
        <button type="submit" type="button" class="btn btn-secondary volver">
            <span class="glyphicon glyphicon-chevron-left"></span> Volver
        </button>
    </form>
</div>

<div class="row justify-content-center col-sm-12">
    <h1 id="editarEstado" class="tituloModal">Entrega de Activo</h1>
</div>

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
                    <th scope="col" class="text-center">Placa del activo</th>
                    <th scope="col" class="text-center">Nombre del activo</th>
                    <th scope="col" class="text-center">Fecha Inicial</th>
                    <th scope="col" class="text-center">Hora Inicial</th>
                    <th scope="col" class="text-center">Fecha Final</th>
                    <th scope="col" class="text-center">Hora Final</th>
                    <th scope="col" class="text-center">Funcionario</th>
                    <th scope="col" class="text-center">Estado</th>
                </tr>
            </thead>

            <tbody class="text-center" id="tablaReservas">
                <tr id=""> 
                    <td data-label="Placa del activo"> <b> KDMSJD2545 </b> </td>
                    <td data-label="Nombre del activo"> Computadora </td>
                    <td data-label="Fecha Inicial"> 15/4/2020 </td>
                    <td data-label="Hora Inicial"> 10:00am </td>
                    <td data-label="Fecha Final"> 15/4/2020 </td>
                    <td data-label="Hora Final"> 11:00am </td>
                    <td data-label="Funcionario"> Fiorella Salgado </td>
                    <td data-label="Estado">
                        <select class="form-control select2" required>
                            <option disabled selected value>No Entregado</option>
                            <option>Entregado</option>
                            <option>No Entregado</option>
                        </select>
                    </td>
                </tr> --}}
            </tbody>
        </table>
    </div>

    <button class="btn botonGrande"> Guardar </button>

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

$(document).ready(function() {
    $('.select2').select2();
});

</script>

@endsection