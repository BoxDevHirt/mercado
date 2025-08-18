<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('Auth.pages.login');
    }

    public function post(Request $request)
    {
        $validated = $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required|string',
            ],
            [
                'email' => 'O email é obrigatório',
                'password' => 'A senha é obrigatório',
            ]
        );

        if (Auth::attempt($validated)) {
            return redirect()->intended('admin');
        }

        return back()->withErrors(['', 'Credenciais invalidas'])->onlyInput('user');
    }
}
