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
        $horasSemanales = $request->input('semanasInput');
        $horasMensuales = $request->input('mesesInput');
        $cantidad = null; 
        $semanas_meses = null;
        if($horasSemanales != null){
            $cantidad = $horasSemanales; 
            $semanas_meses = 's';
        }elseif($horasMensuales != null){
            $cantidad = $horasMensuales; 
            $semanas_meses = 'm';
        }else{
            $cantidad = 0; 
            $semanas_meses = 'n';
        }

        // dd($horasMensuales);
        // dd('hola');
        return view('activos.datatable', [
            'fecha_inicial' => $fecha_inicial,
            'fecha_final'=>$fecha_final,
            'hora_inicial'=>$hora_inicial,
            'hora_final' =>$hora_final,
            'cantidad' =>$cantidad,
            'semanas_meses' =>$semanas_meses
            ]
        );
        // return view('configuraciones.roles');
    }



    public function reservar($fi,$ff,$hi,$hf,$cant,$semanas_meses,$cedula,$archJson){
        
        $lista = json_decode($listJson,true);
         return ['respuesta' => $lista];
    }
}
