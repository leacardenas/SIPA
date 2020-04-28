<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AsignarInsumo extends Model
{
    ////// Table Name
    protected $table = 'sipa_entregar_insumos';
    // Primary Key
    public $primaryKey = 'sipa_entrega_id';
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
        'sipa_entrega_id','sipa_entrega_insumo','sipa_usuario_responsable',
        'sipa_usuario_asignado','sipa_entrega_cantidad','sipa_entrega_observacion',
        'sipa_salas_nombre_img','sipa_salas_usuario_creador',
    ];
}
