<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    function index() {

        return view('auth.login');
    }

    function login(Request $request){


        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $validator->validate();

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->route('home');
        
        }else{
            return back()->withErrors([
                'email' => 'Nous ne reconnaissons pas cet identifiant'
            ])->onlyInput('email');
        }

        
        return redirect('/login')->withErrors($validator);
        
    }

    function logout(Request $request){
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return back();
    }
}
