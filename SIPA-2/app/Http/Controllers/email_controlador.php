<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
class email_controlador extends Controller
{
    function index(){
        return view('testing_send_email');

    }
    function send(Request $req){
        session(['idUsuario' => '116570271']);
        $cedula = session('idUsuario');
        $usuarioLoggeado = User::where('sipa_usuarios_identificacion',$cedula)->get()[0];
        $this-> validate( $req, [
            'content'=>'required'
        ]);
        $data = array(
            'name'=>$usuarioLoggeado->sipa_usuarios_nombre,
            'correoSistema'=>env('MAIL_USERNAME'),
            'subject'=>'subject que corresponda',
            'view'=>'dynamic_email_template',
            'content'=>$req->content
        );
        
       
        Mail::to($usuarioLoggeado->sipa_usuarios_correo)->send(new SendMail($data));
        return back()->with('success','todo good');
    }
}