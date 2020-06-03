<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlertaInsumo extends Model
{
          // Table Name
          protected $table = 'sipa_alertas_insumos';
          // Primary Key
          public $primaryKey = 'sipa_alertas_insumos_id';
          // Timestamps
          public $timestamps = false;
      
          public function __construct(){
              
          }
          protected $fillable = [
            'sipa_alertas_insumos_id', 'sipa_alertas_insumos_insumo', 'sipa_alertas_insumos_fechaHoraEnvio'
        ];
    
        public function insumo()
        {
            return $this->belongsTo('App\Insumos', 'sipa_alertas_insumos_insumo','sipa_insumos_id');
        }
        public function revisarAlertasInsumos(){
            $alertas = AlertaInsumo::all();

        }
}
