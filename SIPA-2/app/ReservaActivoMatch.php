<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReservaActivoMatch extends Model
{
       // Table Name
       protected $table = 'sipa_reserva_activo_match';
       // Primary Key
       public $primaryKey = 'sipa_reserva_activo_id';
       // Timestamps
       public $timestamps = false;
   
       public function __construct(){
           
       }

           /**
        * The attributes that are mass assignable.
        *
        * @var array
        */
       protected $fillable = [
           'sipa_reserva_activo_id', 'sipa_reserva_activo_reservaId', 'sipa_reserva_activo_activoId'
         
       ];
}
