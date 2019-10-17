<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Edifico extends Model
{
            // Table Name
            protected $table = 'sipa_edificios';
            // Primary Key
            public $primaryKey = 'id';
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
            'id', 'sipa_edificios_nombre', 'sipa_edificios_cantidad_pisos'
        ];
}
