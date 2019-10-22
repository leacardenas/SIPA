<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    // Table Name
    protected $table = 'sipa_opciones_menus';
    // Primary Key
    public $primaryKey = 'sipa_opciones_menu_id';

    public function permiso(){

        return $this->hasOne('App\Permiso', 'sipa_permisos_roles_opciones_menu','sipa_opciones_menu_id');
    }

}
