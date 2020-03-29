<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class editTipoUsuarioController extends Controller
{
    public function editarTipoUsuario(Request $request){
        $id = $request->input('userCedula');
        $usuario = User::where('sipa_usuarios_identificacion',$id)->get()[0];
        $nuevoTipo = $request->get('selectNuevoTipoUsu');
        $usuario->sipa_usuarios_rol = $nuevoTipo;
        $usuario->update();
        

        return view('configuraciones.tiposDeUsuario');
        
    }
}
