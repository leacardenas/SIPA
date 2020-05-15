<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivoBaja extends Model
{
    // Table Name
    protected $table = 'sipa_activos_baja';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = false;

    public function __construct(){
        
    }

    

    public function activo(){
        return $this->belongsTo('App\Activo','sipa_activo_baja','sipa_activos_id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'sipa_activo_baja', 'motivo_baja','form_baja','tipo_form','nombre_form ',
    ];
}
