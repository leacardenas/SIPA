<div id="modalBorrarActivo" class="modal">
    <div class="contenidoModal" id="contenidoRegistrar">
        <span class="cerrar" onclick="cerrarModal(event, 'modalBorrarActivo')">&times;</span>
        <h1 id="registrarActivo">Borrar activo</h1>
        <p>¿Esta seguro que quiere borrar el articulo seleccionado?</p>

        <div>
            <form id = "borrar" method="GET" action="{{ url('/activos/{8}') }}">
            @csrf
                <button type="submit" class="btn btn-danger">
                    <span></span> Si
                </button>
            </form>
            <button class="btn btn-primary" onclick="cerrarModal(event, 'modalBorrarActivo')">
                <span></span> No
            </button>
        </div>
    </div>
</div>