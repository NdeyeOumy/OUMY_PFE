<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    
    //login form
    public function loginForm(){
        //Check if user is logged in
        if(Auth::check()){
            return redirect(route('bo.dashboard'));
        }
        return view ('auth.login');
    }

    public function loginAuth(Request $request) {
        $this->validate($request, [
            'username' =>'required',
            'password' => 'required',
        ]);
       // dd($request->all());

       $credentials = $request->only('username', 'password');
       if(Auth::guard()->attempt($credentials)) {
        return redirect(route('bo.dashboard'));
       } else {
        return redirect(route('bo.auth'))->with('error_msg', "Nom d'utilisateur ou Mot de passe incorrecte");
       }
    }


    public function logout() {
        Session::flush();
        Auth::guard()->logout();
        return redirect(route('bo.auth'));

    }

}
