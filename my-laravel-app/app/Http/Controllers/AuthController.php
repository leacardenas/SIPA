<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class AuthController extends Controller {

    public function ldapLogin() {

        // Validamos via LDP
        // $username = $request->username
        // $pass = $request->password_get_info
        // $loggeado = validarLdap($username, $password, $urlLdap)
        // if ($loggeado == true) {
            //return redirect('/home');
        //}
        // else {
            return view('login-exitoso');
        //}
        
    }
}