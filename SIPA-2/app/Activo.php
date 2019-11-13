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
        'sipa_activos_usuario_creador',
        'sipa_activos_usuario_actualizacion',
        'sipa_activos_precio','sipa_activos_estado',
        'sipa_activos_foto','tipo_imagen','sipa_activos_edificio',
        'sipa_activos_piso_edificio','sipa_activos_ubicacion','sipa_activos_encargado',
        'sipa_activos_responsable','sipa_activos_marca','sipa_activos_modelo',
        'sipa_activos_serie','sipa_activos_disponible',
        'sipa_activos_motivo_baja','sipa_activos_fomulario','	sipa_activos_tipo_form',
        'sipa_activos_unidad',
    ];

    public function estado()
    {
        return $this->hasOne('App\EstadoActivo', 'sipa_estado_activo_id','sipa_activos_id');
    }
}
