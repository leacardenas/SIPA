<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rol;
use App\User;
class registroController extends Controller
{
    public function actualizarRol($id,$nombre,$rolNombre){
        $usuario = User::where('sipa_usuarios_identificacion',$id)->get()[0];
        $rol = Rol::where('sipa_roles_nombre',$rolNombre)->get()[0]->sipa_roles_id;
        $usuario->sipa_usuarios_rol = $rol;
        $usuario->save();
        $data2 = [
            'response' => 'good'
        ];
        return $data2;
    }
}
