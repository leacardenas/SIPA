<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
//use Illuminate\Support\Facades\Input;

use App\Insumos; 
use App\EditarExistencia;

class insumosController extends Controller
{

    public function ingresarInsumos(Request $request){
        $insumo = new Insumos();
        $numero = Str::random(5);
        $nombre = $request->input('nombreInsumos');
        $nombreArray =  explode(' ', $nombre);
        $iniNombre = '';
        foreach($nombreArray as $name){
            $nom = Str::substr($name, 0, 2); 
            $iniNombre = $iniNombre.$nom;
        }
        $codigo = $iniNombre.$numero;
        $insumo->sipa_insumos_nombre=$nombre;
        $insumo->sipa_insumos_codigo = $codigo;
        $insumo->sipa_insumos_cant_exist = $request->input('cantidadInsumos');
        $insumo->sipa_insumos_descrip = $request->input('descripcionInsumos');
        $insumo->sipa_insumos_tipo = $request->input('tipoInsumos');
        $insumo->sipa_insumos_costo_uni = $request->input('costoUnitarioInsumos');

        $insumo->save();

        return view('insumos/registrarInsumo');
    }

    public function editarExistencia(Request $request){
        $idInsumo = $request->input('insumoId');
        $cantAunment =  $request->input('nuevaCanti');
        $motivo = $request->input('editMotivo');
        $insumo = Insumos::where('sipa_insumos_id',$idInsumo)->get()[0];
        $modificacion = new EditarExistencia();
        $cantInven =  $insumo->sipa_insumos_cant_exist;
        $accion = "";
        $fields = $request->input('customRadioInline1');
            if($fields == 'aumentar'){
                $accion = "aumentar";
                $nuevaCant = $cantInven + $cantAunment;
                $insumo->update(['sipa_insumos_cant_exist' => $nuevaCant]);
                
            }
            else{
                if($cantAunment > $cantInven){
                    $accion = "disminuir";
                    $nuevaCant = $cantInven - $cantAunment;
                    $insumo->update(['sipa_insumos_cant_exist' => $nuevaCant]);
                }
            }

            $modificacion->sipa_cantidad_modif = $cantAunment;
            $modificacion->sipa_motivo = $motivo;
            $modificacion->sipa_insumo_editado = $idInsumo;
            $modificacion->sipa_insumo_accion = $accion;

            $modificacion->save();
            
        return view('inventario/insumos');
    }

    public function verificarExistencia($cantidad,$id){

            $insumo = Insumos::where('sipa_insumos_id',$id)->get();
            $cantidadExistencia;
            foreach($insumo as $vinsumo){
                $cantidadExistencia = $vinsumo->sipa_insumos_cant_exist;
            }

            if($cantidadExistencia < $cantidad){
        
                return $data = [
                    'existencia'=> 'insuficientes',
                ];
            }else{
                return $data = [
                    'existencia'=> 'suficientes',
                ];
            }
        
    }
}
