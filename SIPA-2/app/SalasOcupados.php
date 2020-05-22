<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalasOcupados extends Model
{
        //// Table Name
        protected $table = 'sipa_salasocupadas';
        // Primary Key
        public $primaryKey = 'sipa_salasOcupadas_id';
        // Timestamps
        public $timestamps = false;
    
        public function __construct(){
                
        }
        protected $fillable = [
           'sipa_salasOcupadas_id', 'sipa_salasOcupadas_sala', 
           'sipa_salasOcupadas_fi', 'sipa_salasOcupadas_ff',
           'sipa_salasOcupadas_hi','sipa_salasOcupadas_hf'
       ];
       public function Sala()
       {
           return $this->belongsTo('App\Salas', 'sipa_salasOcupadas_sala', 'sipa_salas_id');
       }
}
