@extends('plantillas.inicio')
@section('content')
<section class="info_container">
    <h1 class="info_h1">Dar de baja <b>Sala X</b></h1>
    <form  method="POST">
    <label>Ingrese la razón por la que desea dar de baja esta sala</label>
    <textarea id="razon_baja_sala" type="text" rows="4" cols="50" ></textarea>
    <label>Seleccione el formulario de dar de baja de esta sala</label>
    <input type="file" name="formulario_sala"></input>
    <button>Dar de baja</button>
    </form>
</section> 
@endsection