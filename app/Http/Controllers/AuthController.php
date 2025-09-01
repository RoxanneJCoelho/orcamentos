<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // mostra a página do login
    public function showLogin(){
        return view('auth.login');
    }

    // valida o login e atira para a página espaço admin
    public function login(Request $request)
    {
       $validated=$request->validate([
            'email'=>'required|email',
            'password'=>'required|string'
        ]);

        if(Auth::attempt($validated)){
            $request->session()->regenerate();

            return redirect()->route('show.admin');
        }

        throw ValidationException::withMessages([
            'credentials' => 'Login inválido'
        ]);
    }

    // faz o logout e atira para a homepage
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('show.homepage');

    }

    public function showPasswordRecovery()
    {
        return view('auth.password-recovery');
    }

}
