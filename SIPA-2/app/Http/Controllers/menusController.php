<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class menusController extends Controller
{
    function inicio(){
        return view('activos/editar');
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

    function historialesSalas(){
        return view('menus.historialSalas');
    }

    function historialesEquipos(){
        return view('menus.historialEquipos');
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
}
