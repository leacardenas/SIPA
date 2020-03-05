<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BajaSalas extends Model
{
    //// Table Name
    protected $table = 'sipa_salas_baja';
    // Primary Key
    public $primaryKey = 'sipa_baja_id';
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
        'baja_sala_id ','sipa_baja_id','motivo_baja_sala',
        'form_baja_sala','form_nombre_baja_sala',' form_tipo_baja_sala',
        'sipa_usuario_baja_sala',
    ];
}
