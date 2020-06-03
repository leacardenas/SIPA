<?php

namespace App\Http\Controllers;
use App\Activo;
use Illuminate\Http\Request;


class activoController extends Controller
{

    public function borrarActivos($id){
        

       try { 
        // $id = $request->input('activoId');
        $activo = Activo::find($id);
        $activo->delete();
        
          // Closures include ->first(), ->get(), ->pluck(), etc.
      } catch(\Illuminate\Database\QueryException $ex){ 
        return ['respuesta'=> 1];
        // Note any method of class PDOException can be called on $ex.
      }
     return ['respuesta'=> 0];
    }
}





