<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        if ($user = Auth::user()) {
            if ($user->level == '1') {
                return redirect()->intended('parrent');
            } elseif ($user->level == '2') {
                return redirect()->intended('pengadilan');
            } elseif ($user->level == '3') {
                return redirect()->intended('petugas');
            }
        }

        return view('login.view_login');
    }

    public function proses(Request $r)
    {
        $r->validate(
            [
                'username' => 'required',
                'password' => 'required'
            ],
            [
                'username.required' => 'Username tidak boleh kosong',
                'password.required' => 'Password tidak boleh kosong'
            ]
        );

        $kredensial = $r->only('username', 'password');

        if (Auth::attempt($kredensial)) {
            $r->session()->regenerate();
            $user = Auth::user();
            if ($user->level == '1') {
                return redirect()->intended('parrent');
            } elseif ($user->level == '2') {
                return redirect()->intended('pengadilan');
            } elseif ($user->level == '3') {
                return redirect()->intended('petugas');
            }
        }

        return back()->withErrors([
            'username' => 'Maaf Username atau Password salah'
        ])->onlyInput('username');
    }

    public function logout(Request $r)
    {
        Auth::logout();
        $r->session()->invalidate();
        $r->session()->regenerateToken();

        return redirect('login');
    }
}
