<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Activo;
use App\User;
use App\Edifico;
use App\Unidad;
use App\EstadoActivo;

class menusController extends Controller
{
    function inicio(){
        return view('menus.modulos');
    }

    function configuraciones(){
        return view('menus.configuraciones');
    }

    function reservas(){
        return view('menus.reservas');
    }

    function inventarioEnUso(){
        return view('menus.enUso');
    }

    function historiales(){
        return view('menus.historial');
    }

    function entregas(){
        return view('menus.entregas');
    }

    function devoluciones(){
        return view('menus.devoluciones');
    }

    function inventario(){
        return view('menus.inventario');
    }

    function reservaEquipo(){
        $activos = Activo::all();
        return view('activos.reservar')->with('activos', $activos);
    }

    function reservaSala(){
        return view('salas.reservaSalas');
    }

    function inventarioEnUsoSala(){
        return view('enUso.sala');
    }

    function inventarioEnUsoEquipo(){
        return view('enUso.equipo');
    }

    function inventarioEnUsoAsignaciones(){
        return view('enUso.asignaciones');
    }

    function inventarioEnUsoFormulario(){
        return view('enUso.formularios');
    }

    function historialSalas(){
        return view('historial.salas');
    }

    function historialEquipo(){
        return view('historial.equipos');
    }

    function entregaSalas(){
        return view('menus.entregasSalas');
    }

    function entregaSalasAnticipadas(){
        return view('entregas.salasAnticipadas');
    }

    function entregaSalasRapidas(){
        return view('entregas.salasRapidas');
    }

    function entregaEquipos(){
        return view('menus.entregasEquipos');
    }

    function entregaEquiposAnticipados(){
        return view('entregas.equiposAnticipados');
    }

    function entregaEquiposRapidos(){
        return view('entregas.equiposRapidos');
    }

    function devolucionesSalas(){
        return view('devoluciones.salas');
    }

    function devolucionesEquipos(){
        return view('devoluciones.equipos');
    }

    function inventarioSalas(){
        return view('inventario.salas');
    }

    function inventarioEquipos(){
        $activos = Activo::all();
        $usuarios = User::all();
        $edificios = Edifico::all();
        $seleccionado = $edificios->get(0);
        $unidades = Unidad::where('sipa_edificios_unidades_edificio',$seleccionado->id);
        $estados = EstadoActivo::orderBy('sipa_estado_activo_orden', 'ASC')->get();
        return view('inventario.activos')->with('activos', $activos)
                                        ->with('usuarios', $usuarios)
                                        ->with('edificios', $edificios)
                                        ->with('seleccionado', $seleccionado)
                                        ->with('unidades', $unidades)
                                        ->with('estados', $estados);
    }

    function inventarioInsumos(){
        return view('insumos.insumos');
    }

    function configuracionesRoles(){
        return view('configuraciones.roles');
    }

    function configuracionesUsuarios(){
        return view('configuraciones.usuarios');
    }

    function configuracionesTiposDeUsuario(){
        return view('configuraciones.tiposDeUsuaio');
    }

    function configuracionesCorreos(){
        return view('configuraciones.cuerpoCorreos');
    }

    function verEquipos($id){
        $activo = Activo::find($id);
        return view('activos.ver')->with('activo', $activo);
    }
}
