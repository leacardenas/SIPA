<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReservaSalaMatch extends Model
{
         // Table Name
         protected $table = 'sipa_reserva_sala_match';
         // Primary Key
         public $primaryKey = 'sipa_reserva_sala_id';
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
             'sipa_reserva_sala_id', 'sipa_reserva_sala_reservaSalaId', 'sipa_reserva_sala_salaId'
           
         ];
}
