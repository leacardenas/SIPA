<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activo extends Model
{
    //// Table Name
    protected $table = 'sipa_activos';
    // Primary Key
    public $primaryKey = 'sipa_activos_id';
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
        'sipa_activos_id', 'sipa_activos_codigo', 
        'sipa_activos_nombre', 'sipa_activos_descripcion',
        'sipa_activos_fecha_creacion', 'sipa_activos_usuario_creador',
        'sipa_activos_fecha_actualizacion', 'sipa_activos_usuario_actualizacion',
        'sipa_activos_precio','sipa_activos_estado',
        'sipa_activos_foto','sipa_activos_edificio',
        'sipa_activos_ubicacion','sipa_activos_encargado',
        'sipa_activos_responsable','sipa_activos_marca','sipa_activos_modelo',
        'sipa_activos_serie',
    ];
}
