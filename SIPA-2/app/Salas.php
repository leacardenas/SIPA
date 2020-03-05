<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salas extends Model
{
    //// Table Name
    protected $table = 'sipa_salas';
    // Primary Key
    public $primaryKey = 'sipa_salas_id';
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
        'sipa_salas_id','sipa_salas_codigo','sipa_sala_ubicacion',
        'sipa_sala_informacion','sipa_salas_imagen','sipa_salas_tipo_img',
        'sipa_salas_nombre_img','sipa_salas_usuario_creador',
    ];

}
