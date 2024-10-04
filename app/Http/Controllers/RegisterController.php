<?php

namespace App\Http\Controllers;

use App\Models\InvitationCode;
use App\Models\User;
use Illuminate\Http\Request;
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



        $user = new User;

        $user->email = 'toto@mail.com';//$validated['email'];
        $user->password = Hash::make($validated['password']);
        $user->name = fake()->name();
        $user->save();

        $invitation_code->consumer_id = $user;
        $invitation_code->consumed_at = now();

        $user->generate_codes();

        

        return redirect('/login');
    }
}
