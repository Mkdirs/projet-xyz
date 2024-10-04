<?php

namespace App\Http\Controllers;

use App\Models\InvitationCode;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    function index(InvitationCode $code) {

        $username = $code->owner()->getRelated()->username;

        return view('auth.signup-terms')->with([
            'username' => $username
        ]);
    }

    function accept(Request $request){
        return view('auth.signup-account');
    }
}
