<?php

namespace App\Http\Controllers;
use App\Unidad;
use App\Edifico;
use Illuminate\Http\Request;

class comboboxesController extends Controller
{
    

    public function edificioInfo($nom)
    {   
        $seleccionado = null;
        $edificios = Edifico::where('sipa_edificios_nombre',$nom)->get();
        foreach($edificios as $edificio){
            $seleccionado = $edificio;
        }
        
        $unidades = null;
        if($seleccionado!=null){
            $unidades = $seleccionado->unidades;
        }
        $array = [];
        $cont = 0;
        foreach ($unidades  as $unidad) {
            $array[$cont] = $unidad->sipa_unidades_nombre;
            $cont = $cont +1;
        }
        $data = [
            'pisos' => $seleccionado->sipa_edificios_cantidad_pisos,
            'items' => $array,
        ];
        return $data;
    }
}
