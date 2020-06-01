<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacturasInsumos extends Model
{
    ////// Table Name
    protected $table = 'sipa_insumos_facturas';
    // Primary Key
    public $primaryKey = 'sipa_facturas_id';
    // Timestamps
    public $timestamps = true;

    public function __construct(){
            
    }

   public function agregaInsumo(){
       return $this->hasOne('App\AgregaInsumo','sipa_insumo_factura','sipa_facturas_id');
   }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sipa_facturas_id','sipa_facturas_numero','sipa_facturas_documento',
        'sipa_factura_doc_nombre','sipa_factura_doc_tipo',
    ];
}
