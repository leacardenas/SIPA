<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class LoginLdapController extends Controller
{
    public function com(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);
       
        $username = $request->input('username');
        $password = $request->input('password');
        $user = User::where('sipa_usuarios_identificacion',$username)->get()[0];
        if(static::LDAP($username,$password)){
           
            return view('logged')->with('username',$user->name);
        }
        
    }
    private static function LDAP($id,$contrasenna){
        return true;
    }
}
