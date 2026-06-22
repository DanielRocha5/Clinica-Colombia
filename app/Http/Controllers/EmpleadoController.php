<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;
use Twilio\Rest\Client;

class EmpleadoController extends Controller
{
    public function index()
    {
        $empleados = Empleado::orderBy('created_at', 'desc')->get();
        return view('admin.empleados', compact('empleados'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'    => 'required|string|min:3|max:50',
            'apellido'  => 'required|string|min:3|max:50',
            'tipo_id'   => 'required|string',
            'numero_id' => 'required|string|min:10|max:10|unique:empleados',
            'cargo'     => 'required|string',
            'email'     => 'required|email|unique:empleados',
            'telefono'  => 'required|string|min:10|max:10',
        ], [
            'nombre.required'    => '*El nombre es obligatorio.',
            'nombre.min'         => '*El nombre debe tener mínimo 3 caracteres.',
            'apellido.required'  => '*El apellido es obligatorio.',
            'apellido.min'       => '*El apellido debe tener mínimo 3 caracteres.',
            'tipo_id.required'   => '*Selecciona un tipo de identificación.',
            'numero_id.required' => '*El número de identificación es obligatorio.',
            'numero_id.min'      => '*El número debe tener 10 dígitos.',
            'numero_id.unique'   => '*Este número de identificación ya está registrado.',
            'cargo.required'     => '*El cargo es obligatorio.',
            'email.required'     => '*El correo es obligatorio.',
            'email.email'        => '*El correo no es válido.',
            'email.unique'       => '*Este correo ya está registrado.',
            'telefono.required'  => '*El teléfono es obligatorio.',
            'telefono.min'       => '*El teléfono debe tener 10 dígitos.',
        ]);

        $empleado = Empleado::create($request->all());

        try {
            $twilio  = new Client(env('TWILIO_SID'), env('TWILIO_TOKEN'));
            $numero  = 'whatsapp:+57' . ltrim($empleado->telefono, '0');

            $twilio->messages->create($numero, [
                'from' => env('TWILIO_WHATSAPP_FROM'),
                'body' =>
                    "━━━━━━━━━━━━━━━━━━━━━━━━━\n" .
                    "🏥 *CLÍNICA COLOMBIA*\n" .
                    "━━━━━━━━━━━━━━━━━━━━━━━━━\n\n" .
                    "👋 ¡Hola, *{$empleado->nombre} {$empleado->apellido}*!\n\n" .
                    "Has sido registrado oficialmente como parte de nuestro equipo médico.\n\n" .
                    "━━━━━━━━━━━━━━━━━━━━━━━━━\n" .
                    "📋 *TUS DATOS*\n" .
                    "━━━━━━━━━━━━━━━━━━━━━━━━━\n" .
                    "👤 *Nombre:* {$empleado->nombre} {$empleado->apellido}\n" .
                    "💼 *Cargo:* {$empleado->cargo}\n" .
                    "🪪 *Documento:* {$empleado->tipo_id} {$empleado->numero_id}\n" .
                    "📧 *Correo:* {$empleado->email}\n\n" .
                    "━━━━━━━━━━━━━━━━━━━━━━━━━\n" .
                    "💙 ¡Bienvenido al equipo!\n" .
                    " _Clínica Colombia_\n" .
                    "━━━━━━━━━━━━━━━━━━━━━━━━━",
            ]);
        } catch (\Exception $e) {
        }

        return redirect()->route('admin.empleados')->with('success', 'Empleado creado correctamente. Se envió un mensaje de WhatsApp.');
    }

    public function edit($id)
    {
        $empleado = Empleado::findOrFail($id);
        return view('admin.empleados-edit', compact('empleado'));
    }

    public function update(Request $request, $id)
    {
        $empleado = Empleado::findOrFail($id);

        $request->validate([
            'nombre'    => 'required|string|min:3|max:50',
            'apellido'  => 'required|string|min:3|max:50',
            'tipo_id'   => 'required|string',
            'numero_id' => 'required|string|min:10|max:10|unique:empleados,numero_id,' . $id,
            'cargo'     => 'required|string',
            'email'     => 'required|email|unique:empleados,email,' . $id,
            'telefono'  => 'required|string|min:10|max:10',
        ], [
            'nombre.required'    => '*El nombre es obligatorio.',
            'nombre.min'         => '*El nombre debe tener mínimo 3 caracteres.',
            'apellido.required'  => '*El apellido es obligatorio.',
            'apellido.min'       => '*El apellido debe tener mínimo 3 caracteres.',
            'tipo_id.required'   => '*Selecciona un tipo de identificación.',
            'numero_id.required' => '*El número de identificación es obligatorio.',
            'numero_id.min'      => '*El número debe tener 10 dígitos.',
            'numero_id.unique'   => '*Este número de identificación ya está registrado.',
            'cargo.required'     => '*El cargo es obligatorio.',
            'email.required'     => '*El correo es obligatorio.',
            'email.email'        => '*El correo no es válido.',
            'email.unique'       => '*Este correo ya está registrado.',
            'telefono.required'  => '*El teléfono es obligatorio.',
            'telefono.min'       => '*El teléfono debe tener 10 dígitos.',
        ]);

        $empleado->update($request->except(['_token', '_method', 'id']));

        try {
            $twilio = new Client(env('TWILIO_SID'), env('TWILIO_TOKEN'));
            $numero = 'whatsapp:+57' . ltrim($empleado->telefono, '0');

            $twilio->messages->create($numero, [
                'from' => env('TWILIO_WHATSAPP_FROM'),
                'body' =>
                    "━━━━━━━━━━━━━━━━━━━━━━━━━\n" .
                    "🏥 *CLÍNICA COLOMBIA*\n" .
                    "━━━━━━━━━━━━━━━━━━━━━━━━━\n\n" .
                    "👋 ¡Hola, *{$empleado->nombre} {$empleado->apellido}*!\n\n" .
                    "✅ Tus datos fueron actualizados correctamente en nuestro sistema.\n\n" .
                    "━━━━━━━━━━━━━━━━━━━━━━━━━\n".
                    "Para ver tus datos actuales ingresa al sistema para verificarlos".
                    "━━━━━━━━━━━━━━━━━━━━━━━━━\n" .
                    "💙 _Clínica Colombia_\n" .
                    "━━━━━━━━━━━━━━━━━━━━━━━━━",
            ]);
        } catch (\Exception $e) {
        }

        return redirect()->route('admin.empleados')->with('success', 'Empleado actualizado correctamente. Se envió un mensaje de WhatsApp.');
    }

    public function destroy($id)
    {
        $empleado = Empleado::findOrFail($id);

        try {
            $twilio = new Client(env('TWILIO_SID'), env('TWILIO_TOKEN'));
            $numero = 'whatsapp:+57' . ltrim($empleado->telefono, '0');

            $twilio->messages->create($numero, [
                'from' => env('TWILIO_WHATSAPP_FROM'),
                'body' =>
                    "━━━━━━━━━━━━━━━━━━━━━━━━━\n" .
                    "🏥 *CLÍNICA COLOMBIA*\n" .
                    "━━━━━━━━━━━━━━━━━━━━━━━━━\n\n" .
                    "👋 Hola, *{$empleado->nombre} {$empleado->apellido}*.\n\n" .
                    "Te informamos que a partir de hoy ya no formas parte de nuestro equipo de trabajo.\n\n" .
                    "━━━━━━━━━━━━━━━━━━━━━━━━━\n" .
                    "💙 _Clínica Colombia_\n" .
                    "━━━━━━━━━━━━━━━━━━━━━━━━━",
            ]);
        } catch (\Exception $e) {
        }

        $empleado->delete();

        return redirect()->route('admin.empleados')->with('success', 'Empleado eliminado correctamente. Se envió un mensaje de WhatsApp.');
    }
}