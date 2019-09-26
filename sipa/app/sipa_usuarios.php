<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sipa_usuarios extends Model
{
    public $primaryKey = 'sipa_usuarios_id';

    public function users()
    {
        return $this->morphTo();
    }

    public function user(){
        return $this->morphMany('App\Models\sipa_usuarios','users');
    }

}
