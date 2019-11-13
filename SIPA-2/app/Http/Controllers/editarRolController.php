<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rol;
class editarRolController extends Controller
{
    public function editarNombreRol(Request $request){
        $codigo = $request->get('selectEditarRol');
        $rol = Rol::where('sipa_roles_codigo',$codigo)->get()[0];
        $nuevoNombre = $request->input('nuevoNombreRol');
        $rol->update(['sipa_roles_nombre'=>$nuevoNombre]);
        return view('configuraciones.roles');
    }

    public function eliminarRol(Request $request){
        $codigo = $request->get('selectEliminarRol');
        $rol = Rol::where('sipa_roles_codigo',$codigo)->get()[0];
        $rol->delete();
        return view('configuraciones.roles');
    }
}
