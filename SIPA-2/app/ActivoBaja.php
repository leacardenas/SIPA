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

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'sipa_activo_baja', 'motivo_baja','form_baja','	tipo_form'
    ];
}
