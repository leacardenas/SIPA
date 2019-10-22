<div id="modalBorrarActivo" class="modal">
    <div class="contenidoModal" id="contenidoRegistrar">
        <span class="cerrar" onclick="cerrarModal(event, 'modalBorrarActivo')">&times;</span>
        <h1 id="registrarActivo">Borrar activo</h1>
        Esta seguro que quiere borrar el articulo:

        <?php
            echo "<script>document.writeln(seleccionado);</script>";
        ?>
    </div>
</div>