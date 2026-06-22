@extends('layouts.menuAdmin')

@section('title', 'Información')

@section('content')
<div style="padding: 2rem; font-family: 'Inter', sans-serif;">

    {{-- TÍTULO + BOTÓN EXCEL --}}
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <div>
            <div style="font-family: 'Orbitron', sans-serif; font-size: 11px; color: #00ff88; letter-spacing: 3px; margin-bottom: 8px;">PANEL DE CONTROL</div>
            <h2 style="font-family: 'Orbitron', sans-serif; font-size: 24px; color: #fff; margin: 0;">Información <span style="color: #00ff88;">general</span></h2>
            <p style="color: #888; font-size: 14px; margin-top: 6px;">Historial completo de todas las citas registradas</p>
        </div>

        <a href="{{ route('admin.informacion.export') }}"
           style="display: inline-flex; align-items: center; gap: 8px;
                  background: rgba(0,255,136,0.1); border: 1px solid #00ff88;
                  color: #00ff88; padding: 10px 20px; border-radius: 8px;
                  font-family: 'Orbitron', sans-serif; font-size: 10px;
                  letter-spacing: 1px; text-decoration: none; transition: background 0.2s;
                  white-space: nowrap;"
           onmouseover="this.style.background='rgba(0,255,136,0.25)'"
           onmouseout="this.style.background='rgba(0,255,136,0.1)'">
            📊 EXPORTAR EXCEL
        </a>
    </div>

    @if(session('success'))
        <div style="background: rgba(0,255,136,0.1); border: 1px solid #00ff88; border-radius: 8px; padding: 12px 16px; margin-bottom: 1.5rem; color: #00ff88; font-size: 14px;">
            {{ session('success') }}
        </div>
    @endif

    <div style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); border-radius: 12px; overflow: hidden;">
        <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
            <thead>
                <tr style="background: rgba(0,255,136,0.05); border-bottom: 1px solid rgba(255,255,255,0.08);">
                    <th style="padding: 14px 16px; text-align: left; color: #00ff88; font-family: 'Orbitron', sans-serif; font-size: 11px; letter-spacing: 2px; font-weight: 600;">PACIENTE</th>
                    <th style="padding: 14px 16px; text-align: left; color: #00ff88; font-family: 'Orbitron', sans-serif; font-size: 11px; letter-spacing: 2px; font-weight: 600;">CORREO</th>
                    <th style="padding: 14px 16px; text-align: left; color: #00ff88; font-family: 'Orbitron', sans-serif; font-size: 11px; letter-spacing: 2px; font-weight: 600;">ESPECIALIDAD</th>
                    <th style="padding: 14px 16px; text-align: left; color: #00ff88; font-family: 'Orbitron', sans-serif; font-size: 11px; letter-spacing: 2px; font-weight: 600;">FECHA</th>
                    <th style="padding: 14px 16px; text-align: left; color: #00ff88; font-family: 'Orbitron', sans-serif; font-size: 11px; letter-spacing: 2px; font-weight: 600;">HORA</th>
                    <th style="padding: 14px 16px; text-align: left; color: #00ff88; font-family: 'Orbitron', sans-serif; font-size: 11px; letter-spacing: 2px; font-weight: 600;">ESTADO</th>
                    <th style="padding: 14px 16px; text-align: left; color: #00ff88; font-family: 'Orbitron', sans-serif; font-size: 11px; letter-spacing: 2px; font-weight: 600;">ACCIÓN</th>
                </tr>
            </thead>
            <tbody>
                @forelse($citas as $cita)
                <tr style="border-bottom: 1px solid rgba(255,255,255,0.05); transition: background 0.2s;"
                    onmouseover="this.style.background='rgba(255,255,255,0.03)'"
                    onmouseout="this.style.background='transparent'">

                    <td style="padding: 14px 16px; color: #fff;">{{ $cita->user->nombre }} {{ $cita->user->apellido }}</td>
                    <td style="padding: 14px 16px; color: #aaa;">{{ $cita->user->email }}</td>
                    <td style="padding: 14px 16px; color: #fff;">{{ $cita->especialidad }}</td>
                    <td style="padding: 14px 16px; color: #aaa;">{{ $cita->fecha }}</td>
                    <td style="padding: 14px 16px; color: #aaa;">{{ substr($cita->hora, 0, 5) }}</td>

                    <td style="padding: 14px 16px;">
                        @if($cita->estado === 'pendiente')
                            <span style="background: rgba(255,193,7,0.15); color: #ffc107; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 500;">Pendiente</span>
                        @elseif($cita->estado === 'aceptada')
                            <span style="background: rgba(0,255,136,0.15); color: #00ff88; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 500;">Aceptada</span>
                        @else
                            <span style="background: rgba(255,59,59,0.15); color: #ff3b3b; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 500;">Cancelada</span>
                        @endif
                    </td>

                    <td style="padding: 14px 16px;">
                        <a href="{{ route('pdf.generar', $cita->id) }}"
                           target="_blank"
                           style="display: inline-flex; align-items: center; gap: 6px;
                                  background: rgba(0,255,136,0.1); border: 1px solid #00ff88;
                                  color: #00ff88; padding: 6px 14px; border-radius: 6px;
                                  font-family: 'Orbitron', sans-serif; font-size: 10px;
                                  letter-spacing: 1px; text-decoration: none;
                                  transition: background 0.2s;"
                           onmouseover="this.style.background='rgba(0,255,136,0.25)'"
                           onmouseout="this.style.background='rgba(0,255,136,0.1)'">
                            ⬇ PDF
                        </a>
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="7" style="padding: 2rem; text-align: center; color: #555;">No hay citas registradas.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection