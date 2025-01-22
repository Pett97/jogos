<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function getLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'login_email' => 'required|email',
            'login_password' => 'required',
        ]);

        if (FacadesAuth::attempt(['email' => $request->login_email, 'password' => $request->login_password])) {
            return redirect()->intended('/generos/lista');
        }
        return redirect()->route('home');
    }

    public function apiCreateUser(Request $request): JsonResponse
    {
        $fields = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);

        $user = User::create($fields);

        $token = $user->createToken($request->name);

        return response()->json(['message' => "Usuario Criado Com sucesso", 'user' => [
            'name' => $user->name,
            'id_user' => $user->id,
            'token' => $token->plainTextToken
        ]], 200);
    }

    public function apiLoginUser(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();


        if (!$user) {
            return response()->json(['message' => 'não foi encontrado nenhum usuario com esse email '], 404);
        }

        if ($user && !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => "senha invalida para esse usuario"], 401);
        };

        $token = $user->createToken($user->name);

        return response()->json(['message' => "login realizado com sucesso", "user" => $user, "token" => $token], 200);
    }

    public function apiLogoutUser(Request $request): JsonResponse
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => "Logout Realizado com sucesso"], 201);
    }
}
