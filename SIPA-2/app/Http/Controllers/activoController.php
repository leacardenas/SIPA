<?php

namespace App\Http\Controllers;
use App\Activo;
use Illuminate\Http\Request;


class activoController extends Controller
{

    public function borrarActivos($id){
        $activo = Activo::find($id);
        $activo->delete();
        $data2 = [
            'response' => 'good'
        ];
        return $data2;
     
    }
}





