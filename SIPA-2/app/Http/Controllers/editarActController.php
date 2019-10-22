<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Activo;
use App\User;
use App\ActivoBaja;

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

        $username = session('idUsuario');
        $user = User::where('sipa_usuarios_identificacion',$username)->get()[0];
        foreach($responsable->cursor() as $resp){
            $actRespon = $resp->id;
        }

        $activo->update(['sipa_activos_responsable' =>$actRespon]);
        $activo->update(['sipa_activos_usuario_actualizacion' =>$user->id]);
        return view('activos/editar');
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
        $username = session('idUsuario');
        $user = User::where('sipa_usuarios_identificacion',$username)->get()[0];
        foreach($encargado->cursor() as $enc){
            $actEncarg = $enc->id;
        }

        $activo->update(['sipa_activos_encargado' =>$actEncarg]);
        $activo->update(['sipa_activos_usuario_actualizacion' =>$user->id]);
        return view('activos/editar');
    }

    public function editarEstado(Request $request){

        $this->validate($request, [
            'nombreActivo3' => 'required',
            'estadoActivo' => 'required',
            
        ]);
        $codActivo = $request->get('selectActivoEstado');
        $estado = $request->input('estadoActivo');

        $username = session('idUsuario');
        $user = User::where('sipa_usuarios_identificacion',$username)->get()[0];
        $activo = Activo::where('sipa_activos_codigo',$codActivo);

        $activo->update(['estado' =>$estado]);
        $activo->update(['sipa_activos_usuario_actualizacion' =>$user->id]);
        return view('activos/editar');
    }

    public function darDeBaja(Request $request){
        //dd('hola');
        $this->validate($request, [
            'nombreActivo4' => 'required',
            'razonBajaActivo' => 'required',
            'boletaImagen' => 'required|mimes:pdf',
        ]);
        $codActivo = $request->get('selectActivoBaja');
        $motivoBaja = $request->input('razonBajaActivo');
        //Formulario
        $formulario = $request->file('boletaImagen');
        $motivoForm = $formulario->getRealPath();
        $contenido = file_get_contents($motivoForm);
        $form = base64_encode($contenido);
        $tipo = $formulario->getClientOriginalExtension();

        //dd($form);
        $activo = Activo::where('sipa_activos_codigo',$codActivo)->get()[0];
        $baja = new ActivoBaja();

        $activo->update(['sipa_activos_disponible' => 0,]);
        $baja->sipa_activo_baja = $activo->sipa_activos_id;
        $baja->motivo_baja = $request->input('razonBajaActivo');
        $baja->form_baja = $form;
        $baja->tipo_form = $tipo;

        $bajas = ActivoBaja::all();
        $bajasCant = count($bajas)+1;
        $baja->id = $bajasCant;

        $baja->save();
        return view('activos/editar');
    }

    public function trasladoMasivo(Request $request){
        
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
