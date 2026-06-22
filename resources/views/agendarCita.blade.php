<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendar Cita</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;600;700&family=Inter:wght@300;400;500;600&display=swap">
    <link rel="stylesheet" href="/css/agendarCita.css">
</head>
<body>

    <div class="bg-grid"></div>
    <div class="orb-t"></div>
    <div class="orb-b"></div>

    <div class="left">
        <a href="{{ route('user.dashboard') }}" class="back-btn">← VOLVER</a>

        <div class="form-tag"><span class="dot-live"></span>Sistema de citas</div>
        <div class="form-title">Agendar <span>cita</span></div>
        <div class="form-sub">Completa el formulario para reservar tu consulta</div>

        <form action="{{ route('citas.store') }}" method="POST">
            @csrf

            <div class="field">
                <label>Especialidad</label>
                <div class="select-wrap">
                    <select name="especialidad">
                        <option disabled selected>Selecciona</option>
                        <option>Consulta General</option>
                        <option>Consulta de Tiroides</option>
                        <option>Ecografía Abdominal</option>
                    </select>
                </div>
                @error('especialidad')
                    <p style="color:#ff3b3b; font-size:12px; margin-top:6px; display:flex; align-items:center; gap:5px;">
                        <span>⚠</span> {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="row">
                <div class="field">
                    <label>Fecha de consulta</label>
                    <input type="date" name="fecha" value="{{ old('fecha') }}"
                           min="{{ date('Y-m-d') }}"
                           max="{{ date('Y-m-d', strtotime('+5 months')) }}">
                    @error('fecha')
                        <p style="color:#ff3b3b; font-size:12px; margin-top:6px; display:flex; align-items:center; gap:5px;">
                            <span>⚠</span> {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="field">
                    <label>Hora de consulta</label>
                    <input type="time" name="hora" value="{{ old('hora') }}" min="08:00" max="21:00">
                    @error('hora')
                        <p style="background: rgba(255,59,59,0.08); border: 1px solid rgba(255,59,59,0.3); border-left: 3px solid #ff3b3b; border-radius: 6px; padding: 10px 14px; color:#ff3b3b; font-size:12px; margin-top:8px; line-height:1.5;">
                            ⚠ {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            <button type="submit" class="btn-agendar">Agendar cita</button>
        </form>

        @if(session('success'))
            <div style="margin-top: 1.5rem; background: rgba(0,255,136,0.1); border: 1px solid #00ff88; border-radius: 8px; padding: 12px 16px; color: #00ff88; font-size: 14px; display:flex; align-items:center; gap:8px;">
                <span>✅</span> {{ session('success') }}
            </div>
        @endif

        @php $citas = auth()->user()->citas()->orderBy('created_at', 'desc')->get(); @endphp

        @if($citas->count() > 0)
        <div style="margin-top: 2rem;">
            <div style="font-family: 'Orbitron', sans-serif; font-size: 11px; color: #00ff88; letter-spacing: 3px; margin-bottom: 12px;">MIS CITAS</div>
            @foreach($citas as $cita)
            <div style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); border-radius: 10px; padding: 14px 16px; margin-bottom: 10px;">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <div style="color: #fff; font-size: 14px; font-weight: 500;">{{ $cita->especialidad }}</div>
                        <div style="color: #888; font-size: 12px; margin-top: 4px;">{{ $cita->fecha }} · {{ substr($cita->hora, 0, 5) }}</div>
                    </div>
                    <div>
                        @if($cita->estado === 'pendiente')
                            <span style="background: rgba(255,193,7,0.15); color: #ffc107; padding: 4px 12px; border-radius: 20px; font-size: 12px;">Pendiente</span>
                        @elseif($cita->estado === 'aceptada')
                            <span style="background: rgba(0,255,136,0.15); color: #00ff88; padding: 4px 12px; border-radius: 20px; font-size: 12px;">Aceptada</span>
                        @else
                            <span style="background: rgba(255,59,59,0.15); color: #ff3b3b; padding: 4px 12px; border-radius: 20px; font-size: 12px;">Cancelada</span>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif

    </div>

    <div class="right">
        <div class="right-img"></div>
        <div class="right-overlay"></div>
        <div class="right-content">
            <div class="right-badge">
                <div class="right-badge-tag">Centro médico avanzado</div>
                <div class="right-badge-title">Atención de calidad garantizada</div>
                <div class="right-badge-sub">Nuestros especialistas están listos para atenderte con la mejor tecnología médica disponible.</div>
                <div class="right-stats">
                    <div class="rs"><div class="rs-num">3</div><div class="rs-label">Especialidades</div></div>
                    <div class="rs"><div class="rs-num">4</div><div class="rs-label">Médicos</div></div>
                    <div class="rs"><div class="rs-num">24/7</div><div class="rs-label">Disponible</div></div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>