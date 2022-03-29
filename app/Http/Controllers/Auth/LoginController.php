<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\User;


class LoginController extends Controller
{
    public function index()
    {
        Auth::logout();
        return view("admin.auth.login");
    }

    public function signin(Request $request)
    {
        Auth::logout();
        $this->validate($request, [
            'email'    => 'required|email',
            'password' => 'required'
        ]);
        $credentials = $request->only('email', 'password');
        if (User::where("email", $credentials["email"])->count() > 0) {
            if (Auth::attempt($credentials, (@$request['remember'] ? true : false))) {
                return ["success" => true, "route" => '/admin'];
            }
        }
        return ["success" => false, "message" => "Credenciais inválidas"];
    }
}
