<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Usuario;
use App\Services\AdminServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function index(){
        return view('login.index');
    }

    public function store(Request $request){

        $admin = new AdminServices(
            $request->email,
            $request->password
        );

        $admin->createAdminUser();

        if(!Auth::attempt($request->only(['email','password']))){
            return redirect()->back()->withInput()->withErrors(['Email ou Senha invalida']);
        }

        return to_route('welcome');
}

    public function destroy(){

        Auth::logout();

        return to_route('login');
    }
}
