<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class UsuarioController extends Controller
{
    public function eliminarUsuario(Request $request){
        $id = $request->input('usuarioId');
        $usuario = User::find($id);
        $usuario->delete();
        
        return view('configuraciones/usuarios');
    }
}
