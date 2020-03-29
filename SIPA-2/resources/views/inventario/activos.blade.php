@extends('plantillas.inicio')

@section('content')
@php
$cedula = session('idUsuario');
$user = App\User::where('sipa_usuarios_identificacion',$cedula)->get()[0];
$modulo = App\Modulo::where('sipa_opciones_menu_codigo',"INV_EQUIPO")->get()[0];
$permiso = App\Permiso::where('sipa_permisos_roles_role', $user->rol->sipa_roles_id)->where('sipa_permisos_roles_opciones_menu', $modulo->sipa_opciones_menu_id)->get()[0];
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
            <h1 id="activos-registrados">Activos Registrados</h1>
        </div>
    
    <div class="row botones-activos">
        <div class="col-sm-6">
            @if($permiso->sipa_permisos_roles_crear)
            <form method="get" action="{{url('/crearActivo')}}">
            <button type="submit" class="btn btn-primary" >
                <span class="glyphicon glyphicon-plus"></span> Crear
            </button>
            </form>
            @endif
        </div>
        <div class="col-sm-6">
            @if($permiso->sipa_permisos_roles_editar)
            <form method="GET" action="{{url('/editarActivos')}}">
            <button type="submit" class="btn btn-primary" id="editar_activo_inv" >
                <span class="glyphicon glyphicon-edit"></span> Editar
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
                    <th scope="col" class="text-center">#</th>
                    <th scope="col" class="text-center">Código</th>
                    <th scope="col" class="text-center">Nombre</th>
                    <th scope="col" class="text-center">Estado</th>
                    <th scope="col" class="text-center">Acciones</th>
                </tr>
                </thead>

                @if(count($activos) > 0)
                @foreach($activos as $activo)
                <tbody class="text-center">
                    <tr id="{{$activo->sipa_activos_id}}">
                        <th class="text-center"> {{$activo->sipa_activos_id}} </th>
                        <td> {{$activo->sipa_activos_codigo}} </td>
                        <td> {{$activo->sipa_activos_nombre}} </td>
                        <td> {{$activo->sipa_activos_estado}} </td>
                        <td> 
                            <div class="col-sm-12">
                                <div class="col-sm-6">
                                    @if($permiso->sipa_permisos_roles_ver)
                                        <a class="btn btn-primary ver-btn" href="{{url('verEquipos', $activo->sipa_activos_id)}}">
                                            <span class="far fa-eye"></span> Ver
                                        </a>
                                    @endif
                                </div>
                                <div class="col-sm-6">
                                    @if($permiso->sipa_permisos_roles_borrar)
                                    <a data-toggle="modal" data-target="#borrarModal" class="btn btn-danger borrar-btn" id="{{$activo->sipa_activos_id}}">
                                        <span class="glyphicon glyphicon-trash"></span> Borrar
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
                        No hay activos en el sistema.
                    </h2>
                </tbody>
                @endif
            </table>
        </div>
    </div>
</div>


<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" id="borrarModal">
    <div class="modal-dialog modal-dialog-centered" role="document">
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
            <form method="POST" action="{{ url('/activ') }}" class="configForm"c id="editarRespon" >
                @csrf
                <input type="hidden" id="activoId" name="activoId">
                <button type="submit" class="btn btn-primary" name= "aceptar" id="aceptar">Aceptar</button>
            </form>
            <form method="GET" action="{{ url ('/inventarioEquipos')}}" class="configForm"c id="editarRespon" >
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </fomr>
            </div>
        </div>
    </div>
</div>


<script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js">
</script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/codigo.js') }}"></script>
@include('sweet::alert')


<!--Modals-->
<!-- @extends('activos.borrar') -->

<!--Scripts-->

<script type="text/javascript">


$(".borrar-btn").click(function(){
    var actID = this.id;

    $('#activoId').attr('value', actID);

});

// function borrarActivo() {
   
//     var url = "/activ/"+ this.id;

//     fetch(url)
//     .then(r => {
//         return r.json();
//     }).then(d => {
//         var obj = JSON.stringify(d);
//         var obj2 = JSON.parse(obj);
//         document.location.reload();
//     });
// }
// function verficarActv(elemento, elemento2) {
//     var url = "verificarAct/" + elemento.value;
//     console.log(elemento.value);
//     fetch(url).then(r => {
//         return r.json();
//     }).then(d => {
//         var obj = JSON.stringify(d);
//         var obj2 = JSON.parse(obj);
//         console.log(obj2);
//         var activo = document.getElementById('nombreActivo');
//         activo.value = obj2.nombreActivo;
        

//     });
// }
    
	// function doSomthing(json){
	// 	var obj2 = JSON.parse(json);
	// 	// var obj = JSON.stringify(d);
	// 		// var obj2 = JSON.parse(obj);
	// 	console.log(obj2);

    // }

</script>

@endsection