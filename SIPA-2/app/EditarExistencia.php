<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EditarExistencia extends Model
{
    //Editar existencia de insumos 

     ////// Table Name
     protected $table = 'sipa_insumo_editar_existencia';
     // Primary Key
     public $primaryKey = 'sipa_editar_exist_id ';
     // Timestamps
     public $timestamps = true;
 
     public function __construct(){
             
     }
 
     /**
      * The attributes that are mass assignable.
      *
      * @var array
      */
     protected $fillable = [
         'sipa_editar_exist_id','sipa_cantidad_modif','sipa_motivo','created_at',
         'updated_at',
     ];
}
