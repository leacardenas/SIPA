<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Arr;
use DOMDocument;

use App\Activo;
use App\User;
use App\ActivoBaja;
use App\TrasladoActvosIndv;
use App\UbicacionActivo;
use App\Edifico;
use App\Unidad;

class editarActController extends Controller
{

    public function editarResponsable(Request $request){

        $this->validate($request, [
            'nombreActivo' => 'required',
            'nomResponsableAct' => 'required',
            
        ]);

        $codActivo = $request->get('selectActivoResponsable');
        $cedRespon = $request->get('nombreResponsable');
        //dd($codActivo);
        //Comprobante
        $formulario = $request->file('boletaImagenRes');
        //dd($formulario);
        $motivoForm = $formulario->getRealPath();
        $contenido = file_get_contents($motivoForm);
        $form = base64_encode($contenido);
        $tipo = $formulario->getClientOriginalExtension();
        $originalName = $formulario->getClientOriginalName();
        $nombre = pathinfo($originalName, PATHINFO_FILENAME);

        $activo = Activo::where('sipa_activos_codigo',$codActivo)->get()[0];
        $responsable = User::where('sipa_usuarios_identificacion', $cedRespon)->get()[0];

        $username = session('idUsuario');
        $user = User::where('sipa_usuarios_identificacion',$username)->get()[0];

        $trasladoRespon = new TrasladoActvosIndv();
        $trasladoRespon->sipa_activo = $activo->sipa_activos_id;
        $trasladoRespon->sipa_usuario_viejo = $activo->sipa_activos_responsable;
        $trasladoRespon->sipa_encargado_o_responsable = 0;
        $trasladoRespon->comprobante = $form;
        $trasladoRespon->tipoComprobante = $tipo;
        $trasladoRespon->nombreComprobante = $nombre;

        $activo->update(['sipa_activos_responsable' =>$responsable->sipa_usuarios_id]);
        $activo->update(['sipa_activos_usuario_actualizacion' =>$user->sipa_usuarios_id]);
        
        $trasladoRespon->sipa_usuario_nuevo = $activo->sipa_activos_responsable;
        $traslados = TrasladoActvosIndv::all();
        $trasCount = count($traslados)+1;
        $trasladoRespon->sipa_traslado_id = $trasCount;
        $trasladoRespon->save();

        return view('activos/editarResponsable');
    }

    public function editarEncargado(Request $request){

        $this->validate($request, [
            'nombreActivo2' => 'required',
            'nomEncargadoAct' => 'required',
            
        ]);
        $codActivo = $request->get('selectActivoEncargado');
        $cedEncargado = $request->get('nombreEncargado');

        //Comprobante
        $formulario = $request->file('boletaImagenEnc');
        $motivoForm = $formulario->getRealPath();
        $contenido = file_get_contents($motivoForm);
        $form = base64_encode($contenido);
        $tipo = $formulario->getClientOriginalExtension();
        $originalName = $formulario->getClientOriginalName();
        $nombre = pathinfo($originalName, PATHINFO_FILENAME);

        $activo = Activo::where('sipa_activos_codigo',$codActivo)->get()[0];
        $encargado = User::where('sipa_usuarios_identificacion', $cedEncargado)->get()[0];
        $username = session('idUsuario');
        $user = User::where('sipa_usuarios_identificacion',$username)->get()[0];
        
        $trasladoEncrg = new TrasladoActvosIndv();
        $trasladoEncrg->sipa_activo = $activo->sipa_activos_id;
        $trasladoEncrg->sipa_usuario_viejo = $activo->sipa_activos_encargado;
        $trasladoEncrg->sipa_encargado_o_responsable = 1;
        $trasladoEncrg->comprobante = $form;
        $trasladoEncrg->tipoComprobante = $tipo;
        $trasladoEncrg->nombreComprobante = $nombre;

        //Comprobante
        

        $activo->update(['sipa_activos_encargado' => $encargado->sipa_usuarios_id]);
        $activo->update(['sipa_activos_usuario_actualizacion' =>$user->sipa_usuarios_id]);
        
        $trasladoEncrg->sipa_usuario_nuevo = $activo->sipa_activos_encargado;
        
        $traslados = TrasladoActvosIndv::all();
        $trasCount = count($traslados)+1;
        $trasladoEncrg->sipa_traslado_id = $trasCount;
        $trasladoEncrg->save();
        return view('activos/editarEncargado');
    }

    public function editarEstado(Request $request){

        $this->validate($request, [
            'nombreActivo3' => 'required',
            'estadoActivo' => 'required',
            'observCambioEst' => 'required',
        ]);
        $codActivo = $request->get('selectActivoEstado');
        $estado = $request->input('estadoActivo');
        $observaciones = $request->input('observCambioEst');
        $username = session('idUsuario');
        $user = User::where('sipa_usuarios_identificacion',$username)->get()[0];
        $activo = Activo::where('sipa_activos_codigo',$codActivo);

        $activo->update(['sipa_activos_estado' =>$estado,
                        'observaciones' => $observaciones,]);
        $activo->update(['sipa_activos_usuario_actualizacion' =>$user->sipa_usuarios_id]);
        return view('activos/editarEstado');
    }

    public function darDeBaja(Request $request){
        //dd('hola');
        $this->validate($request, [
            'nombreActivo4' => 'required',
            'razonBajaActivo' => 'required',
            'boletaImagen' => 'required|mimes:pdf',
        ]);
        $codActivo = $request->get('selectActivoBaja');
        $estado = $request->get('estadoActivoBaja');
        $motivoBaja = $request->input('razonBajaActivo');
        //Formulario
        $formulario = $request->file('boletaImagen');
        $motivoForm = $formulario->getRealPath();
        $contenido = file_get_contents($motivoForm);
        $form = base64_encode($contenido);
        $tipo = $formulario->getClientOriginalExtension();
        $originalName = $formulario->getClientOriginalName();
        $nombre = pathinfo($originalName, PATHINFO_FILENAME);
        //dd($form);
        $activo = Activo::where('sipa_activos_codigo',$codActivo)->get()[0];
        $baja = new ActivoBaja();
        $motivoBaja = $request->input('razonBajaActivo');
        $activo->update(['sipa_activos_disponible' => 0,
                    'sipa_activos_motivo_baja'=>$motivoBaja,
                    'sipa_activos_estado'=>$estado]);
        $baja->sipa_activo_baja = $activo->sipa_activos_id;
        $baja->motivo_baja = $motivoBaja;
        $baja->form_baja = $form;
        $baja->tipo_form = $tipo;
        $baja->nombre_form = $nombre;

        $bajas = ActivoBaja::all();
        $bajasCant = count($bajas)+1;
        $baja->id = $bajasCant;

        $baja->save();
        return view('activos/darBaja');
    }

    public function editarUbicacion(Request $request){
        $codigoActivo = $request->get('selectActivoUbicacion');

        //Comprobante boletaImagenCE
        $formulario = $request->file('boletaImagenCE');
        $motivoForm = $formulario->getRealPath();
        $contenido = file_get_contents($motivoForm);
        $form = base64_encode($contenido);
        $tipo = $formulario->getClientOriginalExtension();
        $originalName = $formulario->getClientOriginalName();
        $nombre = pathinfo($originalName, PATHINFO_FILENAME);

        $activo = Activo::where('sipa_activos_codigo',$codigoActivo)->get()[0];
        $viejoEdificio = $activo->sipa_activos_edificio;
        $viejaUnidad = $activo->sipa_activos_unidad;
        $edificioRequest = $request->get('edificio');
        $nuevoEdificio = Edifico::where('sipa_edificios_nombre',$edificioRequest)->get()[0];
        $unidadResquest = $request->get('unidadEjecutora');
        $nuevaUnidad = Unidad::where('sipa_edificios_unidades_nombre',$unidadResquest)->get()[0];
        $piso = $request->get('planta');
        $nuevaUbicacion = 'Edificio '.$edificioRequest.', piso #'.$piso;
        $username = session('idUsuario');
        $user = User::where('sipa_usuarios_identificacion',$username)->get()[0];
        
        $activo->update([
            'sipa_activos_edificio' => $nuevoEdificio->id,
            'sipa_activos_piso_edificio' => $piso,
            'sipa_activos_unidad' => $nuevaUnidad->sipa_edificios_unidades_id,
            'sipa_activos_ubicacion' => $nuevaUbicacion,
            'sipa_activos_usuario_actualizacion' => $user->sipa_usuarios_id,
        ]);

        $trasladoUbicacion = new UbicacionActivo();

        $trasladoUbicacion->sipa_ubicacion_activo = $activo->sipa_activos_id;
        $trasladoUbicacion->sipa_ubicacion_nuevo_edificio = $nuevoEdificio->id;
        $trasladoUbicacion->sipa_ubicacion_viejo_edificio = $viejoEdificio;
        $trasladoUbicacion->sipa_nueva_unidad = $nuevaUnidad->sipa_edificios_unidades_id;
        $trasladoUbicacion->sipa_vieja_unidad = $viejaUnidad;
        $trasladoUbicacion->comprobante = $form;
        $trasladoUbicacion->tipo_comprobante  = $tipo;
        $trasladoUbicacion->nombre_comprobante  = $nombre;
        
        $traslados = UbicacionActivo::all();
        $Cant = count($traslados)+1;
        $trasladoUbicacion->sipa_ubicacion_id = $Cant;

        $trasladoUbicacion->save();
        return view('activos/editarUbicacion');
        

        
    }

    public function trasladoMasivo($listJson,$encargadoId){

        $lastActivo;
        
        if($listJson && $encargadoId){
            $lista = json_decode($listJson,true);
            $nuevoEncargado = User::where('sipa_usuarios_identificacion',$encargadoId)->get()[0];
            session(['activos'=> $lista]);
            session(['nuevoEncargado'=>$nuevoEncargado]);
            if($nuevoEncargado){
                return ['respuesta' => $nuevoEncargado->sipa_usuarios_id];
            }
            
        }

        return ['respuesta' => 'No se seleccionó activos'];
       
    }

    public function realizarTraslado(Request $request){
        $this->validate($request, [
           'boletaImagen' => 'required|mimes:pdf',
        ]);
        $listaAcivos = session('activos');
        $encargadoId = session('nuevoEncargado');
        // $boletaTraslado = $request->file('boletaImagen');

        //Formulario
        // $formulario = $request->file('boletaImagen');
        $boletaTraslado = $request->file('boletaImagen');
        $motivoForm = $boletaTraslado->getRealPath();
        $contenido = file_get_contents($motivoForm);
        $form = base64_encode($contenido);
        $tipo = $boletaTraslado->getClientOriginalExtension();
        $originalName = $boletaTraslado->getClientOriginalName();
        $nombre = pathinfo($originalName, PATHINFO_FILENAME);
        //dd($nombre);

        foreach($listaAcivos as $actId => $id) {
            $activo = Activo::where('sipa_activos_codigo',$id)->get()[0];
            if($activo){
                $antiguoEnc = $activo->sipa_activos_encargado;
                $activo->update(['sipa_activos_encargado' => $encargadoId->sipa_usuarios_id,]);
                $trasladoEncrg = new TrasladoActvosIndv();
                $trasladoEncrg->sipa_activo = $activo->sipa_activos_id;
                $trasladoEncrg->sipa_usuario_viejo = $antiguoEnc;
                $trasladoEncrg->sipa_encargado_o_responsable = 1;
                $trasladoEncrg->sipa_usuario_nuevo = $encargadoId->sipa_usuarios_id;
                $trasladoEncrg->comprobante = $form;
                $trasladoEncrg->tipoComprobante = $tipo;
                $trasladoEncrg->nombreComprobante = $nombre;
                $traslados = TrasladoActvosIndv::all();
                $trasCount = count($traslados)+1;
                $trasladoEncrg->sipa_traslado_id = $trasCount;
                $trasladoEncrg->save();
            }
        }

        return view('activos/trasladoMasivo');
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
