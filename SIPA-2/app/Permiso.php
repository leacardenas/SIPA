<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    // Table Name
    protected $table = 'sipa_permisos_roles';
    // Primary Key
    public $primaryKey = 'sipa_permisos_roles_id';

    public function modulo()
    {
        return $this->belongsTo('App\Modulo', 'sipa_permisos_roles_opciones_menu','sipa_opciones_menu_id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sipa_permisos_roles_crear', 'sipa_permisos_roles_editar', 
        'sipa_permisos_roles_ver', 'sipa_permisos_roles_borrar',
        'sipa_permisos_roles_exportar',
        'sipa_permisos_roles_usuario_actualizacion',
    ];
}
