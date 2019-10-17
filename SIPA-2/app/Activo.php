<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activo extends Model
{
    //// Table Name
    protected $table = 'sipa_activos';
    // Primary Key
    public $primaryKey = 'sipa_activos_id';
    // Timestamps
    public $timestamps = true;

    public function __construct(){
            
    }

    
}
