<?php

namespace App\Http\Controllers;

use App\Models\InvitationCode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use function Symfony\Component\Clock\now;

class RegisterController extends Controller
{
    function index(InvitationCode $invitation_code) {

        $username = $invitation_code->owner()->first()->name;

        return view('auth.signup-terms')->with([
            'username' => $username,
            'code' => $invitation_code->code
        ]);
    }

    function accept(Request $request){
        $validated = $request->validate([
            'terms' => 'required',
            'code' => 'required'
        ]);

        return redirect()->route('signup-account', ['invitation_code' => $validated['code']]);;
    }

    function register(Request $request, InvitationCode $invitation_code){
        $username = $invitation_code->owner()->first()->name;

        return view('auth.signup-account')->with([
            'username' => $username,
            'code' => $invitation_code->code
        ]);
    }

    function create(Request $request, InvitationCode $invitation_code){

        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);


        $user = User::create([
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'name' => fake()->name()
        ]);

        $invitation_code->markAsConsumed($user);

        $user->generateCodes();

        Auth::login($user);


        return redirect()->route('home');
    }
}
