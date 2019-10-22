<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
        // Table Name
        protected $table = 'sipa_roles';
        // Primary Key
        public $primaryKey = 'sipa_roles_id';
        // Timestamps
        public $timestamps = true;

        public function __construct(){

        }
        public function user()
        {
            return $this->hasOne('App\User','sipa_usuarios_rol','sipa_roles_id');
        }
        public function permisos()
        {
            return $this->hasMany('App\Permiso','sipa_permisos_roles_role','sipa_roles_id');
        }
        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = [
    //     'sipa_roles_id', 'sipa_roles_codigo', 'sipa_roles_nombre',
    //     'sipa_roles_descripcion','sipa_roles_usuario_creador',
    //     'sipa_roles_usuario_actualizacion','created_at',
    //     'updated_at'
    // ];
}
