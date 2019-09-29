<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sipa_permisos_roles extends Model
{
    public $primaryKey = 'sipa_permisos_roles_id';

    public function user(){
        return $this->morphMany('App\Models\sipa_usuarios','users');
    }

}
