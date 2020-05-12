<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EtiquetaCorreo_CuerpoCorreo_match extends Model
{
    // Table Name
    protected $table = 'sipa_cuerpo_etiqueta_match';
    // Primary Key
    public $primaryKey = 'sipa_cuerpo_etiqueta_match_id';
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
        'sipa_cuerpo_etiqueta_match_id', 'sipa_cuerpo_etiqueta_match_cuerpo_correo', 'sipa_cuerpo_etiqueta_match_etiqueta'
        
    ];
}
