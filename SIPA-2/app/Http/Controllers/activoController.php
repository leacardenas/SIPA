<?php

namespace App\Http\Controllers;
use App\Activo;
use Illuminate\Http\Request;


class activoController extends Controller
{

    public function borrarActivos(Request $request){

        $id = $request->input('activoId');
        $activo = Activo::find($id);
        $activo->delete();
        alert('Se eliminó el activo')->persistent("Close this");
        return redirect()->route('inventarioEquipos');
     
    }
}





