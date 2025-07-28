<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function index(){
        return view('login.index');
    }

    public function store(Request $request){ //only passa somente as credenciais necessarias para fazer o login, tirando aquele CSRF de token.
         if(!Auth::attempt($request->only(['email','password']))){
            return redirect()->back()->withInput()->withErrors(['Email ou Senha invalida']);
        }

        return to_route('usuario.index');
    }

    public function destroy(){

        Auth::logout();

        return to_route('login');
    }
}
