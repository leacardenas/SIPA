<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AlertHandler extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:handle_alerts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Manejador de alertas';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //revisar si la fecha final de la reserva ya paso la fecha actual
        //si ya paso, revisar si los activos estan disponibles
        // si no estan, enviar alerta que los devuelva
        // si si estan, borrar alerta
    }
}
