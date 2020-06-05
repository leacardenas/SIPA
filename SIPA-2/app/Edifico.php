<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\UnidadesEdificiosMatch;
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
        public function unidades(){
            return $this->belongsToMany('App\Unidad', 'sipa_edificios_unidades', 'sipa_edificios_unidades_edificio', 'sipa_edificios_unidades_unidad');
        }

        public function activo(){
            return $this->hasMany('App\Activo','sipa_activos_edificio','id');
        }
}
