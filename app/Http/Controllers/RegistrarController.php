<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegistrarController extends Controller
{

    public function create()
    {
        return view('login.create');
    }

    public function store(Request $request)
    {
        $data = $request->except(['_token']);
        $data['password'] = Hash::make($data['password']);

        $user = User::create($data); // ✅ Salva e armazena o usuário na variável
        Auth::login($user);   // ✅ Agora sim o usuário pode ser autenticado


        return to_route('usuario.index');
    }

    public function destroy(){
        Auth::logout();

        return to_route('login');
    }
}
