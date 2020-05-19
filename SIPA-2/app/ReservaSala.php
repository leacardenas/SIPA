<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReservaSala extends Model
{
       // Table Name
       protected $table = 'sipa_reservas_salas';
       // Primary Key
       public $primaryKey = 'sipa_reserva_salas_id';
       // Timestamps
       public $timestamps = false;
   
       public function __construct(){
           
       }
   
       public function salas(){
           return $this->belongsToMany('App\Salas', 'sipa_reserva_sala_match', 'sipa_reserva_sala_reservaSalaId', 'sipa_reserva_sala_salaId');
       }
       public function user(){
        return $this->belongsTo('App\User', 'sipa_reservas_salas_funcionario', 'sipa_usuarios_id');
       }
           /**
        * The attributes that are mass assignable.
        *
        * @var array
        */
       protected $fillable = [
           'sipa_reserva_salas_id', 'sipa_reservas_salas_fecha_inicio', 'sipa_reservas_salas_fecha_fin',
           'sipa_reservas_salas_hora_inicio',
           'sipa_reservas_salas_hora_fin',
           'sipa_reservas_salas_pdf',
           'sipa_reservas_salas_funcionario','sipa_reservas_sala_estado'
       ];
}
