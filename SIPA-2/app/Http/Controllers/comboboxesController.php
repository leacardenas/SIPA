<?php

namespace App\Http\Controllers;
use App\Unidad;
use App\Edifico;
use Illuminate\Http\Request;

class comboboxesController extends Controller
{
    

    public function edificioInfo($nom)
    {   

        $edificios = Edifico::where('sipa_edificios_nombre',$nom);
        foreach($edificios->cursor() as $edificio){
            $seleccionado = $edificio;
        }
        
        $unidades = Unidad::where('sipa_edificios_unidades_edificio',$seleccionado->id);
        $array = [];
        $cont = 0;
        foreach ($unidades->cursor()  as $unidad) {
            $array[$cont] = $unidad->sipa_edificios_unidades_nombre;
            $cont = $cont +1;
        }
        $data = [
            'pisos' => $seleccionado->sipa_edificios_cantidad_pisos,
            'items' => $array,
        ];
        return $data;
    }
}
