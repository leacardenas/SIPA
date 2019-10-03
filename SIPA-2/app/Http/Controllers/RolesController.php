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
            'nombrerol' => ['required', 'string', 'max:255'],
            'descripicion' => ['required', 'string'],
            'codigo' => ['required', 'string'],
        ]);

        $username = session('idUsuario');
        $codigo = $request->input('codigo');
        $nombre = $request->input('nombrerol');
        $descripcion = $request->input('descripcion');

        // $rol = new Rol;
        // $rol->sipa_roles_codigo=$codigo;
        // $rol->sipa_roles_nombre=$nombre;
        // $rol->sipa_roles_descripcion=$descripcion;
        // $rol->sipa_roles_usuario_creado=$username;
        // $rol->save();

        return view('logged')->with('username',$codigo);

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
