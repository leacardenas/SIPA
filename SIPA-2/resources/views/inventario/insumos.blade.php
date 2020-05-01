@extends('plantillas.inicio')

@section('content')
@php
$cedula = session('idUsuario');
$user = App\User::where('sipa_usuarios_identificacion',$cedula)->get()[0];
$modulo = App\Modulo::where('sipa_opciones_menu_codigo',"INV_INSUMO")->get()[0];
$permiso = App\Permiso::where('sipa_permisos_roles_role', $user->rol->sipa_roles_id)->where('sipa_permisos_roles_opciones_menu', $modulo->sipa_opciones_menu_id)->get()[0];
$insumos = App\Insumos::all();
@endphp

<div class="row col-sm-12">
    <form method="get" action="{{url('/inventario')}}">
    <button type="submit" type="button" class="btn btn-secondary volver">
        <span class="glyphicon glyphicon-chevron-left"></span> Volver
    </button>
    </form>
</div>

<div class="row col-sm-12">

        <div class="row justify-content-center col-sm-12">
            <h1 id="activos-registrados">Insumos Registrados</h1>
        </div>
    
    <div class="row botones-activos">
        <div class="col-sm-6">
            @if($permiso->sipa_permisos_roles_crear)
            <form method="get" action="{{url('/registrarInsumo')}}">
            <button type="submit" class="btn btn-primary" >
                <span class="glyphicon glyphicon-plus"></span> Registrar
            </button>
            </form>
            @endif
        </div>
        <div class="col-sm-6">
            @if($permiso->sipa_permisos_roles_editar)
            <form method="GET" action="{{url('/entregarInsumo')}}">
            <button type="submit" class="btn btn-primary">
                <span class="glyphicon glyphicon-edit"></span> Asignar
            </button>
            </form>
            @endif
        </div>
    </div>
    
    <div class="row col-sm-12 justify-content-center">

        <div class="col-sm-12 table-responsive-sm table-wrapper-scroll-y">
        @if(count($insumos) > 0)
            <table class="table table-striped table-hover" id="table-usuarios">
                <thead>
                <tr>
                    <th scope="col" class="text-center">Código</th>
                    <th scope="col" class="text-center">Nombre</th>
                    <th scope="col" class="text-center">Descripción</th>
                    <th scope="col" class="text-center">Tipo</th>
                    <th scope="col" class="text-center">Cantidad</th>
                    <th scope="col" class="text-center">Costo Unitario</th>
                    <th scope="col" class="text-center">Acción</th>
                </tr>
                </thead>

                @foreach($insumos as $insumo)
                <tbody class="text-center">
                    <tr id="{{$insumo->sipa_insumos_id}}"> 
                        <th class="text-center"> {{$insumo->sipa_insumos_codigo}} </th>
                        <td> {{$insumo->sipa_insumos_nombre}} </td>
                        <td> {{$insumo->sipa_insumos_descrip}} </td>
                        <td> {{$insumo->sipa_insumos_tipo}} </td>
                        <td> {{$insumo->sipa_insumos_cant_exist}} </td>
                        <td> {{$insumo->sipa_insumos_costo_uni}} </td>
                        <td> 
                            <div class="col-sm-12">
                                
                                <div class="col-sm-4">
                                    @if($permiso->sipa_permisos_roles_borrar)
                                    <a data-toggle="modal" data-target="#borrarModal" class="btn btn-danger borrar-btn" id="{{$activo->sipa_activos_id}}">
                                        <span class="glyphicon glyphicon-trash"></span> Borrar
                                    </a>
                                    @endif
                                </div>
                                <div class="col-sm-4">
                                    @if($permiso->sipa_permisos_roles_editar)
                                 
                                    <a data-toggle="modal" data-target="#editarModal" class="btn btn-primary editar-btn" id="{{$insumo->sipa_insumos_id}}" >
                                        <span class="glyphicon glyphicon-edit"></span> Cantidad
                                    </a>
                                    @endif
                                </div>
                                <div class="col-sm-4">
                                    @if($permiso->sipa_permisos_roles_editar)
                                  
                                    <a data-toggle="modal" data-target="#agregarModal" class="btn btn-primary borrar-btn" id="{{$insumo->sipa_insumos_id}}" >
                                        <span class="glyphicon glyphicon-plus"></span> Agregar
                                    </a>
                                    @endif
                                </div>

                            </div>
                        </td>
                    </tr>
                </tbody>
                @endforeach
                @else
                    <div class="alerta mb-5">
                     <i class="fas fa-exclamation-triangle"></i> No hay insumos registrados en el sistema
                    </div>
                @endif
            </table>
        </div>

        <!-- MODAL EDITAR CANTIDAD-->
        <div class="modal fade" id="editarModal" tabindex="-1" role="dialog" aria-labelledby="editarModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form method="POST" action="{{ url('/editarExistInsumos') }}" class="borrarForm"c id="editarCntInsumos" >
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title">Editar Cantidad del Insumo</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="col-sm-12 mb-3">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadioInline1" name="customRadioInline1" value = "aumentar" class="custom-control-input" checked>
                                    <label class="custom-control-label" for="customRadioInline1">Aumentar</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadioInline2" name="customRadioInline1" value="disminuir" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadioInline2">Disminuir</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Cantidad</label>
                                <input onchange="verficarActv(this);" name ="nuevaCanti" type="number" class="form-control" placeholder="Ingrese la cantidad" required>
                            </div>
                            <div class="form-group">
                                <label>Razón</label>
                                <textarea name = "editMotivo" class="form-control" rows="5" type="text" placeholder="Ingrese la razón del cambio en la cantidad del insumo" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" id="insumoId" name="insumoId">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                            <button id="submitButton" type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

                       
        <!-- MODAL Borrar -->
        <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" id="borrarModal">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Borrar Insumo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>¿Está seguro que desea eliminar el insumo?</p>
                    </div>
                    <div class="modal-footer">
                    <form method="POST" action="{{ url('/activ') }}" class="borrarForm"c id="editarRespon" >
                        @csrf
                        <input type="hidden" id="activoId" name="activoId">
                        <button type="submit" class="btn btn-primary" name= "aceptar" id="aceptar">Aceptar</button>
                    </form>
                    <form method="GET" action="{{ url ('/inventarioEquipos')}}" >
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL AGREGAR -->
        <div class="modal fade" id="agregarModal" tabindex="-1" role="dialog" aria-labelledby="agregarModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form method="POST" action="{{ url('/editarExistInsumos') }}" class="borrarForm"c id="editarCntInsumos" >
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title">Agregar Insumos</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Número de documento</label>
                                <input type="text" class="form-control" required> 
                            </div>

                            <div class="form-group">
                                <label>Seleccione el documento</label>
                                <input type="file" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Cantidad</label>
                                <input type="number" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Tipo</label>
                                <input type="text" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Descripción</label>
                                <textarea name = "info_input" type="text" class="form-control" id="info_input" cols="100" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" id="insumoId" name="insumoId">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                            <button id="submitButton" type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

<script type="text/javascript">
$(".editar-btn").click(function(){
    var actID = this.id;

    $('#insumoId').attr('value', actID);

});


function verficarActv(elemento) {
                            
    var accion = document.getElementsByName('customRadioInline1');
    
    
    if(accion[1].checked){
        var id = document.getElementById('insumoId');
        var url = "verificarExist/" + elemento.value + "/" + id.value;
        fetch(url).then(r => {
            return r.json();
        }).then(d => {
            var obj = JSON.stringify(d);
            var obj2 = JSON.parse(obj);
            console.log(obj2);
            if(obj2.existencia == "insuficientes"){
                Swal.fire({
                    icon: 'warning',
                    title: 'Alerta',
                    text: 'No hay suficientes insumos en el sistema. La cantidad en existecia es '+ obj2.cantidad,
                    timer: 6000,
                    showConfirmButton: false,
                    showCloseButton: true,
                });
                // alert('No hay suficientes insumos en el sistema. La cantidad en existecia es' + obj2.cantidad);
                document.getElementById("submitButton").disabled = true;
            }else{
                document.getElementById("submitButton").disabled = false;
            }
        });
    }
}

</script>


@endsection