<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\AuthLdap;
class LoginLdapController2 extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
            'username' => 'required',
            'password' => 'required'
        ]);
       
        $id = $request->input('username');
        $contrasenna = $request->input('password');

       // $user = User::where('sipa_usuarios_identificacion',$id)->get()[0];
       $user = null;
        foreach (User::where('sipa_usuarios_identificacion',$id)->cursor() as $user ) {
            return view('logged');
        }
        // $ldap = new AuthLdap;
	    // $server[0] = "10.0.2.53";
	    // $ldap->server = $server;
	    // $ldap->dn = "dc=una,dc=ac,dc=cr";
	    // if ( $ldap->connect()) {
        //     if ($ldap->checkPass($id,$contrasenna)) {
        //         $ldap->connect();
        //         $nombre =$ldap->getAtributo($id,'cn');
        //         $correo=$ldap->getAtributo($id,'mail');

        //         $usuario = new User();
        //         $usuario->name = $nombre[0];
        //         $usuario->email = $correo[0];
        //         $usuario->sipa_usuarios_identificacion =$id;
        //         $usuarios = User::all();
        //         $usuariosCant = count($usuarios)+1;
        //         $usuario->id = $usuariosCant;
        //         $usuario->save();
        //     }else{
        //         echo "No esta autorizado";
        //         return false;
        //         }
        // }else{
        //     echo "No se pudo conectar con LDAP";
        //     return false;
        // }
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
