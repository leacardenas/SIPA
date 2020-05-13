<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AsignarActivoSala extends Model
{
     ////// Table Name
     protected $table = 'sipa_activos_salas';
     // Primary Key
     public $primaryKey = 'sipa_sala_activos_id';
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
         'sipa_sala_activos_id','sipa_sala_asignada','sipa_activo_asignado ',
         'sipa_fun_encargado','created_at','updated_at',
         
     ];
}
