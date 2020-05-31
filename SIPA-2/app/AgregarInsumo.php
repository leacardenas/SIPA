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

    public function insumo(){
        return $this->belongsTo('App\Insumos','sipa_ingreso_insumo','sipa_insumos_id');
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sipa_insumos_ingreso_id','sipa_ingreso_insumo',
        'sipa_insumo_factura','sipa_ingreso_insumo_cantidad',
        'sipa_ingreso_descripcion','created_at','sipa_ingresado_por',
    ];
}
