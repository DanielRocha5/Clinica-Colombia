@extends('layouts.menuAdmin')

@section('title', 'Citas solicitadas')

@section('css')
<link rel="stylesheet" href="/css/adminCitas.css">
@endsection

@section('content')
<div class="admin-wrap">

    <div class="admin-header">
        <div class="admin-tag">PANEL DE CONTROL</div>
        <h2 class="admin-title">Citas <span>solicitadas</span></h2>
        <p class="admin-sub">Gestiona las citas pendientes de los pacientes</p>
    </div>

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-wrap">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Paciente</th>
                    <th>Especialidad</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($citas as $cita)
                <tr>
                    <td>{{ $cita->user->nombre }} {{ $cita->user->apellido }}</td>
                    <td class="muted">{{ $cita->especialidad }}</td>
                    <td class="muted">{{ $cita->fecha }}</td>
                    <td class="muted">{{ $cita->hora }}</td>
                    <td>
                        @if($cita->estado === 'pendiente')
                            <span class="badge badge-pendiente">Pendiente</span>
                        @elseif($cita->estado === 'aceptada')
                            <span class="badge badge-aceptada">Aceptada</span>
                        @else
                            <span class="badge badge-cancelada">Cancelada</span>
                        @endif
                    </td>
                    <td>
                        @if($cita->estado === 'pendiente')
                            <form action="{{ route('admin.citas.aceptar', $cita->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn-aceptar">Aceptar</button>
                            </form>
                            <form action="{{ route('admin.citas.cancelar', $cita->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn-cancelar">Cancelar</button>
                            </form>
                        @else
                            <span class="muted">—</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="empty-msg">No hay citas registradas.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection