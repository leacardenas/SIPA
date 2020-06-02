<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    // Table Name
    protected $table = 'sipa_usuarios';
    // Primary Key
    public $primaryKey = 'sipa_usuarios_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username',
    ];
    public function rol()
    {
        return $this->belongsTo('App\Rol', 'sipa_usuarios_rol','sipa_roles_id');
    }

    public function activoR(){
        return $this->hasMany('App\Activo', 'sipa_activos_responsable', 'sipa_usuarios_id');
    }

    public function activoE(){
        return $this->hasMany('App\Activo', 'sipa_activos_encargado', 'sipa_usuarios_id');
    }
    public function reservas(){
        return $this->hasMany('App\Reserva', 'sipa_reservas_activos_funcionario', 'sipa_usuarios_id');
    }

    public function insumoR(){
        return $this->hasOne('App\AsignarInsumo','sipa_usuario_responsable','sipa_usuarios_id');
    }

    public function insumoAA(){
        return $this->hasOne('App\AsignarInsumo','sipa_usuario_asignado','sipa_usuarios_id');
    }
    // /**
    //  * The attributes that should be hidden for arrays.
    //  *
    //  * @var array
    //  */
    // protected $hidden = [
    //     'password', 'remember_token',
    // ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
