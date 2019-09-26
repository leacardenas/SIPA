<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\sipa_usuarios as Authenticatable;
use Illuminate\Notifications\Notifiable;

class sipa_usuarios extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sipa_usuarios_identificacion'
        ,'sipa_usuarios_contrasenna'
        ,'sipa_usuarios_nombre'
        ,'sipa_usuarios_apellidos'
        ,'sipa_usuarios_telefono'
        ,'sipa_usuarios_correo'
        ,'sipa_usuarios_unidad'
        ,'sipa_usuarios_edificio'
        ,'sipa_usuarios_rol'
        ,'sipa_usuarios_usuario_creador'
        ,'sipa_usuarios_usuario_actulizacion'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'sipa_usuarios_contrasenna', 'remember_token',
    ];


    public function getAuthPassword()
    {
      return $this->sipa_usuarios_contrasenna;
    }

    const CREATED_AT = 'sipa_creado_por';
    const UPDATED_AT = 'sipa_actualizado_por';
}
