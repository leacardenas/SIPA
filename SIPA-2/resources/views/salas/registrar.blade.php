@extends('plantillas.inicio')
@section('content')

<div class="row col-sm-12">
    <form method="get" action="{{url('/inventarioSalasBlade')}}">
    <button type="submit" type="button" class="btn btn-secondary volver">
        <span class="glyphicon glyphicon-chevron-left"></span> Volver
    </button>
    </form>
</div>

<div class="row justify-content-center col-sm-12">
    <h1 id="editarEncargado" class="tituloModal">Registrar Sala</h1>
</div>

<div class="row justify-content-center col-sm-12 configActivo">
 
    <form method="POST" action="{{ url('/registroSala') }}" class="configForm" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label class="editar_sala_label" id="num_sala_label">Número de sala</label>
            <input name = "num_sala_input" type="text" class="form-control" id="num_sala_input" placeholder="Ejemplo: 5" required>
        </div>

        <div class="form-group">
            <label class="editar_sala_label" id="ubicacion_label">Ubicación</label>
            <input name = "ubicacion_input" type="text" class="form-control" id="ubicacion_input"
                placeholder="Ejemplo: Edificio de Vicerrectoría, Segundo Piso" required>
        </div>

        <div class="form-group">
            <label class="editar_sala_label" id="info_label">Capacidad de la sala</label>
            <input name = "cantidad_input" type="number" class="form-control" id="cantidad_input" required>
        </div>

        <div class="form-group">
            <label class="editar_sala_label" id="info_label">Información</label>
            <textarea name = "info_input" type="text" class="form-control" id="info_input" cols="100"
                placeholder="Ingrese información de la sala" required></textarea>
        </div>

        <div class="form-group">
            <label class="editar_sala_label" id="foto_sala_label">Foto de la sala</label>
            {{-- <form method="post" enctype="multipart/form-data"> --}}
                <input type="file" name="foto_sala" accept="image/*" onchange="cargarImagen(event)" >
            {{-- </form> --}}
            <br>
            <label class="editar_sala_label" id="vista_prev_label"><b>Vista previa</b></label>
            <br>
            <img id="img_previa">
        </div>

        <button class="btn botonLargo" type="submit" id = "guardarSala" >Guardar</button>
        
    </form>
</div>
<script>
var cargarImagen = function (event) {
    var output = document.getElementById('img_previa');
    output.src = URL.createObjectURL(event.target.files[0]);
};

$('#cantidad_input').change(function(){
    var capacidad = this.value;

    if(capacidad <= 0){
        Swal.fire({
            icon: 'warning',
            title: 'Alerta!',
            text: 'La capacidad de la sala debe ser mayor que 0',
            timer: 6000,
            showConfirmButton: false,
            showCloseButton: true,
            });
            document.getElementById("guardarSala").disabled = true;
    }else{
        document.getElementById("guardarSala").disabled = false;
    }
});

$('#num_sala_input').change(function(){
    var numSala = this.value;
    var url = "existeSala/"+numSala;

    fetch(url).then(r => {
            return r.json();
        }).then(d => {
            var obj = JSON.stringify(d);
            var obj2 = JSON.parse(obj);
            if(obj2.respuesta == 'Existe'){
                Swal.fire({
                    icon: 'warning',
                    title: 'Alerta',
                    text: 'El número de sala ya se encuentra registrado en el sistema',
                    timer: 6000,
                    showConfirmButton: false,
                    showCloseButton: true,
                });
                document.getElementById("guardarSala").disabled = true;
            }else{
                document.getElementById("guardarSala").disabled = false;
            }
        });
});

$('.configForm').submit(function(){

    Swal.fire({
            icon: 'success',
            title: '¡Realizado con éxito!',
            text: 'La sala se ha registrado exitosamente',
            timer: 6000,
            showConfirmButton: false,
            showCloseButton: true,
            });

});
</script>
</div>
    @endsection