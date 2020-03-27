
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Borrar Activo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>¿Está seguro que desea eliminar el activo?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Aceptar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>













<div id="modalBorrarActivo" class="modal">
    <div class="contenidoModal" id="contenidoRegistrar">
        <span class="cerrar" onclick="cerrarModal(event, 'modalBorrarActivo')">&times;</span>
        <h1 id="registrarActivo" class="tituloModal"> Borrar activo</h1>    
        <p>¿Esta seguro que quiere borrar el articulo seleccionado?</p>

        <div>
            <script type="text/ja   vascript">
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
