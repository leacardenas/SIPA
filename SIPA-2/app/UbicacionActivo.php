<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UbicacionActivo extends Model
{
    /// Table Name
    protected $table = 'sipa_activos_traslado_ubicacion';
    // Primary Key
    public $primaryKey = 'sipa_ubicacion_id';
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
        'sipa_ubicacion_id','sipa_ubicacion_activo','sipa_ubicacion_nuevo_edificio',
        'sipa_ubicacion_viejo_edificio','sipa_nueva_unidad','sipa_vieja_unidad',
    ];
}
