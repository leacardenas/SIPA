<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Insumos extends Model
{
    ////// Table Name
    protected $table = 'sipa_insumos';
    // Primary Key
    public $primaryKey = 'sipa_insumos_id';
    // Timestamps
    public $timestamps = true;

    public function __construct(){
            
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sipa_insumos_id', 'sipa_insumos_nombre','sipa_insumos_codigo',
        'sipa_insumos_cant_exist','sipa_insumos_descrip','sipa_insumos_tipo',
        'sipa_insumos_costo_uni','sipa_insumos_costo_total',
    ];
}
