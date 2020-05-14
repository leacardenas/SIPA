<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstadoActivo extends Model
{
    // Table Name
    protected $table = 'sipa_estado_activo';
    // Primary Key
    public $primaryKey = 'sipa_estado_activo_id';

    protected $fillable = [
        'sipa_estado_activo_id', 'sipa_estado_activo_nombre'
    ];

    
}
