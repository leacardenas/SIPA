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
            'marcaActivo' => 'required|regex:/^[a-zA-Z]+$/u',
            'modeloActivo' => 'required',
            'serieActivo' => 'required',
            'precioActivo'=> 'required',
            'unidadActivo' => 'required',
            'nomResponsableAct' => 'required',
            'cedResponsableAct' => 'required',
            'nomEncargadoAct' => 'required',
            'cedEncargadoAct' => 'required',
            'unidadEjecutoraAct' => 'required',
            'edificioAct' => 'required',
            'plantaAct' => 'required',
            'ubicacionAct' => 'required',
            'imagenAct' => 'required'
            
        ]);

        $activo = new Activo();
        $activo->sipa_activos_codigo = $request->input('placaActivo');
        $activo->sipa_activos_nombre = $request->input('nombreActivo');
        $activo->sipa_activos_descripcion = $request->input('descripcionActivo');
        $activo->sipa_activos_precio = $request->input('precioActivo');
        $activo->sipa_activos_modelo = $request->input('modeloActivo');
        $activo->sipa_activos_serie = $request->input('serieActivo');
        
        $cedResponsable = $request->input('cedResponsableAct');
        $cedEncargado = $request->input('ccedEncargadoActed');

        $responsable = User::where('sipa_usuarios_identificacion',$cedResponsable);
        $encargado = User::where('sipa_usuarios_identificacion',$cedEncargado);
        $activo->sipa_activos_reponsable = $responsable[0];
        $activo->sipa_activos_encargado = $encargado[0];

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
