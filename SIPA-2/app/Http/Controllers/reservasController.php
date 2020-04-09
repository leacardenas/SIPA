<?php

namespace App\Http\Controllers;
use Illuminate\Support\Collection;
use Illuminate\Support\Arr;
use DOMDocument;
use Illuminate\Http\Request;
use App\Reserva;
use App\User;
use App\ReservaActivoMatch;
use Carbon\Carbon;
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
 
        $fiCarbon = Carbon::parse($fi)->format('Y-m-d');
        $ffCarbon = Carbon::parse($ff)->format('Y-m-d');
        $hiCarbon = Carbon::parse($hi)->format('H:i:s');
        $hfCarbon = Carbon::parse($hf)->format('H:i:s');
        $user = User::where('sipa_usuarios_identificacion',$cedula)->get()[0];
        $lista = json_decode($archJson,true);
        $cantidadRepeticionesSemanales = null;

  
        if($semanas_meses === 'm'){
            $cantidadRepeticionesSemanales = $cant*4;
        }elseif($semanas_meses === 's'){
            $cantidadRepeticionesSemanales=$cant*1;
        }else{
            $cantidadRepeticionesSemanales=0;
        }

        $fiTEMP = $fi;
        $ffTEMP = $ff;
        for ($i = 0; $i <= $cantidadRepeticionesSemanales; $i++) {
            $reserva = new Reserva();
            $reserva->sipa_reservas_activos_fecha_inicio =  $fiCarbon;
            $reserva->sipa_reservas_activos_fecha_fin =  $ffCarbon;
            $reserva->sipa_reservas_activos_hora_inicio = $hiCarbon;
            $reserva->sipa_reservas_activos_hora_fin = $hfCarbon;
            $reserva->sipa_reservas_activos_funcionario = $user->sipa_usuarios_id;
            $reserva->sipa_reservas_activos_pdf = null;
            $reserva->save(); 
            $reserva->sipa_reservas_activos_id; // completa el ID
            //realizar aumento de fechas
           
            $fiCarbon = Carbon::parse($fiTEMP);
            $fiCarbon->addWeek();
            $fiTEMP = $fiCarbon->toDateString();
            $fiCarbon = Carbon::parse($fiCarbon->toDateString())->format('Y-m-d');

            $ffCarbon = Carbon::parse($ffTEMP);
            $ffCarbon->addWeek();
            $ffTEMP = $ffCarbon->toDateString();
            $ffCarbon = Carbon::parse($ffCarbon->toDateString())->format('Y-m-d');

            //realizar insert en match de tablas
            foreach($lista as $id){
                $match = new ReservaActivoMatch();
                $match ->sipa_reserva_activo_reservaId = $reserva->sipa_reservas_activos_id;
                $match ->sipa_reserva_activo_activoId = $id;
                $match ->save();
            }

        }
         
        
               return ['respuesta' => 'todo bien'];
    }
}


