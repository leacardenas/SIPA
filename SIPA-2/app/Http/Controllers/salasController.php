<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\User;
use App\Salas;
use App\BajaSalas;
use App\Activo;
use App\asignarActivoSala;

class salasController extends Controller
{
    //
    public function registrarSala(Request $request)
    {
         $this->validate($request, [
            'num_sala_input' => 'required',
            'ubicacion_input' => 'required',
            'info_input' => 'required',
            'cantidad_input' => 'required'
         ]);
        
         $sala = new Salas();
        // dd($sala);
         $sala->sipa_salas_codigo = $request->input('num_sala_input');
         $sala->sipa_sala_ubicacion = $request->input('ubicacion_input');
         $sala->sipa_sala_informacion = $request->input('info_input');
         $sala->sipa_sala_capacidad = $request->input('cantidad_input');

         if($request->file('foto_sala')){
            $imagenRequest = $request->file('foto_sala');
            $imagen = $imagenRequest->getRealPath();
            $contenido = file_get_contents($imagen);
            $imagen2 = base64_encode($contenido);
            $originalName = $imagenRequest->getClientOriginalName();
            $nombre = pathinfo($originalName, PATHINFO_FILENAME);
            $tipo = $imagenRequest->getClientOriginalExtension();
            //$sala->sipa_salas_imagen = $imagen2;
            $sala->sipa_salas_nombre_img = $nombre;
            $sala->sipa_salas_tipo_img = $tipo;
         }

         $creador = session('idUsuario');
         $usuCreador = User::where('sipa_usuarios_identificacion',$creador)->get();
         foreach($usuCreador as $id){
            $sala->sipa_salas_usuario_creador = $id->sipa_usuarios_id;
        }

        $sala->save();
        return view('salas/registrar');
    }

    public function editarUbicacionOImagenSala(Request $request){
        
        $codigoSala = $request->get('selectSala');
        $sala = Salas::where('sipa_salas_codigo',$codigoSala)->get()[0];
        if($request->input('ubicacion_input')){
            $sala->update(['sipa_sala_ubicacion' => $request->input('ubicacion_input')]);
        }
        if($request->input('info_input')){
            $sala->update(['sipa_sala_informacion' => $request->input('info_input')]);
        }
        if($request->file('foto_sala')){
            $imagenRequest = $request->file('foto_sala');
            $imagen = $imagenRequest->getRealPath();
            $contenido = file_get_contents($imagen);
            $imagen2 = base64_encode($contenido);
            $originalName = $imagenRequest->getClientOriginalName();
            $nombre = pathinfo($originalName, PATHINFO_FILENAME);
            $tipo = $imagenRequest->getClientOriginalExtension();

            $sala->update(['sipa_salas_imagen' => $imagen2,
                            'sipa_salas_nombre_img' => $nombre,
                            'sipa_salas_tipo_img' => $tipo,]);
        }
        
        return view('salas/informacion');
    }

    public function irEditarSala($id){
        $sala = Salas::where('sipa_salas_codigo',$id)->get()[0];
        return view('salas.editar')->with('sala',$sala);
    }

    public function irDarDeBja($id){
        $sala = Salas::where('sipa_salas_codigo',$id)->get()[0];
        return view('salas.darDeBajaSala')->with('sala',$sala);
    }

    public function darBajaSala(Request $request){
        $this->validate($request, [
            'razon_baja_sala' => 'required',
            'formulario_sala' => 'required',
         ]);

         $codigoSala = $request->input('num_sala_input');
         $sala = Salas::where('sipa_salas_codigo',$codigoSala)->get()[0];

        $bajaSala = new BajaSalas();

        $bajaSala->baja_sala_id = $sala->sipa_salas_id;
        $bajaSala->motivo_baja_sala = $request->input('razon_baja_sala');

        //Formulario
        $formulario = $request->file('formulario_sala');
        //dd($formulario);
        $form = $formulario->getRealPath();
        $contenido = file_get_contents($form);
        $formB = base64_encode($contenido);
        $originalName = $formulario->getClientOriginalName();
        $nombre = pathinfo($originalName, PATHINFO_FILENAME);
        $tipo = $formulario->getClientOriginalExtension();

        $bajaSala->form_baja_sala = $formB;
        $bajaSala->form_nombre_baja_sala = $nombre;
        $bajaSala->form_tipo_baja_sala = $tipo;
        
        $creador = session('idUsuario');
        $usuCreador = User::where('sipa_usuarios_identificacion',$creador)->get();
        foreach($usuCreador as $id){
            $bajaSala->sipa_usuario_baja_sala = $id->sipa_usuarios_id;
        }

        $bajaSala->save();

        return view('salas/informacion');
        
    }


    public function asignarActivoSala($listaActivos,$idSala){

        if($listaActivos && $idSala){
            $idFuncionario = session('idUsuario');
            $salaId = Salas::where('sipa_salas_codigo',$idSala)->get()[0];
            $funcionario = User::where('sipa_usuarios_identificacion',$idFuncionario)->get()[0];
            $lista = json_decode($listaActivos,true);
            if($lista){
                foreach($lista as $activos => $codigo){
                    $activo = Activo::where('sipa_activos_codigo',$codigo)->get()[0];
                    $activo->update(['sipa_activos_disponible'=> 0]);
                    

                    $asignaActivo = new AsignarActivoSala();
                    $asignaActivo->sipa_sala_asignada = $salaId->sipa_salas_id;
                    $asignaActivo->sipa_activo_asignado = $activo->sipa_activos_id;
                    $asignaActivo->sipa_fun_encargado = $funcionario->sipa_usuarios_id;

                    $asignaActivo->save();
                }
                return $data = [
                    'respuesta'=> 'Exito',
                ];
            }else{
                return $data = [
                    'respuesta'=> 'Error',
                ];
            }
            
        }else{
            return $data = [
                'respuesta'=> 'Error',
            ];
        }
    }

    public function existeSala($codigo){
        $sala = Salas::where('sipa_salas_codigo',$codigo)->count();

        if($sala > 0){
            return $dataSala = [
                    'respuesta' => 'Existe',
            ];
        }else{
            return $dataSala = [
                'respuesta' => 'No existe',
            ];
        }
    }
}
