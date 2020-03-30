<?php

namespace App;
use DateTime;
use DatePeriod;
use DateInterval;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    // Table Name
    protected $table = 'sipa_reservas_activos';
    // Primary Key
    public $primaryKey = 'sipa_reservas_activos_id';
    // Timestamps
    public $timestamps = true;

    public function __construct(){
        
    }
    public function activo()
    {
        return $this->belongsTo('App\Activo','sipa_reservas_activos_activo','sipa_activos_id');
    }
        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sipa_reservas_activos_id', 'sipa_reservas_activos_fecha_inicio', 'sipa_reservas_activos_fecha_fin',
        'sipa_reservas_activos_hora_inicio',
        'sipa_reservas_activos_hora_fin',
        'sipa_reservas_activos_funcionario',
        'sipa_reservas_activos_activo'
    ];

    public static function getDatesFromRange($start, $end, $format = 'Y-m-d') { 

        // Declare an empty array 
        $array = array(); 
            
        // Variable that store the date interval 
        // of period 1 day 
        $interval = new DateInterval('P1D'); 
        
        $realEnd = new DateTime($end); 
        $realEnd->add($interval); 
        
        $period = new DatePeriod(new DateTime($start), $interval, $realEnd); 
        
        // Use loop to store date into array 
        foreach($period as $date) {                  
            $array[] = $date->format($format);  
        } 
        
        // Return the array elements 
        return $array; 
    }
}
