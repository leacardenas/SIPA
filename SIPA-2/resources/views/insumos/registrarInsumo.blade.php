@extends('plantillas.inicio')

@section('content')
<div class="row col-sm-12">
    <form method="get" action="{{url('/inventarioInsumos')}}">
        <button type="submit" type="button" class="btn btn-secondary volver">
            <span class="glyphicon glyphicon-chevron-left"></span> Volver
        </button>
    </form>
</div>

<div class="row justify-content-center col-sm-12">
    <h1 id="registrarActivo" class="tituloModal">Registrar Insumo</h1>
</div>

<div class="row col-sm-12 justify-content-center configActivo">
    @php 
    // <!--cambiar -->
    $usuarios = App\User::all();
    
    @endphp

    <form method="POST" action="{{ url('/ingresarInsumo') }}" enctype="multipart/form-data" class="configForm">
        @csrf
        <div class="form-group">
            <label>Nombre</label>
            <input name = "nombreInsumos" class=" form-control" type="text" placeholder="Ingrese el nombre del insumo" required>
        </div>
        
        <div class="form-group">
            <label>Descripción</label>
            <textarea name = "descripcionInsumos" class="form-control" rows="5" type="text" placeholder="Ingrese la descripción del insumo" required></textarea>
        </div>
        <div class="form-group">
            <label>Tipo</label>
            <input name = "tipoInsumos" class=" form-control" type="text" placeholder="Ejemplo: unidad, paquete, caja, envase" required>
        </div>
        <div class="form-group">
            <label>Cantidad</label>
            <input name = "cantidadInsumos" class="form-control" type="number" required>
        </div>
        <div class="form-group">
            <label>Costo unitario</label>
            <input name = "costoUnitarioInsumos" class="form-control" type="text" placeholder="30.000" required>
        </div>
         <script>
                $("#precioActivo").mask('###.###.###.###.###.##0', {reverse: true});
        </script>    
        
        
        <button type="submit" class="btn boton-config" id="registrarActivoBoton">
            Guardar
        </button>
    </form>

<script>


function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function(e) {
            $('#blah').attr('src', e.target.result);
        }
        document.getElementById("blah").style.display = "";
        reader.readAsDataURL(input.files[0]);
    }
}

$('.configForm').submit(function(){
    Swal.fire({
            icon: 'success',
            title: '¡Realizado con éxito!',
            text: 'El registro del insumo se ha realizado correctamente',
            timer: 6000,
            showConfirmButton: false,
            showCloseButton: true,
            });
});
</script>

@endsection