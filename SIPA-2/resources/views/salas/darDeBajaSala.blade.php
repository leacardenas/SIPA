@extends('plantillas.inicio')
@section('content')
<section class="info_container">
<<<<<<< HEAD
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
=======
    <h1 class="info_h1">Dar de baja <b>Sala X</b></h1>
    <form  method="POST"  class="baja_sala_form">
    <label class="baja_sala_label">Ingrese la razón por la que desea dar de baja esta sala</label>
    <br>
    <textarea class="baja_sala_input" id="info_input" id="razon_baja_sala" type="text" rows="4" cols="50" required></textarea>
    <br>
    <br>
    <label class="baja_sala_label">Seleccione el formulario de dar de baja de esta sala</label>
    <input type="file" name="formulario_sala" required></input>
    <br>
    <div class="button_div">
        <button id="baja_sala_button">Dar de baja</button>
    </div>
>>>>>>> sipa-frontend
    </form>
</section> 
@endsection