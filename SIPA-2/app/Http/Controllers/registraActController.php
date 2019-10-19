<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
            'placaActivo' => 'required',
            'nombreActivo' => 'required',
            'descripcionActivo'=> 'required',
            'marcaActivo' => 'required',
            'modeloActivo' => 'required',
            'serieActivo' => 'required',
            'precioActivo'=> 'required',
            'unidadActivo' => 'required',
            'nomResponsableAct' => 'required',
            'cedResponsableAct' => 'required',
            'nomEncargadoAct' => 'required',
            'cedEncargadoAct' => 'required',
            'edificioAct' => 'required',
            'ubicacionAct' => 'required',
            'imagenAct' => 'required|mimes:png,jpg'
            
        ]);

        $activo = new Activo();
        $activo->sipa_activos_codigo = $request->input('placaActivo');
        $activo->sipa_activos_nombre = $request->input('nombreActivo');
        $activo->sipa_activos_descripcion = $request->input('descripcionActivo');
        $activo->sipa_activos_precio = $request->input('precioActivo');
        $activo->sipa_activos_modelo = $request->input('modeloActivo');
        $activo->sipa_activos_serie = $request->input('serieActivo');
        $activo->sipa_activos_marca = $request->input('marcaActivo');
        
        $cedResponsable = $request->input('cedResponsableAct');
        $cedEncargado = $request->input('cedEncargadoActed');

        $responsable = User::where('sipa_usuarios_identificacion',$cedResponsable);
        $encargado = User::where('sipa_usuarios_identificacion',$cedEncargado);
        foreach($responsable->cursor() as $resp){
            $actRespon = $resp->id;
        }
        foreach($encargado->cursor() as $enc){
            $actEncarg = $enc->id;
        }
        $activo->sipa_activos_reponsable = $actRespon;
        $activo->sipa_activos_encargado = $actEncarg;
        $activo->sipa_activos_estado = 1;
        $activo->sipa_activos_edificio = $request->input('edificioAct');
        $activo->sipa_activos_ubicacion = $request->input('ubicacionAct'); 

        $activos = Activo::all();
        $activCant = count($activos)+1;
        $activo->sipa_activos_id = $activCant;
        $activo->save();
        
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
