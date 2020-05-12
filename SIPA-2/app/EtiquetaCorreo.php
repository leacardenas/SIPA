<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EtiquetaCorreo extends Model
{
    // Table Name
    protected $table = 'sipa_cuerpo_correos_etiquetas';
    // Primary Key
    public $primaryKey = 'sipa_cuerpo_correos_etiquetas_id';
    // Timestamps
    public $timestamps = false;

    public function __construct(){
        
    }
 
    public function activos(){
        return $this->belongsToMany('App\CuerpoCorreo', 'sipa_cuerpo_etiqueta_match', 'sipa_cuerpo_etiqueta_match_etiqueta', 'sipa_cuerpo_etiqueta_match_cuerpo_correo');
    }
        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sipa_cuerpo_correos_etiquetas_id', 'sipa_cuerpo_correos_etiquetas_etiqueta'
    ];
}
