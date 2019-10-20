<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
class email_controlador extends Controller
{
    function index(){
        return view('testing_send_email');

    }
    function send(Request $req){
        $this-> validate( $req, [
            'name'=>'required',
            'email'=>'required|email',
            'content'=>'required'
        ]);
        $data = array(
            'name'=>$req->name,
            'content'=>$req->content

        );
        Mail::to('bryangarroeduarte@gmail.com')->send(new 
            SendMail($data)
        );
        return back()->with('success','thanks for contacting us');
    }
}
