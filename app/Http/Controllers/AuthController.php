<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function registerUser(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|min:3|max:50',
            'apellido' => 'required|string|min:5|max:50',
            'tipo_id' => 'required|string',
            'numero_id' => 'required|string|min:10|max:10',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#])[A-Za-z\d@$!%*?&#]{8,}$/',
        ], [
            'nombre.required'    => '*El nombre es obligatorio.',
            'nombre.max'         => '*El nombre es demasiado largo.',
            'nombre.min'         => '*El nombre debe tener minimo 3 caracteres.',
            'apellido.required'  => '*El apellido es obligatorio.',
            'apellido.max'       => '*El apellido es demasiado largo.',
            'apellido.min'       => '*El apellido debe tener minimo 5 carateres.',
            'tipo_id.required'   => '*Selecciona un tipo de identificación.',
            'numero_id.required' => '*El número de identificación es obligatorio.',
            'numero_id.min'      => '*El numero de identificacion debe tener minimo 10 caracteres.',
            'numero_id.max'      => '*El número de identificación es demasiado largo.',
            'email.required'     => '*El correo es obligatorio.',
            'email.email'        => '*El correo no es válido, Ej: usuario@gmail.com',
            'email.unique'       => '*Este correo ya está registrado.',
            'password.required'  => '*La contraseña es obligatoria.',
            'password.min'       => '*La contraseña debe tener mínimo 8 caracteres.',
            'password.regex'     => '*La contraseña debe tener mayúscula, minúscula, número y símbolo.',
            'password.confirmed' => '*Las contraseñas no coinciden.'
        ]);

        $user = User::create([
            'nombre'    => $request->nombre,
            'apellido'  => $request->apellido,
            'tipo_id'   => $request->tipo_id,
            'numero_id' => $request->numero_id,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
        ]);
        $user->assignRole('user');
        return redirect()->route('iniciarSesion');
    }
}
