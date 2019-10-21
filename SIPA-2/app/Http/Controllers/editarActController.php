<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Activo;
use App\User;

class editarActController extends Controller
{
    public function editarResponsable(Request $request){

        $this->validate($request, [
            'nombreActivo' => 'required',
            'nomResponsableAct' => 'required',
            
        ]);

        $codActivo = $request->get('selectActivoResponsable');
        $cedRespon = $request->get('nombreResponsable');

        $activo = Activo::where('sipa_activos_codigo',$codActivo);
        $responsable = User::where('sipa_usuarios_identificacion', $cedRespon);

        foreach($responsable->cursor() as $resp){
            $actRespon = $resp->id;
        }

        $activo->update(['sipa_activos_responsable' =>$actRespon]);

        return view('editarActivo');
    }

    public function editarEncargado(Request $request){

        $this->validate($request, [
            'nombreActivo2' => 'required',
            'nomEncargadoAct' => 'required',
            
        ]);
        $codActivo = $request->get('selectActivoEncargado');
        $cedEncargado = $request->get('nombreEncargado');

        $activo = Activo::where('sipa_activos_codigo',$codActivo);
        $encargado = User::where('sipa_usuarios_identificacion', $cedEncargado);

        foreach($encargado->cursor() as $enc){
            $actEncarg = $enc->id;
        }

        $activo->update(['sipa_activos_encargado' =>$actEncarg]);
        return view('editarActivo');
    }

    public function editarEstado(Request $request){

        $this->validate($request, [
            'nombreActivo3' => 'required',
            'estadoActivo' => 'required',
            
        ]);
        $codActivo = $request->get('selectActivoEstado');
        $estado = $request->input('estadoActivo');

        $activo = Activo::where('sipa_activos_codigo',$codActivo);

        $activo->update(['estado' =>$estado]);
        return view('editarActivo');
    }

    public function verificar($id){

        $activos = Activo::where('sipa_activos_codigo',$id);
       
        foreach( $activos->cursor() as $activo){
            return $data = [
                'nombreActivo'=> $activo->sipa_activos_nombre,
                
            ];
        }
        return $data = [
            'nombreActivo'=>'Este activo no se encuentra registrado',
            
        ];
    }
}
