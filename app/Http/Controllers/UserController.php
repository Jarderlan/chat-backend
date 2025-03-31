<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    private $req;
    private $model;
    public function __construct(Request $req, User $user)
    {
        $this->middleware('auth:sanctum')->except(['store']);
        $this->req   = $req;
        $this->model = $user;
    }

    public function index()
    {
        $dados = $this->model::all();
        return response()->json(['dados' => $dados, "mensagem" => "suceso"], 200);
    }

    public function store()
    {
        $dados = $this->model->create([
            'name'     => $this->req->name,
            'email'    => $this->req->email,
            'password' => Hash::make($this->req->password)
        ]);
        return response()->json(['dados' => $dados, "mensagem" => "suceso"], 201);
    }

    public function show($id)
    {
        $dados = $this->model->findOrFail($id);
        return response()->json(['dados' => $dados, "mensagem" => "suceso"], 200);
    }

    public function update($id)
    {
        $dados = $this->model->find($id);
        $dados->fill($this->req->all());
        $dados->save();
        return response()->json(['dados' => $dados, "mensagem" => "suceso"], 200);
    }

    public function destroy($id)
    {
        $dados = $this->model->find($id);
        $dados->delete();
        return response()->json(['dados' => [], "mensagem" => "suceso"], 200);
    }
}
