<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    // Table Name
    protected $table = 'sipa_permisos_roles';
    // Primary Key
    public $primaryKey = 'sipa_permisos_roles_id';

    public function modulo(){

        return $this->belongsTo('App\Modulo', 'sipa_permisos_roles_opciones_menu','sipa_opciones_menu_id');
    }

}
