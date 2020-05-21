<?php

namespace App\Http\Controllers;

// use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Support\Arr;
use DOMDocument;
//use Illuminate\Support\Facades\Input;

use App\Insumos; 
use App\EditarExistencia;
use App\AsignarInsumo;
use App\User;
use App\AgregarInsumo;

class insumosController extends Controller
{

    public function ingresarInsumos(Request $request){
        $usuarioId = session('idUsuario');
        $usuario = User::where('sipa_usuarios_identificacion',$usuarioId)->get()[0];
        $insumo = new Insumos();
        $numero = Str::random();
        //dd($numero);
        $nombre = $request->input('nombreInsumos');
        $nombreArray =  explode(' ', $nombre);
        $iniNombre = '';
        foreach($nombreArray as $name){
            $nom = Str::substr($name, 0, 2); 
            $iniNombre = $iniNombre.$nom;
        }
        $cantidad = $request->input('cantidadInsumos');
        $precioString = $request->input('costoUnitarioInsumos');
        $precioUnitario = (int)str_replace(',','',Str::before(trim($precioString, "₡"),'.'));
        $precio = $precioUnitario * $cantidad;
        $codigo = $iniNombre.$numero;
        $insumo->sipa_insumos_nombre=$nombre;
        $insumo->sipa_insumos_codigo = $codigo;
        $insumo->sipa_insumos_cant_exist = $cantidad;
        $insumo->sipa_insumos_descrip = $request->input('descripcionInsumos');
        $insumo->sipa_insumos_costo_uni = $precioString;
        $insumo->sipa_insumos_costo_total = "₡".number_format($precio, 2);

        $formulario = $request->file('documentoInsumos');
        $form = $formulario->getRealPath();
        $contForm = file_get_contents($form);
        $form2 = base64_encode($contForm);
        $originalName = $formulario->getClientOriginalName();
        $nombre = pathinfo($originalName, PATHINFO_FILENAME);
        $tipoform = $formulario->getClientOriginalExtension();

        $insumo->sipa_insumo_comprobante = $form2;
        $insumo->sipa_insumo_com_nombre = $nombre;
        $insumo->sipa_insumo_com_tipo = $tipoform;
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
                $insumoAsignado =  explode('-', $insumo);
                $nombre = $insumoAsignado[0];
                $cantidad = (int)$insumoAsignado[1];
                $insumoR = Insumos::where('sipa_insumos_nombre',$nombre)->get()[0];
                $cantidadExistencia = $insumoR->sipa_insumos_cant_exist;
                $precioUnitario = (int)str_replace(',','',Str::before(trim($insumoR->sipa_insumos_costo_uni, "₡"),'.'));
                $precioTotal = (int)str_replace(',','',Str::before(trim($insumoR->sipa_insumos_costo_total, "₡"),'.'));
                
                $cantNueva = $cantidadExistencia - $cantidad;
                $precioDisminuir = $precioUnitario * $cantidad;
                $nuevoPrecio = $precioTotal - $precioDisminuir;
                //"₡".number_format($nuevoPrecioTotal, 2);
                $insumoR->update([
                    'sipa_insumos_cant_exist' => $cantNueva,
                    'sipa_insumos_costo_total' => "₡".number_format($nuevoPrecio,2),
                ]);
                $entregaInsumo = new AsignarInsumo();
                $entregaInsumo->sipa_entrega_insumo = $insumoR->sipa_insumos_id;
                $entregaInsumo->sipa_usuario_responsable = $encargado->sipa_usuarios_id;
                $entregaInsumo->sipa_usuario_asignado = $idFuncionario;
                $entregaInsumo->sipa_entrega_cantidad = $cantidad;
                $entregaInsumo->sipa_entrega_observacion = $observacion;

                $entregaInsumo->save();
            }

            return $data = [
                'respuesta'=> 'Exito',
            ];
        }else{
            return $data = [
                'respuesta'=> 'Error',
            ];
        }
    }

    public function borrarInsumo(Request $request){
        $id = $request->input('activoId');
        $activo = Insumos::find($id);
        $activo->delete();
        
        return view('inventario/insumos');
    }

    public function agregarInsumos(Resquest $request){
        $usuarioId = session('idUsuario');
        $usuario = User::where('sipa_usuarios_identificacion',$usuarioId)->get()[0];
        $insumoId =  $request->input('insumoIdA');
        $cantidadAumentar = $request->input('cantidaInsumo');
        $numComprobante = $request->input('numComprobante');
        $insumoTipo = $request->input('insumoTipo');
        $insumoDescripcion = $request->input('info_input');
        //comprobante
        $factura = $request->file('imagenAct');
        $comprobante = $factura->getRealPath();
        $contenido = file_get_contents($comprobante);
        $comprobante2 = base64_encode($contenido);
        $originalName = $formulario->getClientOriginalName();
        $nombre = pathinfo($originalName, PATHINFO_FILENAME);
        $tipo = $fact->getClientOriginalExtension();

        $insumoAgregar = Insumos::where('sipa_insumos_id',$insumoId)->get()[0];
        $cantInventario = $insumoAgregar->sipa_insumos_cant_exist;
        
        $precioUnitario = (int)str_replace(',','',Str::before(trim($insumoAgregar->sipa_insumos_costo_uni, "₡"),'.'));
        $precioTotal = (int)str_replace(',','',Str::before(trim($insumoAgregar->sipa_insumos_costo_total, "₡"),'.'));

        $nuevoCantidad = $cantInventario + $cantidadAumentar;
        $precioAgregar = $cantAunment * $precioUnitario;
        $nuevoPrecio = $precioAgregar + $precioTotal;
        $insumoAgregar->update(['sipa_insumos_cant_exist' => $nuevoCantidad,
                                'sipa_insumos_costo_total' => "₡".number_format($nuevoPrecio,2)]);

        $agregar = new AgregarInsumo();

        $agregar->sipa_ingreso_numero_documento = $numComprobante;
        $agregar->sipa_ingreso_insumo = $insumoId;
        $agregar->sipa_ingreso_insumo_cantidad = $cantidadAumentar;
        $agregar->sipa_ingreso_documento = $comprobante2;
        $agregar->sipa_ingreso_nombre_doc = $nombre;
        $agregar->sipa_ingreso_tipo = $tipo;
        $agregar->sipa_ingreso_descripcion = $insumoDescripcion;
        $agregar->sipa_ingreso_tipo = $insumoTipo;
        $agregar->sipa_ingresado_por = $usuario->sipa_usuarios_id;

        $agregar->save();

        return view('inventario/insumos');

       
    }

    public function existeNomInsumo($nombre){
        $insumo = Insumos::where('sipa_insumos_nombre',$nombre)->count();

        if($insumo > 0){
            return $data = [
                'respuesta'=> 'Existe',
            ];
        }else{
            return $date =[
                'repuesta' =>$nombre,
            ];
        }
    }
}
