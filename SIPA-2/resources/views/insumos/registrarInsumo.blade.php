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
    $edificios = App\Edifico::all();
    $seleccionado = $edificios->get(0);
    $unidades = App\Unidad::where('sipa_edificios_unidades_edificio',$seleccionado->id);
    $estados = App\EstadoActivo::orderBy('sipa_estado_activo_orden', 'ASC')->get();
    @endphp

    <form method="POST" action="{{ route('activos.store') }}" enctype="multipart/form-data" class="configForm">
        @csrf
        <div class="form-group">
            <label>Nombre</label>
            <input class=" form-control" type="text" placeholder="Ingrese el nombre del insumo" required>
        </div>
        <div class="form-group">
            <label>Descripción</label>
            <textarea class="form-control" rows="5" type="text" placeholder="Ingrese la descripción del insumo" required></textarea>
        </div>
        <div class="form-group">
            <label>Tipo</label>
            <input class=" form-control" type="text" placeholder="Ejemplo: unidad, paquete, caja, envase" required>
        </div>
        <div class="form-group">
            <label>Cantidad</label>
            <input class="form-control" type="number" required>
        </div>
        <div class="form-group">
            <label>Costo unitario</label>
            <input class="form-control" type="text" placeholder="30.000" required>
        </div>
         <script>
                $("#precioActivo").mask('###.###.###.###.###.##0', {reverse: true});
        </script>    
        
        
        <button type="submit" class="btn boton-config" id="registrarActivoBoton">
            Guardar
        </button>
    </form>

<script>
function actualizar(elemento) {
    console.log('si entra');
    var nom = elemento.options[elemento.selectedIndex].innerHTML;
    console.log(nom);
    var url = "cbbx/" + nom;
    fetch(url).then(r => {
        console.log(r);
        return r.json();
    }).then(d => {
        var obj = JSON.stringify(d);
        var obj2 = JSON.parse(obj);
        console.log(obj2);
        var pisos = document.getElementById('selectPlantaActivo');
        var unidades = document.getElementById('selectUnidadEjecutoraActivo');
        for (var i = pisos.length - 1; i >= 0; i--) {
            pisos.remove(i);
        }
        for (var i = unidades.length - 1; i >= 0; i--) {
            unidades.remove(i);
        }
        var seleccionUnPiso = document.createElement('option');

        for (var i = 0; i < obj2.pisos; i++) {
            var option = document.createElement('option');
            option.innerHTML = i + 1;
            pisos.appendChild(option);
        }

        var seleccionUnaUnidad = document.createElement('option');

        for (var i = 0; i < obj2.items.length; i++) {
            var option = document.createElement('option');
            option.innerHTML = obj2.items[i];
            unidades.appendChild(option);
        }
    });
}

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