<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Services\GroqService;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function responder(Request $request, GroqService $groq)
    {
        $mensajeUsuario = $request->input('mensaje');

        $tools = [
            [
                'type' => 'function',
                'function' => [
                    'name' => 'crear_cita',
                    'description' => 'Agenda una cita médica para el usuario',
                    'parameters' => [
                        'type' => 'object',
                        'properties' => [
                            'fecha' => [
                                'type' => 'string',
                                'description' => 'Fecha en formato YYYY-MM-DD',
                            ],
                            'hora' => [
                                'type' => 'string',
                                'description' => 'Hora en formato HH:MM (24h)',
                            ],
                            'especialidad' => [
                                'type' => 'string',
                                'description' => 'Tipo de consulta, ej: consulta general, odontología, etc.',
                            ],
                        ],
                        'required' => ['fecha', 'hora', 'especialidad'],
                    ],
                ],
            ],
        ];

        $messages = [
            [
                'role' => 'system',
                'content' => 'Hoy es ' . now()->toDateString() . '. Eres el asistente virtual de Clínica Colombia. 
                            Servicios disponibles: Consulta general, Consulta de tiroides, Ecografía abdominal.
                            Ayudas a agendar citas médicas y respondes preguntas sobre estos servicios. 
                            Si el usuario no da fecha/hora/especialidad clara para agendar, pregunta antes de llamar a la función.',
            ],
            [
                'role' => 'user',
                'content' => $mensajeUsuario,
            ],
        ];

        $data = $groq->chat($messages, $tools);

        $toolCalls = $data['choices'][0]['message']['tool_calls'] ?? null;

        if ($toolCalls) {
            $toolCall = $toolCalls[0];

            if ($toolCall['function']['name'] === 'crear_cita') {
                $args = json_decode($toolCall['function']['arguments'], true);

                $cita = Cita::create([
                    'user_id' => auth()->id(),
                    'fecha' => $args['fecha'],
                    'hora' => $args['hora'],
                    'especialidad' => $args['especialidad'],
                    'estado' => 'pendiente',
                ]);

                return response()->json([
                    'respuesta' => "Tu cita de {$cita->especialidad} quedó agendada para el {$cita->fecha} a las {$cita->hora}.",
                ]);
            }
        }

        return response()->json([
            'respuesta' => $data['choices'][0]['message']['content'] ?? 'No entendí tu solicitud.',
        ]);
    }
}
