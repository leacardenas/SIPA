<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rol;
class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Rol::all();
        return view('roles')->with('roles', $roles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
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
            'codigo' => 'required',
            'nombreRol' => 'required',
            'descRol' => 'required'
        ]);

        $username = session('idUsuario');
        $codigo = $request->input('codigo');
        $nombre = $request->input('nombreRol');
        $descripcion = $request->input('descRol');

        $rol = new Rol;
        $rol->sipa_roles_codigo=$codigo;
        $rol->sipa_roles_nombre=$nombre;
        $rol->sipa_roles_descripcion=$descripcion;
        $rol->sipa_roles_usuario_creador=$username;
        $roles = Rol::all();
        $rolesCant = count($roles)+1;
        $rol->sipa_roles_id = $rolesCant;
        $rol->save();

        return view('menus.principal');

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
