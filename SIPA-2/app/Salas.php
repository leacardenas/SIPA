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
    public function reservas(){
        return $this->belongsToMany('App\ReservaSala', 'sipa_reserva_sala_match', 'sipa_reserva_sala_salaId', 'sipa_reserva_sala_reservaSalaId');
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sipa_salas_id','sipa_salas_codigo','sipa_sala_ubicacion',
        'sipa_sala_informacion','sipa_salas_imagen','sipa_salas_tipo_img',
        'sipa_salas_nombre_img','sipa_salas_usuario_creador', 'sipa_sala_capacidad','sipa_salas_estado','sipa_sala_activo'
    ];
    public function estadoReserva()
    {
        return $this->hasOne('App\estadoReservas', 'sipa_estado_reservas_id','sipa_salas_id');
    }
}
