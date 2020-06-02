<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComprobanteEntrega extends Model
{
    // Table Name
    protected $table = 'sipa_entregas_comprobantes';
    // Primary Key
    public $primaryKey = 'sipa_comprobantes_id';
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
            'sipa_comprobantes_id', 'sipa_comprobante', 'sipa_comprobante_nombre',
            'sipa_comprobante_tipo'
    ];
}
