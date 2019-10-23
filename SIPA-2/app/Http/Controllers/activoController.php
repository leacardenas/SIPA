<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Activo;

class activoController extends Controller
{
    function index(){
        $activos = Activo::all();
        return view('activos/activos')->with('activos', $activos);
    }

    public function borrarActivos($id){
        $activo = App\Activo::find($id);
        $activo->delete();
    }
}
