<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivosOcupados extends Model
{
     //// Table Name
     protected $table = 'sipa_activosocupados';
     // Primary Key
     public $primaryKey = 'sipa_activosOcupados_id';
     // Timestamps
     public $timestamps = false;
 
     public function __construct(){
             
     }
     protected $fillable = [
        'sipa_activosOcupados_id', 'sipa_activosOcupados_activo', 
        'sipa_activosOcupados_fi', 'sipa_activosOcupados_ff',
        'sipa_activosOcupados_hi','sipa_activosOcupados_hf'
    ];
    public function activo()
    {
        return $this->belongsTo('App\Activo', 'sipa_activosOcupados_activo', 'sipa_activos_id');
    }
}
