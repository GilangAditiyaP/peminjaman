<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Login;

class LoginController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function register()
    {
        return view('register');
    }
    public function store(Request $request)
    {
     $register = Login::create([
            'username' => $request->username,
            'password' => $request->password,
            'email' => $request->email
        ]);
        return redirect('/login')->with('success', 'Akun berhasil dibuat. Silakan login.');
    }
}
