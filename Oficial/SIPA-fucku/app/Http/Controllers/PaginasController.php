<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaginasController extends Controller
{
    public function index(){
        $title = 'INDEX PAGE';
        return view('pages.index')->with('title',$title);
    }

    public function dashboard(){
        return view('pages.dashboard');
    }

    public function roles(){
        $data = array(
            'title' => 'ROLES PAGE',
        );
        return view('pages.entidades.roles_index')->with($data);
    }
}
