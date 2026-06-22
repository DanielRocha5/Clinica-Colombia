<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informes de Pacientes</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .estado-pendiente  { background-color: #fef9c3; color: #854d0e; }
        .estado-aceptada   { background-color: #dcfce7; color: #166534; }
        .estado-cancelada  { background-color: #fee2e2; color: #991b1b; }
    </style>
</head>
<body class="bg-gray-100 min-h-screen p-6">
 
    <div class="max-w-5xl mx-auto">
 
        {{-- Encabezado --}}
        <div class="bg-white rounded-2xl shadow p-6 mb-6 flex items-center gap-4">
            <div class="bg-blue-600 text-white rounded-full w-12 h-12 flex items-center justify-center text-xl font-bold">
                🏥
            </div>
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Informes de Pacientes</h1>
                <p class="text-gray-500 text-sm">Selecciona un paciente para generar su PDF</p>
            </div>
        </div>
 
        {{-- Lista de usuarios --}}
        <div class="grid gap-4">
            @forelse($users as $user)
                <div class="bg-white rounded-2xl shadow hover:shadow-md transition p-5 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
 
                    {{-- Info del paciente --}}
                    <div class="flex items-center gap-4">
                        <div class="bg-blue-100 text-blue-700 rounded-full w-11 h-11 flex items-center justify-center font-bold text-lg uppercase">
                            {{ substr($user->nombre, 0, 1) }}{{ substr($user->apellido, 0, 1) }}
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800 text-base">
                                {{ $user->nombre }} {{ $user->apellido }}
                            </p>
                            <p class="text-gray-500 text-sm">{{ $user->email }}</p>
                            <p class="text-gray-400 text-xs mt-0.5">
                                {{ $user->tipo_id }}: {{ $user->numero_id }}
                            </p>
                        </div>
                    </div>
 
                    {{-- Citas resumen + botón --}}
                    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-3">
 
                        {{-- Badges de estado de citas --}}
                        <div class="flex flex-wrap gap-1">
                            @foreach($user->citas as $cita)
                                <span class="text-xs px-2 py-0.5 rounded-full font-medium
                                    estado-{{ $cita->estado }}">
                                    {{ ucfirst($cita->estado) }}
                                </span>
                            @endforeach
                            @if($user->citas->isEmpty())
                                <span class="text-xs text-gray-400 italic">Sin citas</span>
                            @endif
                        </div>
 
                        {{-- Botón PDF --}}
                        <a href="{{ route('pdf.generar', $user->id) }}"
                           target="_blank"
                           class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-4 py-2 rounded-xl transition whitespace-nowrap">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h6l2 2h4a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                            </svg>
                            Generar PDF
                        </a>
                    </div>
 
                </div>
            @empty
                <div class="bg-white rounded-2xl shadow p-10 text-center text-gray-400">
                    No hay pacientes registrados.
                </div>
            @endforelse
        </div>
 
    </div>
 
</body>
</html>