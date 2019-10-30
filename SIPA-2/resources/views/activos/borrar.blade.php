<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<div id="modalBorrarActivo" class="modal">
    <div class="contenidoModal" id="contenidoRegistrar">
        <span class="cerrar" onclick="cerrarModal(event, 'modalBorrarActivo')">&times;</span>
        <h1 id="registrarActivo">Borrar activo</h1>
        <p>¿Esta seguro que quiere borrar el articulo seleccionado?</p>

        <div>
            <script type="text/javascript">
                function borrarActivo(e,m) {
                    console.log(seleccionado);
                    var url = "activ/"+seleccionado;
            
                    fetch(url)
                    .then(r => {
                        console.log(r);
                        return r.json();
                    }).then(d => {
                        var obj = JSON.stringify(d);
                        var obj2 = JSON.parse(obj);
                        console.log(obj2);
                        cerrarModal(e, m);
                        document.location.reload();
                    });
                }
       
            </script>
            {{-- <form id = "borrar" method="GET" action="{{ url('/activos/8') }}">
            @csrf --}}
                <button  class="btn btn-danger" onclick="borrarActivo(event,'modalBorrarActivo');">
                    <span></span> Si
                </button>
            {{-- </form> --}}
            <button class="btn btn-primary" onclick="cerrarModal(event, 'modalBorrarActivo')">
                <span></span> No
            </button>
        </div>
    </div>
</div>
