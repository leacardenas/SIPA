<?php

namespace App;
use App\User;
use Illuminate\Database\Eloquent\Model;

class CuerpoCorreo extends Model
{
        //// Table Name
        protected $table = 'sipa_cuerpo_correos';
        // Primary Key
        public $primaryKey = 'sipa_cuerpo_correos_id';
        // Timestamps
        public $timestamps = true;
    
        public function __construct(){
                
        }
       
        public function etiquetas(){
            return $this->belongsToMany('App\EtiquetaCorreo', 'sipa_cuerpo_etiqueta_match', 'sipa_cuerpo_etiqueta_match_cuerpo_correo', 'sipa_cuerpo_etiqueta_match_etiqueta');
        }
        /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
        protected $fillable = [
            'sipa_cuerpo_correos_id', 'sipa_cuerpo_correos_nombre', 
            'sipa_cuerpo_correos_cuerpo','sipa_cuerpo_correo_asunto'
        ];

        public function prepare_for_reservaActivos($listaActivosid,$datei,$timei,$datef,$timef){
            $cedula = session('idUsuario');
            $user = User::where('sipa_usuarios_identificacion',$cedula)->get()[0];

            $listaActivos = array(); 
            foreach($listaActivosid as $id){
                $listaActivos[] = Activo::find($id);  
            }

            $body = $this->sipa_cuerpo_correos_cuerpo;
            $listaActivosString='';
            foreach ($listaActivos as $activo) {
                $listaActivosString = $listaActivosString.'<br/>
                Codigo: '.$activo->sipa_activos_codigo.' <br/>
                Descripcion: '.$activo->sipa_activos_descripcion.' <br/>
                
                ';
            }
            
            $body=str_replace('@nombreUsuario@', $user->sipa_usuarios_nombre, $body);
            $body=str_replace('@cedulaUsuario@', $user->sipa_usuarios_identificacion, $body);
            $body=str_replace('@fechaInicialReserva@', $datei, $body);
            $body=str_replace('@fechaFinalReserva@', $datef, $body);
            $body=str_replace('@listaActivosReservados@', $listaActivosString, $body);
            $body=str_replace('@horaInicialReserva@', $timei, $body);
            $body=str_replace('@horaFinalReserva@', $timef, $body);

            $head = $this->sipa_cuerpo_correo_asunto;
            $head=str_replace('@nombreUsuario@', $user->sipa_usuarios_nombre, $head);
            $head=str_replace('@cedulaUsuario@', $user->sipa_usuarios_identificacion, $head);
            $head=str_replace('@fechaInicialReserva@', $datei, $head);
            $head=str_replace('@fechaFinalReserva@', $datef, $head);
            $head=str_replace('@listaActivosReservados@', $listaActivosString, $head);
            $head=str_replace('@horaInicialReserva@', $timei, $head);
            $head=str_replace('@horaFinalReserva@', $timef, $head);
           
            $this->sipa_cuerpo_correos_cuerpo  = $body;
            $this->sipa_cuerpo_correo_asunto  = $head;
          
        }
}
