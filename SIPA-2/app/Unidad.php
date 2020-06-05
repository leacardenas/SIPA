<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unidad extends Model
{
                // Table Name
                protected $table = 'sipa_unidades';
                // Primary Key
                public $primaryKey = 'sipa_unidades_id';
                // Timestamps
                public $timestamps = false;
            
                public function __construct(){
                    
                }
        
                /**
             * The attributes that are mass assignable.
             *
             * @var array
             */
            protected $fillable = [
                'sipa_unidades_id', 'sipa_unidades_nombre', 
                
            ];

            public function activo(){
                return $this->hasMany('App\Activo','sipa_activos_unidad','sipa_unidades_id');
            }
}
