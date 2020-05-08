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
    <h1 id="editarEstado" class="tituloModal">Devolución de Sala</h1>
</div>

<div class="row col-sm-12 justify-content-center configActivo">
    <div class="col-sm-12 table-responsive-sm table-wrapper-scroll-y">
        <h4>Reservas de Salas</h4>
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
                    <th scope="col" class="text-center">Número de sala</th>
                    <th scope="col" class="text-center">Ubicación de sala</th>
                    <th scope="col" class="text-center">Fecha Inicial</th>
                    <th scope="col" class="text-center">Hora Inicial</th>
                    <th scope="col" class="text-center">Fecha Final</th>
                    <th scope="col" class="text-center">Hora Final</th>
                    <th scope="col" class="text-center">Funcionario</th>
                    <th scope="col" class="text-center">Estado</th>
                    <th scope="col" class="text-center">Acción</th>
                </tr>
            </thead>

            <tbody class="text-center" id="tablaReservas">
                <tr id=""> 
                    <th class="text-center"> Sala 1 </th>
                    <td> Edificio Vicerrectoria de Docencia, 2 piso </td>
                    <td> 15/4/2020 </td>
                    <td> 10:00am </td>
                    <td> 15/4/2020 </td>
                    <td> 11:00am </td>
                    <td> Fiorella Salgado </td>
                    <td>
                        <select class="form-control" id="estadoReserva" required>
                            <option disabled selected value>No Devuelta</option>
                            <option>Devuelta</option>
                            <option>No Devuelta</option>
                        </select>
                    </td>
                    <td>
                        <a data-toggle="modal" class="btn btn-danger borrar-btn observacionBtn" id="">
                            <span class="far fa-eye"></span> Observación
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <button class="btn boton-reserva"> Guardar </button>

    <!-- MODAL OBSERVACION  -->
    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" id="observacionModal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Estado de Sala</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Observación</label>
                    <textarea name = "observacion" class="form-control" rows="5" type="text" placeholder="Digite una observación sobre la devolución de la sala"></textarea>
                </div>
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

<script>

//Desactivar boton
$(document).ready(function(){

    $(".observacionBtn").attr('disabled', true);
    $(".observacionBtn").css('cursor', 'no-drop');

    $("body").on("change", "#estadoReserva", function(){
        var selected = $(this).val();
        var row = $(this).closest('tr');
        var button = row.find('.btn');

        if(selected === 'Devuelta'){
            button.attr('disabled', false);
            button.attr('data-target', "#observacionModal");
            button.css('cursor', 'pointer');
        }
        
        if(selected === 'No Devuelta'){
            button.attr('disabled', true);
            button.css('cursor', 'no-drop');
            button.removeAttr('data-target');
        }
    });

});

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