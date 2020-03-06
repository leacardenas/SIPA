@extends('plantillas.inicio')
@section('content')
<section class="info_container">
    <h1 class="info_h1">Dar de baja Sala</h1>
    <form method="POST" action="{{ url('/darBajaSala') }}" class="editar_sala_form" enctype="multipart/form-data">
    @csrf
    <label>Número de Sala</label>
    <input name = "num_sala_input" type="text" class="editar_sala_input" id="num_sala_input" value = "{{$sala->sipa_salas_codigo}}" readonly>
    <label>Ingrese la razón por la que desea dar de baja esta sala</label>
    <textarea name = "razon_baja_sala" id="razon_baja_sala" type="text" rows="4" cols="50" required></textarea>
    <label>Seleccione el formulario de dar de baja de esta sala</label>
    <input type="file" name="formulario_sala" required>
    <button>Dar de baja</button>
    </form>
</section> 
@endsection