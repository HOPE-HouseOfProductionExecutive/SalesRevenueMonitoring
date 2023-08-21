<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request) {
        $request-> validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        $credential = $request->only('email', 'password');
        $user = User::where(['email' => $request->email])->first();

        if(Auth::attempt($credential)) {
            Auth::login($user);
            return redirect('/');
        }
        return redirect()->back();
    }


    public function register(Request $request) {
        
    }

}
