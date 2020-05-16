<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class alertasActivos extends Model
{
      // Table Name
      protected $table = 'sipa_alertas_activos';
      // Primary Key
      public $primaryKey = 'sipa_alertas_activos_id';
      // Timestamps
      public $timestamps = false;
  
      public function __construct(){
          
      }
      protected $fillable = [
        'sipa_alertas_activos_id', 'sipa_alertas_activos_reserva', 'sipa_alertas_activos_fechaHoraEnvio'
    ];

    public function reserva()
    {
        return $this->hasone('App\Reserva', 'sipa_reservas_activos_id','sipa_alertas_activos_id');
    }
    
}
