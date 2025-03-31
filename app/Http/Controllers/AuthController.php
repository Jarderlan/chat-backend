<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    private $req;
    private $model;
    public function __construct(Request $req)
    {
        $this->middleware('auth:sanctum')->except(['login']);
        $this->req = $req;
    }

    public function login()
    {
        $credentials = $this->req->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = $this->req->user();
            $token = $user->createToken('auth-token')->plainTextToken;

            return response()->json(['access_token' => $token, 'type' => 'Bearer', 'mensagem' => 'sucesso'], 200);
        }

        return response()->json(['dados' => [], 'mensagem' => 'usuário ou senha inválidos'], 401);
    }

    public function logout()
    {
        $user = auth()->user();
        $user->tokens()->delete();
        return response()->json(['dados' => [], 'mensagem' => 'deslogado com sucesso'], 200);
    }

    public function profile()
    {
        $user = auth()->user();
        return response()->json(['dados' => $user, 'mensagem' => 'sucesso'], 200);
    }
}
