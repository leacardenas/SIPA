<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Activo;
use App\Edifico;
use App\Unidad;
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


         $this->validate($request, [
            'placaActivo' => 'required|alpha_dash',
            'nombreActivo' => 'required',
            'descripcionActivo' => 'required',
            'marcaActivo' => 'required|alpha_dash',
            'modeloActivo' => 'required|alpha_dash',
            'precioActivo' => 'required',
            'serieActivo' => 'required|alpha_dash',
            'unidadActivo' => 'required',
            'nomResponsableAct' => 'required',
            'nomEncargadoAct' => 'required',
        //     'edificioAct' => 'required',
        //     'ubicacionAct' => 'required',
            'estadoActivo' => 'required',
            'imagenAct' => 'required|mimes:jpeg,png,jpg,gif,svg',
         ]);
        
        

         

        $activo = new Activo();
        $activo->sipa_activos_codigo = $request->input('placaActivo');
        $activo->sipa_activos_nombre = $request->input('nombreActivo');
        $activo->sipa_activos_descripcion = $request->input('descripcionActivo');
        $activo->sipa_activos_precio = $request->input('precioActivo');
        $activo->sipa_activos_modelo = $request->input('modeloActivo');
        $activo->sipa_activos_serie = $request->input('serieActivo');
        $activo->sipa_activos_marca = $request->input('marcaActivo');
        $activo->sipa_activos_estado = $request->input('estadoActivo');

        $cedResponsable = $request->get('selectResponsableActivo');
        $cedEncargado = $request->get('selectEncargadoActivo');

        $responsable = User::where('sipa_usuarios_identificacion',$cedResponsable);
        $encargado = User::where('sipa_usuarios_identificacion',$cedEncargado);
        $username = session('idUsuario');
        $user = User::where('sipa_usuarios_identificacion',$username)->get()[0];
        foreach($responsable->cursor() as $resp){
            $actRespon = $resp->id;
        }
        foreach($encargado->cursor() as $enc){
            $actEncarg = $enc->id;
        }
        $activo->sipa_activos_usuario_creador = $user->id; 
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

    //     if( $itemreq->hasFile('frontimage'))
    // { 
    //     $img = $itemreq->file('frontimage'); 
    //     $extension = $img->getClientMimeType(); 
    //     dd($extension); 
    // }


    //Form::open('imagenAct', array('files'=> true));
        
        $imagenRequest = $request->file('imagenAct');
        $imagen = $imagenRequest->getRealPath();
        $contenido = file_get_contents($imagen);
        $imagen2 = base64_encode($contenido);
        
        $tipo = $imagenRequest->getClientOriginalExtension();
        
        
        $activo->sipa_activos_foto = $imagen2;
        $activo->tipo_imagen = $tipo;
    
        $activos = Activo::all();
        $activCant = count($activos)+1;
        $activo->sipa_activos_id = $activCant;
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
