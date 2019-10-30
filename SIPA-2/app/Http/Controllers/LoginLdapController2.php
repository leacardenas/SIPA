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
        $usuario = new User();
        
        $ldap = new AuthLdap;
	    $server[0] = "10.0.2.53";
	    $ldap->server = $server;
	    $ldap->dn = "dc=una,dc=ac,dc=cr";
	    if ( $ldap->connect()) {
            if ($ldap->checkPass($id,$contrasenna)) {
                $ldap->connect();
                $nombre =$ldap->getAtributo($id,'cn');
                $correo=$ldap->getAtributo($id,'mail');

                 
                $usuario->name = $nombre[0]; 
                $usuario->email = $correo[0]; 
                $usuario->sipa_usuarios_identificacion =$id;
                $usuarios = User::all();
                $usuariosCant = count($usuarios)+1;
                $usuario->id = $usuariosCant;

                
            }else{
                return view('error')->with('mensaje_error','Usuario o contraseña mal digitados, intentalo de nuevo');
                
                }
        }else{
            return view('error')->with('mensaje_error','Hubo un error en el servidor, intentalo mas tarde.');
        }
        $user = null;
        session(['idUsuario' => $id]);
        foreach (User::where('sipa_usuarios_identificacion',$id)->cursor() as $user ) {
            if($user->sipa_usuarios_rol === null){
                return view('error')->with('mensaje_error','Aún no tienes permiso de acceder al sistema.');
            }

            return view('menus.modulos');
        }
        // $usuario->name = 'Bryan Garro Eduarte'; //se borra
        // $usuario->email = 'eduarte@hotmail.com'; //se borra
        // $usuario->sipa_usuarios_identificacion =$id;//se borra
        // $usuarios = User::all();//se borra
        // $usuariosCant = count($usuarios)+1;//se borra
        // $usuario->id = $usuariosCant;//se borra
        return view('registrar')->with('user',$usuario);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
        
        $value = $request->input('inputUsuarioRegistro');
       
        
        $usuario = new User();
        $usuario->sipa_usuarios_nombre = $request->input('inputFuncionarioRegistro');
        $usuario->sipa_usuarios_correo = $request->input('inputCorreoRegistro');
        $usuario->sipa_usuarios_identificacion = $request->input('inputUsuarioRegistro');
        $usuarios = User::all();
        $usuariosCant = count($usuarios)+1;
        $usuario->id = $usuariosCant;
        $usuario->sipa_usuarios_telefono = $request->input('inputTelefonoRegistro');
        
        $usuario ->sipa_usuarios_edificio= $request->get('edificioSelect');
        //$usuario->sipa_usuarios_piso = $request->get('pisoSelect'); //no esta en la base de datos
        $usuario ->sipa_usuarios_unidad= $request->get('unidadSelect');
        
        $usuario->save();
        return view('tester')->with('test',$value);
        
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
