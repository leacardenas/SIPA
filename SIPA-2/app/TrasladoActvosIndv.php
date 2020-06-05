<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrasladoActvosIndv extends Model
{
    // Table Name
    protected $table = 'sipa_activos_traslado';
    // Primary Key
    public $primaryKey = 'sipa_traslado_id';
    // Timestamps
    public $timestamps = false;

    public function __construct(){
        
    }

    public function usuarioN(){
        return $this->belongsTo('App\User','sipa_usuario_nuevo','sipa_usuarios_id');
    }

    public function usuarioV(){
        return $this->belongsTo('App\User','sipa_usuario_viejo','sipa_usuarios_id');
    }
    /**
 * The attributes that are mass assignable.
 *
 * @var array
 */
    protected $fillable = [
        'sipa_traslado_id','sipa_activo','sipa_usuario_viejo',
        'sipa_usuario_nuevo','sipa_encargado_o_responsable','sipa_traslado_num_comp'

    ];
}
