<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\sipa_usuarios;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return sipa_usuarios::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $sipa_usuarios = new sipa_usuarios();
        // $sipa_usuarios->sipa_usuarios_identificacion = '116870078';
        // $sipa_usuarios->sipa_usuarios_contrasenna = '123';
        // $sipa_usuarios->sipa_usuarios_nombre = 'Lea';
        // $sipa_usuarios->sipa_usuarios_apellidos = 'Cardenas';
        // $sipa_usuarios->sipa_usuarios_telefono = '89125443';
        // $sipa_usuarios->sipa_usuarios_correo = 'lea.cardenas14@gmail.com';
        // $sipa_usuarios->sipa_usuarios_unidad = '0';
        // $sipa_usuarios->sipa_usuarios_edificio = '0';
        // $sipa_usuarios->sipa_usuarios_rol = '0';
        // $sipa_usuarios->sipa_usuarios_usuario_creador = '0';
        
        // $sipa_usuarios->save();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
