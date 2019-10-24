<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class menusController extends Controller
{
    function inicio(){
        return view('menus.principal');
    }

    function configuraciones(){
        return view('menus.configuraciones');
    }

    function reservas(){
        return view('menus.reserva');
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
        return view('activos.reservaActivos');
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
        return view('entregas.salas');
    }

    function entregaSalasAnticipadas(){
        return view('entregas.salasAnticipadas');
    }

    function entregaSalasRapidas(){
        return view('entregas.salasRapidas');
    }

    function entregaEquipos(){
        return view('entregas.equipos');
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
        return view('salas.salas');
    }

    function inventarioEquipos(){
        return view('activos.activos');
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
}
