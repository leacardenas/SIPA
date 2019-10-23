<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\User;
use App\AuthLdap;
//require_once 'App\class.AuthLdap.php';

class LoginLdapController extends Controller
{

    public function com(Request $request)
    {
        $usuario = new User();
        $usuario->sipa_usuarios_nombre = $request->input('nombre');
        $usuario->sipa_usuarios_correo = $request->input('correo');
        $usuario->sipa_usuarios_identificacion = $request->input('id');
        $usuarios = User::all();
        $usuariosCant = count($usuarios)+1;
        $usuario->id = $usuariosCant;
        $usuario->sipa_usuarios_telefono = $request->input('telefono');
        
        // $usuario ->sipa_usuarios_edificio= $request->get('edificioSelect');
        // //$usuario->sipa_usuarios_piso = $request->get('pisoSelect'); //no esta en la base de datos
        // $usuario ->sipa_usuarios_unidad= $request->get('unidadSelect');
        $usuario->save();
        return view('logged');
    }
 
    public function verificar($id){

        $users = User::where('sipa_usuarios_identificacion',$id);
       
        foreach( $users->cursor() as $usuario){
            return $data = [
                'nombreUsuario'=> $usuario->sipa_usuarios_nombre,
                
            ];
        }
        return $data = [
            'nombreUsuario'=>'Este usuario no se encuentra registrado',
            
        ];
    }

}
