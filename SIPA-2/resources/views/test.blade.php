<!DOCTYPE html>

@php
    // $cuerpos = App\CuerpoCorreo::all();
    //  $date = \Carbon\Carbon::parse('2016-01-23')->format('Y-m-d');
    //  $time = \Carbon\Carbon::parse('11:53:20')->format('H:i:s');
    // $arrayFechasHoras = array(); 
    // $arrayFechasHoras[] = [$date,$time,$date,$time];
    // $lista = array(); 
    // $lista[] = '5';
    // $lista[] = '6';
    // $mailIt = new App\CorreoPHPMailer();
    // $correo = App\CuerpoCorreo::find(1);
    //     // $body = $mailIt->prepareEmailBody_reservaActivos($lista,$arrayFechasHoras);
    // $correo->prepare_for_reservaActivos($lista,$date,$time,$date,$time);
    // $mailIt->sendMailPHPMailer($correo->sipa_cuerpo_correo_asunto,$correo->sipa_cuerpo_correos_cuerpo,'lea.cardenas14@gmail.com');
              
    //$alertas = App\alertasActivos::all();
    // dd($alertas->reserva);
   // $hoy = \Carbon\Carbon::now(new DateTimeZone('America/Managua'));
    
    
    //-----------------------------------------------------------------
    $alertas = App\AlertaInsumo::find(1);
    dd($alertas->insumo);
    
    $alertaActivo = new App\alertasActivos();
    $alertaActivo->revisarAlertasReservas();

    $alertaSala = new App\AlertaSala();
    $alertaSala->revisarAlertasSalas();

  
   // estas dos lineas son las qu eejecuta el handler de alertas
    //-----------------------------------------------------------------
    
    // $fiCarbon = \Carbon\Carbon::parse('2020-05-19')->format('Y-m-d');
    // $ffCarbon = \Carbon\Carbon::parse('2020-05-21')->format('Y-m-d');
    // $hiCarbon = \Carbon\Carbon::parse('23:53:00')->format('H:i:s');
    // $hfCarbon = \Carbon\Carbon::parse('00:53:00')->format('H:i:s');
    // $ActivosOcupado = new App\ActivosOcupados();
                
    // $ActivosOcupado->sipa_activosOcupados_activo = '1';
    // $ActivosOcupado->sipa_activosOcupados_fi = $fiCarbon;
    // $ActivosOcupado->sipa_activosOcupados_ff = $ffCarbon;
    // $ActivosOcupado->sipa_activosOcupados_hi = $hiCarbon;
    // $ActivosOcupado->sipa_activosOcupados_hf = $hfCarbon;
    // $ActivosOcupado ->save();
    

// Lista de activos:
// @listaActivosReserva@ ';
//         $cuerpo->sipa_cuerpo_correo_asunto ='Devolución de activos';
//         $cuerpo->save();

$reservas = App\Reserva::all();
@endphp

<html>
    <table class="table table-striped table-hover" id="table-usuarios">
        <thead>
            <tr>
                <th scope="col" class="text-center">Placa del activo</th>
                <th scope="col" class="text-center">Nombre del activo</th>
                <th scope="col" class="text-center">Fecha Inicial</th>
                <th scope="col" class="text-center">Hora Inicial</th>
                <th scope="col" class="text-center">Fecha Final</th>
                <th scope="col" class="text-center">Hora Final</th>
                <th scope="col" class="text-center">Funcionario</th>
                <th scope="col" class="text-center">Estado</th>
            </tr>
        </thead>

        <tbody class="text-center" id="tablaReservas">
            @foreach ($reservas as $reserva)
            @php
              $activos = $reserva->activos;
              $funcionario = App\User::find($reserva->sipa_reservas_activos_funcionario); 
            @endphp
            <tr id="{{$reserva->sipa_reservas_activos_id}}"> 
                <td data-label="Placa del activo">
                    @foreach($activos as $activo)
                    {{$activo->sipa_activos_codigo}}<br>
                    @endforeach </td>
                <td data-label="Nombre del activo">
                    @foreach($activos as $activo)
                    {{$activo->sipa_activos_nombre}} <br>
                    @endforeach </th>
                </td>
                <td data-label="Fecha Inicial"> {{$reserva->sipa_reservas_activos_fecha_inicio}} </td>
                <td data-label="Hora Inicial"> {{$reserva->sipa_reservas_activos_hora_inicio}} </td>
                <td data-label="Fecha Final"> {{$reserva->sipa_reservas_activos_fecha_fin}} </td>
                <td data-label="Hora Final"> {{$reserva->sipa_reservas_activos_hora_fin}} </td>
                <td data-label="Funcionario"> {{$funcionario->sipa_usuarios_nombre}}</td>
                <td data-label="Estado"> {{$reserva->sipa_reserva_estado}} </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</html>