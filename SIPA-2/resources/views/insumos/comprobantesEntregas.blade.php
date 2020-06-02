@extends('plantillas.inicio')

@section('content')

@php
$comprobantes = App\ComprobanteEntrega::orderBy('sipa_comprobantes_id', 'DESC')->get();
@endphp
<div class="row col-sm-12">
    <form method="get" action="{{url('/inventarioInsumos')}}">
        <button type="submit" type="button" class="btn btn-secondary volver">
            <span class="glyphicon glyphicon-chevron-left"></span> Volver
        </button>
    </form>
</div>

<div class="row justify-content-center col-sm-12">
    <h1 id="editarEstado" class="tituloModal">Comprobantes de Entregas de Insumos</h1>
</div>

<div class="row col-sm-12 justify-content-center configActivo">
    <div class="col-sm-12 table-responsive-sm table-wrapper-scroll-y">
        <h4>Buscar comprobante</h4>
        <div class="input-group-prepend">
            <span class="input-group-text">
                <svg class="bi bi-search" width="1em" height="1em" viewBox="0 0 16 16" fill="#00000" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 011.415 0l3.85 3.85a1 1 0 01-1.414 1.415l-3.85-3.85a1 1 0 010-1.415z" clip-rule="evenodd"/>
                    <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 100-11 5.5 5.5 0 000 11zM13 6.5a6.5 6.5 0 11-13 0 6.5 6.5 0 0113 0z" clip-rule="evenodd"/>
                </svg>
            </span>
            <input class="form-control" id="comprobantes" type="text" placeholder="Ingrese información de la reserva para buscar">
        </div>
        <br>

        <table class="table table-striped table-hover" id="table-usuarios">
            <thead>
                <tr>
                    <th scope="col" class="text-center">Número de Comprobante</th>
                    <th scope="col" class="text-center">Fecha de Ingreso</th>
                    <th scope="col" class="text-center">Funcionario que entregó</th>
                    <th scope="col" class="text-center">Funcionario que recibió</th>
                    <th scope="col" class="text-center">Acción</th>
                </tr>
            </thead>

            <tbody class="text-center" id="tablaComprobantes">
                @foreach ($comprobantes as $comprobante)
                @php
                 $entrega = App\AsignarInsumo::where('sipa_entrega_comprobante', $comprobante->sipa_comprobantes_id)->get()[0];   
                @endphp
                    <tr id=""> 
                        <td data-label="Número de Comprobante"><b>{{$comprobante->sipa_comprobantes_id}}</b></td>
                        <td data-label="Fecha de Ingreso"> {{$comprobante->created_at}}</td>
                        <td data-label="Funcionario que entregó">{{$entrega->entregadoPor->sipa_usuarios_nombre}}</td>
                        <td data-label="Funcionario que recibió">{{$entrega->asignadoA->sipa_usuarios_nombre}}</td>
                        <td data-label="Acción">
                            <a class="btn botonAzul" href="{{url('descargarComprobante',$comprobante->sipa_comprobantes_id)}}">
                                <span class="fas fa-file-download" ></span> Descargar Comprobante
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            @if (count($comprobantes)== 0)
                <div class="alerta mb-5">
                    <i class="fas fa-exclamation-triangle"></i> No existen comprobantes registrados en el sistema
                </div>
            @endif
        </table>
    </div>

</div>

<script>
//BUSCAR INPUT

$(document).ready(function(){

  $("#comprobantes").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#tablaComprobantes tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
@endsection