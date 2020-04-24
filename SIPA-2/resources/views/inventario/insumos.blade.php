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

        <div class="col-sm-12 table-responsive-sm">
            <table class="table table-striped" id="table-usuarios">
                <thead>
                <tr>
                    <th scope="col" class="text-center">Código</th>
                    <th scope="col" class="text-center">Nombre</th>
                    <th scope="col" class="text-center">Descripción</th>
                    <th scope="col" class="text-center">Tipo</th>
                    <th scope="col" class="text-center">Cantidad</th>
                    <th scope="col" class="text-center">Costo Unitario</th>
                </tr>
                </thead>

                @if(count($insumos) > 0)
                @foreach($insumos as $insumo)
                <tbody class="text-center">
                    <tr id="{{$insumo->sipa_insumos_id}}"> 
                        <th class="text-center"> {{$insumo->sipa_insumos_codigo}} </th>
                        <td> {{$insumo->sipa_insumos_descrip}} </td>
                        <td> {{$insumo->sipa_insumos_nombre}} </td>
                        <td> {{$insumo->sipa_insumos_tipo}} </td>
                        <td> {{$insumo->sipa_insumos_cant_exist}} </td>
                        <td> {{$insumo->sipa_insumos_costo_uni}} </td>
                        <td> 
                            <div class="col-sm-12">
                                <div class="col-sm-4">
                                    @if($permiso->sipa_permisos_roles_ver)
                                    {{-- href="{{url('verEquipos', $activo->sipa_activos_id)}}" --}}
                                        <a class="btn btn-primary ver-btn" >
                                            <span class="far fa-eye"></span> Ver
                                        </a>
                                    @endif
                                </div>
                                <div class="col-sm-4">
                                    @if($permiso->sipa_permisos_roles_borrar)

                                    <a data-toggle="modal" data-target="#borrarModal" class="btn btn-danger borrar-btn" id="$activo->sipa_activos_id">
                                        <span class="glyphicon glyphicon-trash"></span> Borrar
                                    </a>
                                    @endif
                                </div>
                                <div class="col-sm-4">
                                    @if($permiso->sipa_permisos_roles_editar)
                                    {{-- data-whatever="{{$activo->sipa_insumos_nombre}}" --}}
                                    <a data-toggle="modal" data-target="#editarModal" class="btn btn-danger editar-btn" id="{{$insumo->sipa_insumos_id}}" >
                                        <span class="glyphicon glyphicon-edith"></span> Editar Cantidad
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
                @endforeach
                @else
                <tbody>
                    <h2>
                        No hay insumos en el sistema.
                    </h2>
                </tbody>
                @endif
            </table>
        </div>

        <!-- MODAL -->
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
                            <div class="col-sm-12">
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
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button id="submitButton" type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
                    <script type="text/javascript">
                        $(".editar-btn").click(function(){
                            var actID = this.id;
                        
                            $('#insumoId').attr('value', actID);
                        
                        });

                        //hacer fetch para verificar que no se intenten disminuir mas de lo que existe
                        // var radios = document.getElementsByName('genderS');

                        // for (var i = 0, length = radios.length; i < length; i++) {
                        // if (radios[i].checked) {
                        //     // do whatever you want with the checked radio
                        //     alert(radios[i].value);

                        //     // only one radio can be logically checked, don't check the rest
                        //     break;
                        // }
                        // }

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
                                        alert('No hay suficientes insumos en el sistema');
                                        document.getElementById("submitButton").disabled = true;
                                    }else{
                                        document.getElementById("submitButton").disabled = false;
                                    }
                                });
                            }
                        }
                    </script>
            </div>
        </div>
    </div>
</div>


@endsection