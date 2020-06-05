<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Response;
use App\User;
use App\Activo;
use App\Edifico;
use App\Unidad;
use App\EstadoActivo;
use Redirect;

class registraActController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


    
        $activo = new Activo();
        $activo->sipa_activos_codigo = $request->input('placaActivo');
        $activo->sipa_activos_nombre = $request->input('nombreActivo');
        $activo->sipa_activos_descripcion = $request->input('descripcionActivo');
        $activo->sipa_activos_precio = $request->input('precioActivo');
        $activo->sipa_activos_modelo = $request->input('modeloActivo');
        $activo->sipa_activos_serie = $request->input('serieActivo');
        $activo->sipa_activos_marca = $request->input('marcaActivo');

        // $estado = EstadoActivo::where('sipa_estado_activo_nombre', $request->get('estadoActivo'))->get()[0];
        $activo->sipa_activos_estado = $request->get('estadoActivo');

        
        $cedResponsable = $request->get('selectResponsableActivo');
        $cedEncargado = $request->get('selectEncargadoActivo');
        $tipoActivo = $request->get('selectTipo');
        $activoTipo = null;
        if($tipoActivo == "sin definir"){
            $activoTipo = 2;
        }else if($tipoActivo == "prestamo"){
            $activoTipo = 1;
        }else{
            $activoTipo = 0;
        }

        $responsable = User::where('sipa_usuarios_identificacion',$cedResponsable)->get();
        $encargado = User::where('sipa_usuarios_identificacion',$cedEncargado)->get();
        $username = session('idUsuario');
        $user = User::where('sipa_usuarios_identificacion',$username)->get()[0];
        $actRespon = null;
        foreach($responsable as $resp){
            $actRespon = $resp->sipa_usuarios_id;
        }
        foreach($encargado as $enc){
            $actEncarg = $enc->sipa_usuarios_id;
        }
        if($cedResponsable != '0'){
            $activo->sipa_activo_disponible = 0;
        }

        $activo->sipa_activo_usabilidad = $activoTipo;
        $activo->sipa_activos_usuario_creador = $user->sipa_usuarios_id; 
        $activo->sipa_activos_responsable = $actRespon;
        $activo->sipa_activos_encargado = $actEncarg;
        $edificio = $request->get('selectEdificioActivo');
        $edificioActivo = Edifico::where('sipa_edificios_nombre',$edificio)->get()[0];
        $activo->sipa_activos_edificio = $edificioActivo->id;
        $piso = $request->get('selectPlantaActivo');
        $activo->sipa_activos_piso_edificio = $piso;
        $ubicacion = 'Edificio '.$edificio.', piso #'.$piso;
        $unidad = $request->get('selectUnidadEjecutoraActivo');
        $unidadActivo = Unidad::where('sipa_unidades_nombre',$unidad)->get()[0];
        $activo->sipa_activos_unidad = $unidadActivo->sipa_edificios_unidades_id;
        $activo->sipa_activos_ubicacion = $ubicacion; 
        $activo->observaciones = 'Sin observaciones';

        $mydate=getdate(date("U"));

        if($request->file('imagenAct')){
            $file_name = $mydate['month'] . $mydate['mday'] . $mydate['year'] . "_" . time() . "_" . basename( $_FILES['imagenAct']['name']);
            $imagenRequest = $request->file('imagenAct');
            $imagenPath = $imagenRequest->getRealPath();
            $contenido = file_get_contents($imagenPath);
            $imagen = base64_encode($contenido);
            $tipo = $imagenRequest->getClientOriginalExtension();
            $originalName = $imagenRequest->getClientOriginalName();
            $nombreImagen = pathinfo($originalName, PATHINFO_FILENAME);
            
            $this->subirImagen($file_name);
            $activo->tipo_imagen = $tipo;
            $activo->sipa_activo_nombre_imagen = $file_name;
        }

        //Comprobante
        
        if($request->file('inputpdfAct')){
            $formulario = $request->file('inputpdfAct');
            $formPath = $formulario->getRealPath();
            $contForm = file_get_contents($formPath);
            $form = base64_encode($contForm);
            $originalName = $formulario->getClientOriginalName();
            $nombre = pathinfo($originalName, PATHINFO_FILENAME);
            $tipoform = $formulario->getClientOriginalExtension();
           
            $activo->sipa_activos_fomulario = $contForm;
            $activo->sipa_activos_nom_form = $nombre;
            $activo->sipa_activos_tipo_form = $tipoform;
        }
       
        $activo->save();

        return Redirect::route('inventarioEquipos');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function subirImagen($file_name){
        if(isset($_FILES['imagenAct'])){
            $errors= array();
            $file_size =$_FILES['imagenAct']['size'];
            $file_tmp =$_FILES['imagenAct']['tmp_name'];
            $file_type=$_FILES['imagenAct']['type'];
            $tmp = explode('.', $_FILES['imagenAct']['name']);
            $file_ext=strtolower(end($tmp));
            
            $extensions= array("jpeg","jpg","png");
            
            if(in_array($file_ext,$extensions)=== false){
               $errors[]="Error en el tipo de archivo, por favor utilice JPEG, PNG o JPG.";
            }
            
            if($file_size > 2097152){
               $errors[]='El tamaño de imagen exedido, tamaño máximo: 2 MB';
            }
            
            if(empty($errors)==true){
               move_uploaded_file($file_tmp, $_SERVER['DOCUMENT_ROOT'] . "/archivosDelSistema/activos/imagenes/".$file_name);
            }else{
               print_r($errors);
            }
         }
    }

}
