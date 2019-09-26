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
        $user = new User;
        $user->sipa_usuarios_identificacion = $request->input('identificacion_usuario');
        $user->sipa_usuarios_nombre = $request->input('nombre_usuario');
        $user->sipa_usuarios_apellidos = $request->input('apellido_usuario');
        $user->sipa_usuarios_telefono = $request->input('telefono_usuario');
        $user->sipa_usuarios_correo = $request->input('correo_usuario');
        $user->sipa_usuarios_unidad = $request->input('unidad_usuario');
        $user->sipa_usuarios_edificio = $request->input('edificio_usuario');
        $user->sipa_usuarios_usuario_creador = auth()->user()->id;

        $user->save();
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
