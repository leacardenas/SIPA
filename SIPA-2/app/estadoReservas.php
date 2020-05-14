<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class estadoReservas extends Model
{
        // Table Name
        protected $table = 'sipa_estado_reservas';
        // Primary Key
        public $primaryKey = 'sipa_estado_reservas_id';
    
        protected $fillable = [
            'sipa_estado_reservas_id', 'sipa_estado_reservas_estados'
        ];
    
        public function activos()
        {
            return $this->belongsTo('App\Activo','sipa_estado_activo_id','sipa_activos_id');
        }
}
