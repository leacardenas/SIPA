<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnidadesEdificiosMatch extends Model
{
    // Table Name
    protected $table = 'sipa_edificios_unidades';
    // Primary Key
    public $primaryKey = 'sipa_edificios_unidades_id';
    

    public function __construct(){
        
    }

        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sipa_edificios_unidades_id', 'sipa_edificios_unidades_unidad', 
        'sipa_edificios_unidades_edificio',
    ];
}
