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

        $activo->sipa_activo_usabilidad = $activoTipo;
        $activo->sipa_activos_usuario_creador = $user->sipa_usuarios_id; 
        $activo->sipa_activos_responsable = $actRespon;
        $activo->sipa_activos_encargado = $actEncarg;
        $edificio = $request->get('selectEdificioActivo');
        $edificioActivo = Edifico::where('sipa_edificios_nombre',$edificio)->get()[0];
        $activo->sipa_activos_edificio = $edificioActivo->id;
        $piso = $request->get('selectPlantaActivo');
        $activo->sipa_activos_piso_edificio = $request->get('selectPlantaActivo');
        $ubicacion = 'Edificio '.$edificio.', piso #'.$piso;
        $unidad = $request->get('selectUnidadEjecutoraActivo');
        $unidadActivo = Unidad::where('sipa_edificios_unidades_nombre',$unidad)->get()[0];
        $activo->sipa_activos_unidad = $unidadActivo->sipa_edificios_unidades_id;
        $activo->sipa_activos_ubicacion = $ubicacion; 
        $activo->observaciones = 'Sin observaciones';
        if($request->file('imagenAct')){
            // $file = Input::file('imagem');
            // $img = Image::make($file);
            // Response::make($img->encode('jpeg'));
            $imagenRequest = $request->file('imagenAct');
            $imagenPath = $imagenRequest->getRealPath();
            $contenido = file_get_contents($imagenPath);
            $imagen = base64_encode($contenido);
            $tipo = $imagenRequest->getClientOriginalExtension();
            $originalName = $imagenRequest->getClientOriginalName();
            $nombreImagen = pathinfo($originalName, PATHINFO_FILENAME);
            
            $activo->sipa_activos_foto = $imagen;
            $activo->tipo_imagen = $tipo;
            $activo->sipa_activo_nombre_imagen = $nombreImagen;
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
           
            $activo->sipa_activos_fomulario = $form;
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
}
