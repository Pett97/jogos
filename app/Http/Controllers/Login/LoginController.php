<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function getLogin(){
        return view('login');
    } 
    public function login(Request $request)
    {
        // Validação de entradas
        $request->validate([
            'login_email' => 'required|email',
            'login_password' => 'required',
        ]);

        if (FacadesAuth::attempt(['email' => $request->login_email, 'password' => $request->login_password])) {
            
            return redirect()->intended('/generos/lista'); 
        }
        return redirect()->route('home');
    }
}

