<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Arr;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Response;
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
        
        $formulario = $request->file('boletaImagenRes');
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
        $trasladoRespon->sipa_traslado_num_comp = $request->input('numeroBoleta');

        $activo->update(['sipa_activos_responsable' =>$responsable->sipa_usuarios_id,
                            'sipa_activos_usuario_actualizacion' =>$user->sipa_usuarios_id,
                            'sipa_activo_disponible' => 0]);
       
        
        $trasladoRespon->sipa_usuario_nuevo = $activo->sipa_activos_responsable;
       
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
        $trasladoEncrg->sipa_traslado_num_comp = $request->input('numeroBoleta');
        //Comprobante
        

        $activo->update(['sipa_activos_encargado' => $encargado->sipa_usuarios_id]);
        $activo->update(['sipa_activos_usuario_actualizacion' =>$user->sipa_usuarios_id]);
        
        $trasladoEncrg->sipa_usuario_nuevo = $activo->sipa_activos_encargado;
        
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
                    'sipa_activos_estado'=>$estado,
                    'sipa_activo_activo' => 0]);
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
        $nuevaUnidad = Unidad::where('sipa_unidades_nombre',$unidadResquest)->get()[0];
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
        $numeroComprobante = $request->input('numeroComprobante');
        // $boletaTraslado = $request->file('boletaImagen');

        //Formulario
        $formulario = $request->file('boletaImagen');
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
                $trasladoEncrg->sipa_traslado_num_comp = $numeroComprobante;
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

    public function verificar($id,$view){

        $activos = Activo::where('sipa_activos_codigo',$id);
       
        foreach( $activos->cursor() as $activo){
            if($view == 1){
                return $data = [
                    'nombreActivo'=> $activo->sipa_activos_nombre,
                    'encargado' => $activo->usuarioE->sipa_usuarios_nombre,
                ];
            }else if($view == 2){
                return $data = [
                    'nombreActivo'=> $activo->sipa_activos_nombre,
                    'responsable' => $activo->usuarioR->sipa_usuarios_nombre,
                ];
            }else if($view == 3){
                return $data = [
                    'nombreActivo'=> $activo->sipa_activos_nombre,
                    'estado' => $activo->sipa_activos_estado,
                ];
            }else if($view == 4){
                return $data = [
                    'nombreActivo'=> $activo->sipa_activos_nombre,
                    'edificio' => $activo->edificio->sipa_edificios_nombre,
                    'piso' => $activo->sipa_activos_piso_edificio,
                    'unidad' => $activo->unidad->sipa_unidades_nombre,
                    
                ];
            }
        }
        return $data = [
            'nombreActivo'=>'Este activo no se encuentra registrado',
            
        ];
    }

    public function existeActivo($codigo){
        $activo = Activo::where('sipa_activos_codigo',$codigo)->count();

        if($activo > 0){
            return $dataAct = [
                'respuesta'=>'Existe',
            ];
        }else{
            return  $dataAct = [
                'respuesta'=>'No existe',
            ];
        }
    }

    public function editarTipo(Request $request){
        $codigo = $request->get('selectActivoEstado');
        $tipoActivo = $request->input('estadoActivo');
        $activoTipo = null;
        if($tipoActivo == 'asignar'){
            $activoTipo = 0;
        }else{
            $activoTipo = 1;
        }

        $activo = Activo::where('sipa_activos_id',$codigo)->get()[0];
        $activo->update(['sipa_activo_usabilidad' => $activoTipo]);     
    }

    public function verBoletaBaja($bajaId){
        $baja = ActivoBaja::find($bajaId);

        $file_contents = base64_decode($baja->form_baja);
        $nombre = $baja->nombre_form;
        $tipo = $baja->tipo_form;

        return response($file_contents)
        ->header('Cache-Control', 'no-cache private')
        ->header('Content-Description', 'File Transfer')
        ->header('Content-Type', $tipo)
        ->header('Content-length', strlen($file_contents))
        ->header('Content-Disposition', 'attachment; filename=' . $nombre . '.pdf')
        ->header('Content-Transfer-Encoding', 'binary');
   
    }

    public function boletasTrasladoFuncionario($id){
        $traslado = TrasladoActvosIndv::find($id);

        $file_contents = base64_decode($traslado->comprobante);
        $nombre = $traslado->nombreComprobante ;
        $tipo = $traslado->tipoComprobante;

        return response($file_contents)
        ->header('Cache-Control', 'no-cache private')
        ->header('Content-Description', 'File Transfer')
        ->header('Content-Type', $tipo)
        ->header('Content-length', strlen($file_contents))
        ->header('Content-Disposition', 'attachment; filename=' . $nombre . '.pdf')
        ->header('Content-Transfer-Encoding', 'binary');
    }

    public function boletaTrasladoLugar($id){
        $traslado = UbicacionActivo::find($id);

        $file_contents = base64_decode($traslado->comprobante);
        $nombre = $traslado->nombre_comprobante ;
        $tipo = $traslado->tipo_comprobante;

        return response($file_contents)
        ->header('Cache-Control', 'no-cache private')
        ->header('Content-Description', 'File Transfer')
        ->header('Content-Type', $tipo)
        ->header('Content-length', strlen($file_contents))
        ->header('Content-Disposition', 'attachment; filename=' . $nombre . '.pdf')
        ->header('Content-Transfer-Encoding', 'binary');
    }


    // public function image($id){
    //     $user = Activo::find($id);

    //     $file_contents = base64_decode($user->sipa_activos_foto);
    //     $nombre = $user->sipa_activo_nombre_imagen;
    //     $tipo = $user->tipo_imagen;

    //     return response($file_contents)
    //     ->header('Cache-Control', 'no-cache private')
    //     ->header('Content-Description', 'File Transfer')
    //     ->header('Content-Type', $tipo)
    //     ->header('Content-length', strlen($file_contents))
    //     ->header('Content-Disposition', 'attachment; filename=' . $nombre)
    //     ->header('Content-Transfer-Encoding', 'binary');

    //     // $pic = Image::make($user->sipa_activos_foto);
    //     // $response = Response::make($pic->encode('jpeg'));
    //     // $response->header('Content-Type','image/jpeg');
    //     // return $response;

    // }
}
