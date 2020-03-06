@extends('plantillas.inicio')
@section('content')
<section class="info_container">
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
    </form>
</section> 
@endsection