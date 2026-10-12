<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $response = Http::api()->post('/login', $request->only('email', 'password'));

        if ($response->failed()) {
            return back()->with('error', 'Hibás email vagy jelszó.');
        }

        session(['api_token' => $response->json('token')]);

        return redirect()->route('dashboard');
    }

    public function logout()
    {
        session()->forget('api_token');

        return redirect()->route('login');
    }
}
