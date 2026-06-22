<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:8',
        ], [
            'email.required' => '*El correo es obligatorio.',
            'password.required' => '*La contraseña es obligatoria.'
        ]);

        $credenciales = $request->only('email', 'password');

        if (Auth::attempt($credenciales)) {
            $request->session()->regenerate();
            $user = Auth::user();

            if ($user->hasRole('admin')) {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('user.dashboard');
            }
        }

        return back()->withErrors([
            'email' => 'El correo o la contraseña son incorrectos.',
        ])->onlyInput('email');
    }
}
