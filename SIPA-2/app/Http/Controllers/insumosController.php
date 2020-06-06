<?php

namespace App\Http\Controllers;

// use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Support\Arr;
use PDF;
use App;
use DOMDocument;
use DB;
//use Illuminate\Support\Facades\Input;

use App\Insumos; 
use App\EditarExistencia;
use App\AsignarInsumo;
use App\User;
use App\AgregarInsumo;
use App\FacturasInsumos;
use App\CuerpoCorreo;
use App\CorreoPHPMailer;
use App\ComprobanteEntrega;

class insumosController extends Controller
{

    public function ingresarInsumos(Request $request){
        $usuarioId = session('idUsuario');
        $usuario = User::where('sipa_usuarios_identificacion',$usuarioId)->get()[0];
        $insumo = new Insumos();

        //Ingreso a la base de datos
        $insumo->sipa_insumos_codigo = $request->input('codigoInsumos');
        $insumo->sipa_insumos_nombre = $request->input('nombreInsumos');
        $insumo->sipa_insumos_minimo = $request->input('minimoEnInventario');
        $insumo->sipa_insumos_descrip = $request->input('descripcionInsumos');
        $insumo->sipa_insumos_costo_uni = $request->input('costoUnitarioInsumos');
        $insumo->sipa_insumo_creador = $usuario->sipa_usuarios_id;
        
        $insumo->save();

        // $value = Request::server('PATH_INFO');
        
        return view('insumos/registrarInsumo');
    }

    public function editarExistencia(Request $request){
        $usuarioId = session('idUsuario');
        $usuario = User::where('sipa_usuarios_identificacion',$usuarioId)->get()[0];
        $idInsumo = $request->input('insumoId');
        $cantAunment =  $request->input('nuevaCanti');
        $motivo = $request->input('editMotivo');
        $insumo = Insumos::where('sipa_insumos_id',$idInsumo)->get()[0];
        $modificacion = new EditarExistencia();
        $cantInven =  $insumo->sipa_insumos_cant_exist;
        $precioUnitarioInt = (int)str_replace(',','',Str::before(trim($insumo->sipa_insumos_costo_uni, "₡"),'.'));
        $precioTotalInt = (int)str_replace(',','',Str::before(trim($insumo->sipa_insumos_costo_total, "₡"),'.'));
        $precioIngresado = $precioUnitarioInt * $cantAunment;
        $accion = "";
        $nuevoPrecioTotal = 0;
        $fields = $request->input('customRadioInline1');
            if($fields == 'aumentar'){
                $accion = "aumentar";
                $nuevaCant = $cantInven + $cantAunment;
                $nuevoPrecioTotal = $precioTotalInt + $precioIngresado;
            }
            else{
                if($cantAunment < $cantInven){
                    $accion = "disminuir";
                    $nuevaCant = $cantInven - $cantAunment;
                    $nuevoPrecioTotal = $precioTotalInt - $precioIngresado;
                    if($nuevaCant<=$insumo->sipa_insumos_minimo){
                        $correo = CuerpoCorreo::find(6);
                        $mailIt = new CorreoPHPMailer();
                        $correo->prepare_for_alertaUnsumos($insumo);
                        //$mailIt->sendMailPHPMailer($correo->sipa_cuerpo_correo_asunto,$correo->sipa_cuerpo_correos_cuerpo,$user->sipa_usuarios_correo);
                    }
                }
            }
            $precioTotalFormato = "₡".number_format($nuevoPrecioTotal, 2);
            $precioFormato = "₡".number_format($precioIngresado, 2);
            $insumo->update(['sipa_insumos_cant_exist' => $nuevaCant , 
            'sipa_insumos_costo_total' => $precioTotalFormato]);

            $modificacion->sipa_cantidad_modif = $cantAunment;
            $modificacion->sipa_motivo = $motivo;
            $modificacion->sipa_insumo_editado = $idInsumo;
            $modificacion->sipa_insumo_accion = $accion;
            $modificacion->sipa_editar_precio = $precioFormato;
            $modificacion->sipa_editado_por = $usuario->sipa_usuarios_id;
            $modificacion->save();
            
        return view('inventario/insumos');
    }

    public function verificarExistencia($cantidad,$id){

            $insumo = Insumos::where('sipa_insumos_id',$id)->get();
            $cantidadExistencia;
            foreach($insumo as $vinsumo){
                $cantidadExistencia = $vinsumo->sipa_insumos_cant_exist;
            }

            if($cantidadExistencia < $cantidad){
        
                return $data = [
                    'existencia'=> 'insuficientes',
                    'cantidad' => $cantidadExistencia,
                ];
            }else{
                return $data = [
                    'existencia'=> 'suficientes',
                ];
            }
        
    }

    public function asignarInsumo($listaInsumos,$idFuncionario,$observacion){
        $lista = json_decode($listaInsumos,true);

        if($lista && $idFuncionario && $observacion){
            $cedEncargado = session('idUsuario');
            $encargado = User::where('sipa_usuarios_identificacion',$cedEncargado)->get()[0];
            foreach($lista as $insumos => $insumo){
                $insumoAsignado =  explode(' - ', $insumo);
                $nombre = $insumoAsignado[0];
                $cantidad = (int)$insumoAsignado[1];
                $insumoR = Insumos::where('sipa_insumos_codigo',$nombre)->get()[0];
                $cantidadExistencia = $insumoR->sipa_insumos_cant_exist;
                $precioUnitario = (int)str_replace(',','',Str::before(trim($insumoR->sipa_insumos_costo_uni, "₡"),'.'));
                $precioTotal = (int)str_replace(',','',Str::before(trim($insumoR->sipa_insumos_costo_total, "₡"),'.'));
                
                $cantNueva = $cantidadExistencia - $cantidad;
                $precioDisminuir = $precioUnitario * $cantidad;
                $nuevoPrecio = $precioTotal - $precioDisminuir;
                $insumoR->update([
                    'sipa_insumos_cant_exist' => $cantNueva,
                    'sipa_insumos_costo_total' => "₡".number_format($nuevoPrecio,2),
                ]);
                if($cantNueva<=$insumoR->sipa_insumos_minimo){
                    $correo = CuerpoCorreo::find(6);
                    $mailIt = new CorreoPHPMailer();
                    $correo->prepare_for_alertaUnsumos($insumoR);
                   // $mailIt->sendMailPHPMailer($correo->sipa_cuerpo_correo_asunto,$correo->sipa_cuerpo_correos_cuerpo,$user->sipa_usuarios_correo);
                }
                $entregaInsumo = new AsignarInsumo();
                $entregaInsumo->sipa_entrega_insumo = $insumoR->sipa_insumos_id;
                $entregaInsumo->sipa_usuario_responsable = $encargado->sipa_usuarios_id;
                $entregaInsumo->sipa_usuario_asignado = $idFuncionario;
                $entregaInsumo->sipa_entrega_cantidad = $cantidad;
                $entregaInsumo->sipa_entrega_observacion = $observacion;

                $entregaInsumo->save();
            }

            //hacer el crear y guardar pdf
            $html = view('pdfViews.comprobanteEntregas')->render();
            $pdf = App::make('dompdf.wrapper');
            $pdf->loadHTML($html);
            $pdf->setPaper('landscape');
            $content = $pdf->download()->getOriginalContent();
            $documento = base64_encode($content);

            $comprobante = new ComprobanteEntrega();
            $comprobante->sipa_comprobante = $documento;
            $comprobante->sipa_comprobante_tipo = "pdf";
            $comprobante->sipa_comprobante_nombre = "ComprobanteEntrega";
            $comprobante->save();
            $insumosCom = AsignarInsumo::where('sipa_entrega_comprobante',null)->get();
            $comprobanteNumero = DB::table('sipa_entregas_comprobantes')->orderBy('sipa_comprobantes_id','desc')->first();
            $numero = $comprobanteNumero->sipa_comprobantes_id;
            $insumoPrueba = 0;
            foreach($insumosCom as $insumosC){
                $insumosC->update(['sipa_entrega_comprobante' => $numero]);
            }

            return $data = [
                'respuesta'=> 'Exito',
            ];
        }else{
            return $data = [
                'respuesta'=> 'Error',
            ];
        }

        return $data = [
            'respuesta' => 'Algo salió mal' 
        ];
    }

    public function borrarInsumo(Request $request){
        $id = $request->input('activoId');
        $activo = Insumos::find($id);
        $activo->delete();
        
        return view('inventario/insumos');
    }

    public function agregarInsumos(Request $request){
        $usuarioId = session('idUsuario');
        $usuario = User::where('sipa_usuarios_identificacion',$usuarioId)->get()[0];
        $insumoId =  $request->input('insumoIdA');
        $cantidadAumentar = $request->input('cantidaInsumo');
        $insumoDescripcion = $request->input('info_input');
        $precioUnitarioIngresado = $request->input('costoTotalInsumos');

        $insumoAgregar = Insumos::where('sipa_insumos_id',$insumoId)->get()[0];
        $cantInventario = $insumoAgregar->sipa_insumos_cant_exist;
        
        $precioUnitario = (int)str_replace(',','',Str::before(trim($precioUnitarioIngresado, "₡"),'.'));
        //$precioTotal = (int)str_replace(',','',Str::before(trim($insumoAgregar->sipa_insumos_costo_total, "₡"),'.'));

        $nuevoCantidad = $cantInventario + $cantidadAumentar;
        $precioAgregar = $cantidadAumentar * $precioUnitario;
        $nuevoPrecio = $nuevoCantidad * $precioUnitario;
        $insumoAgregar->update(['sipa_insumos_cant_exist' => $nuevoCantidad,
                                'sipa_insumos_costo_total' => "₡".number_format($nuevoPrecio,2),
                                'sipa_insumos_costo_uni' => $precioUnitarioIngresado]);

        $agregar = new AgregarInsumo();

        $agregar->sipa_ingreso_insumo = $insumoId;
        $agregar->sipa_ingreso_insumo_cantidad = $cantidadAumentar;
        $agregar->sipa_ingreso_precio_unitario = $precioUnitarioIngresado;
        $agregar->sipa_ingreso_total = "₡".number_format($precioAgregar,2);
        $agregar->sipa_ingreso_descripcion = $insumoDescripcion;
        $agregar->sipa_ingresado_por = $usuario->sipa_usuarios_id;

        $agregar->save();

        return view('inventario/insumos');

       
    }

    public function existeNomInsumo($nombre){ //cambiar para que revise por codigo
        $insumo = Insumos::where('sipa_insumos_codigo',$nombre)->count();

        if($insumo > 0){
            return $data = [
                'respuesta'=> 'Existe',
            ];
        }else{
            return $data =[
                'repuesta' => 'No existe',
            ];
        }
    }

    public function registrarFactura(Request $request){
        
        if($request->input('numeroDocumento') || $request->file('documentoInsumos')){
            $insumoFactura = new FacturasInsumos();

            if($request->input('numeroDocumento')){
                $insumoFactura->sipa_facturas_numero = $request->input('numeroDocumento');
            }
            if($request->file('documentoInsumos')){
                $documento = $request->file('documentoInsumos');
                $insumoFactura->sipa_facturas_numero = $request->input('numeroDocumento');
                $factura = $documento->getRealPath();
                $contFactura = file_get_contents($factura);
                $factura2 = base64_encode($contFactura);
                $originalName = $documento->getClientOriginalName();
                $nombre = pathinfo($originalName, PATHINFO_FILENAME);
                $tipoFactura = $documento->getClientOriginalExtension();

                $insumoFactura->sipa_facturas_documento = $factura2;
                $insumoFactura->sipa_factura_doc_nombre = $nombre;
                $insumoFactura->sipa_factura_doc_tipo = $tipoFactura;
            }
            $insumoFactura->save();

            $facturaInsumo = DB::table('sipa_insumos_facturas')->orderBy('sipa_facturas_id','desc')->first();
            
            $registroInsumos = AgregarInsumo::where('sipa_insumo_factura',null)->where('sipa_ingreso_tiene_factura',2)->get();
            foreach($registroInsumos as $registroInsumo){
                $registroInsumo->sipa_insumo_factura=$facturaInsumo->sipa_facturas_id;
                $registroInsumo->sipa_ingreso_tiene_factura=1;
                $registroInsumo->save();
            }
        }else{
            //dd('Else');
            $registroInsumos = AgregarInsumo::where('sipa_insumo_factura',null)->where('sipa_ingreso_tiene_factura',2)->get();
            foreach($registroInsumos as $registroInsumo){
                $registroInsumo->sipa_ingreso_tiene_factura = 0;
                $registroInsumo->save();
            }
        }
        return view('inventario.insumos');
    }

    public function eliminarAgregar(Request $request){
        $id = $request->input('ingresoId');
        $registroInsumo = AgregarInsumo::find($id);
        $insumo = Insumos::find($registroInsumo->sipa_ingreso_insumo);
        $cantidad = $registroInsumo->sipa_ingreso_insumo_cantidad;
        $cantInven =  $insumo->sipa_insumos_cant_exist;
        $precioUnitarioInt = (int)str_replace(',','',Str::before(trim($registroInsumo->sipa_ingreso_total, "₡"),'.'));
        $precioTotalInt = (int)str_replace(',','',Str::before(trim($insumo->sipa_insumos_costo_total, "₡"),'.'));

        $precioNuevo = $precioTotalInt - $precioUnitarioInt;
        $cantidadNueva = $cantInven - $cantidad;

        $insumo->update(['sipa_insumos_costo_total'=> "₡".number_format($precioNuevo,2),
                        'sipa_insumos_cant_exist '=> $cantidadNueva,

        ]);

        $registroInsumo->delete();

        return view('insumos.asociarInsumoFactura');
    }

    public function descargarFactura($id){
        $factura = FacturasInsumos::find($id);

        $file_contents = base64_decode($factura->sipa_facturas_documento);
        $nombre = $factura->sipa_factura_doc_nombre;
        $tipo = $factura->sipa_factura_doc_tipo;

        return response($file_contents)
        ->header('Cache-Control', 'no-cache private')
        ->header('Content-Description', 'File Transfer')
        ->header('Content-Type', $tipo)
        ->header('Content-length', strlen($file_contents))
        ->header('Content-Disposition', 'attachment; filename=' . $nombre . '.pdf')
        ->header('Content-Transfer-Encoding', 'binary');
    }
   
    public function descargarComprobante($id){
        $comprobante = ComprobanteEntrega::find($id);

        $file_contents = base64_decode($comprobante->sipa_comprobante);
        $nombre = $comprobante->sipa_comprobante_nombre;
        $tipo = $comprobante->sipa_comprobante_tipo;

        return response($file_contents)
        ->header('Cache-Control', 'no-cache private')
        ->header('Content-Description', 'File Transfer')
        ->header('Content-Type', $tipo)
        ->header('Content-length', strlen($file_contents))
        ->header('Content-Disposition', 'attachment; filename=' . $nombre . '.pdf')
        ->header('Content-Transfer-Encoding', 'binary');
    }
}
