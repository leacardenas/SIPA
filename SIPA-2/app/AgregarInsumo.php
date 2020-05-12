<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgregarInsumo extends Model
{
    ////// Table Name
    protected $table = 'sipa_insumos_ingreso';
    // Primary Key
    public $primaryKey = 'sipa_insumos_ingreso_id';
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
        'sipa_insumos_ingreso_id','sipa_ingreso_numero_documento','sipa_ingreso_insumo',
        'sipa_ingreso_insumo_cantidad','sipa_ingreso_documento','sipa_ingreso_nombre_doc',
        'sipa_ingreso_tipo','sipa_ingreso_descripcion','created_at','sipa_ingreso_tipo',
        
    ];
}
