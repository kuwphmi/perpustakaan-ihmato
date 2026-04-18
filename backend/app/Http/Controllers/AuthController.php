<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
   public function login(Request $request)
{
    if ($request->email == 'admin@gmail.com' && $request->password == '123') {

        session([
            'user' => [
                'nama' => $request->nama,
                'tgl_lahir' => $request->tgl_lahir,
                'jk' => $request->jk,
                'no_hp' => $request->no_hp,
                'email' => $request->email
            ]
        ]);

        return redirect('/profile');
    }

    return back()->with('error', 'Email atau password salah');
}

    public function logout()
    {
        session()->forget('user');
        return redirect('/login');
    }
}