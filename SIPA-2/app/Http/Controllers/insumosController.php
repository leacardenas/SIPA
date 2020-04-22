<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Insumos; 

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
}
