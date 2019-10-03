<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\AuthLdap;
//require_once 'App\class.AuthLdap.php';

class LoginLdapController extends Controller
{

    public function com(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);
       
        $username = $request->input('username');
        $password = $request->input('password');
       
        if(static::LDAP($username,$password)){
            $user = User::where('sipa_usuarios_identificacion',$username)->get()[0];
            session(['idUsuario' => $username]);
            //$valor_almacenado = session('idUsuario');
            return view('logged')->with('username',$user->name);
        }
        
    }
    private static function LDAP($id,$contrasenna){
        $ldap = new AuthLdap;
	    $server[0] = "10.0.2.53";
	    $ldap->server = $server;
	    $ldap->dn = "dc=una,dc=ac,dc=cr";
	    if ( $ldap->connect()) {
            echo 'Conectado';
            if ($ldap->checkPass($id,$contrasenna)) {
                $ldap->connect();
                $nombre =$ldap->getAtributo($id,'cn');
                $correo=$ldap->getAtributo($id,'mail');

                $usuario = new User();
                $usuario->name = $nombre[0];
                $usuario->email = $correo[0];
                $usuarios = User::all();
                $usuariosCant = count($usuarios)+1;
                $usuario->id = $usuariosCant;
                $usuario->save();
            }else{
                return false;
                }
        }else{
            return false;
        }
        return true;
    }
}
