<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cita;
use Carbon\Carbon;
use App\Mail\CitaCreada;
use App\Mail\CitaAceptada;
use App\Mail\CitaCancelada;
use Illuminate\Support\Facades\Mail;

class CitaController extends Controller
{
    public function create()
    {
        return view('agendarCita');
    }

    public function store(Request $request)
    {
        $hoy      = Carbon::today();
        $fechaMax = Carbon::today()->addMonths(5);

        $request->validate([
            'especialidad' => 'required|string',
            'fecha'        => 'required|date|after_or_equal:' . $hoy->format('Y-m-d') . '|before_or_equal:' . $fechaMax->format('Y-m-d'),
            'hora'         => 'required|date_format:H:i|after_or_equal:08:00|before_or_equal:21:00',
        ], [
            'especialidad.required'  => '*La especialidad es obligatoria.',
            'fecha.required'         => '*La fecha es obligatoria.',
            'fecha.after_or_equal'   => '*La fecha debe ser hoy o una fecha futura.',
            'fecha.before_or_equal'  => '*Solo puedes agendar citas hasta 5 meses a partir de hoy (' . $fechaMax->format('d/m/Y') . ').',
            'hora.required'          => '*La hora es obligatoria.',
            'hora.date_format'       => '*El formato de hora no es válido.',
            'hora.after_or_equal'    => '*La hora mínima es 8:00 AM.',
            'hora.before_or_equal'   => '*La hora máxima es 9:00 PM.',
        ]);

        if (Carbon::parse($request->fecha)->isSameDay($hoy)) {
            $horaActual    = Carbon::now()->format('H:i');
            $horaSeleccion = $request->hora;

            if ($horaSeleccion <= $horaActual) {
                return back()->withInput()->withErrors([
                    'hora' => 'Para el día de hoy debes elegir una hora posterior a la hora actual (' . Carbon::now()->format('H:i') . ').',
                ]);
            }
        }

        $horaDeseada = Carbon::parse($request->fecha . ' ' . $request->hora);
        $horaMin     = $horaDeseada->copy()->subHour();
        $horaMax     = $horaDeseada->copy()->addHour();

        $citaExistente = Cita::where('fecha', $request->fecha)
            ->whereIn('estado', ['pendiente', 'aceptada'])
            ->get()
            ->first(function ($cita) use ($horaMin, $horaMax, $request) {
                $horaCita = Carbon::parse($request->fecha . ' ' . $cita->hora);
                return $horaCita->between($horaMin, $horaMax)
                    && !$horaCita->equalTo(Carbon::parse($request->fecha . ' ' . $request->hora)->subHour())
                    && !$horaCita->equalTo(Carbon::parse($request->fecha . ' ' . $request->hora)->addHour());
            });

        if ($citaExistente) {
            $horaOcupada  = Carbon::parse($request->fecha . ' ' . $citaExistente->hora);
            $horaSugerida = $horaOcupada->copy()->addHour()->format('H:i');

            return back()->withInput()->withErrors([
                'hora' => "Ya existe una cita a las {$horaOcupada->format('H:i')}. Puedes agendar tu cita a partir de las {$horaSugerida}.",
            ]);
        }

        $cita = Cita::create([
            'user_id'      => auth()->id(),
            'fecha'        => $request->fecha,
            'hora'         => $request->hora,
            'especialidad' => $request->especialidad,
            'estado'       => 'pendiente',
        ]);

        Mail::to(auth()->user()->email)->send(new CitaCreada($cita, auth()->user()));

        return redirect()->route('citas.agendarCita')->with('success', '¡Cita agendada correctamente! Te llegará un correo de confirmación.');
    }

    public function index()
    {
        $citas = Cita::with('user')->orderBy('fecha')->get();
        return view('admin.citas', compact('citas'));
    }

    public function aceptar($id)
    {
        $cita = Cita::with('user')->findOrFail($id);
        $cita->update(['estado' => 'aceptada']);

        Mail::to($cita->user->email)->send(new CitaAceptada($cita, $cita->user));

        return redirect()->route('admin.citas')->with('success', 'Cita aceptada.');
    }

    public function cancelar($id)
    {
        $cita = Cita::with('user')->findOrFail($id);
        $cita->update(['estado' => 'cancelada']);

        Mail::to($cita->user->email)->send(new CitaCancelada($cita, $cita->user));

        return redirect()->route('admin.citas')->with('success', 'Cita cancelada.');
    }
}