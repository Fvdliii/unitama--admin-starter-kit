<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

public function index()
    {
        return view('login.index',[
            'title' => 'Login',
        ]);
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return to_route('dashboard.index')->withSuccess('Login Berhasil');
        }

        return back()->withError('Email atau Password salah')->onlyInput('email');
    }
}