<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class reservasController extends Controller
{
    public function passDataToBlade(Request $request){
        $fecha_inicial = $request.get('FI');
        return view('activos.datatable', ['fecha_inicial' => $fecha_inicial]);
        // return view('configuraciones.roles');
    }
}
