<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class reservasController extends Controller
{
    public function passDataToBlade(Request $request){
        
        $fecha_inicial = $request->get('FI');
        $fecha_final = $request->get('FF');
        $hora_inicial = $request->get('HI');
        $hora_final = $request->get('HF');

        // dd('hola');
        return view('activos.datatable', [
            'fecha_inicial' => $fecha_inicial,
            'fecha_final'=>$fecha_final,
            'hora_inicial'=>$hora_inicial,
            'hora_final' =>$hora_final
            ]
        );
        // return view('configuraciones.roles');
    }
}
