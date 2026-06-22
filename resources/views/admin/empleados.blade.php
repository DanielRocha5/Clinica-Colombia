@extends('layouts.menuAdmin')

@section('title', 'Empleados')

@section('css')
<link rel="stylesheet" href="/css/adminEmpleados.css">
@endsection

@section('content')
<div class="admin-wrap">

    <div class="admin-header">
        <div class="admin-tag">PANEL DE CONTROL</div>
        <h2 class="admin-title">Gestión de <span>empleados</span></h2>
        <p class="admin-sub">Crea y administra el personal de la clínica</p>
    </div>

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    <div class="grid-layout">

        <div class="form-card">
            <div class="form-card-title">NUEVO EMPLEADO</div>
            <form action="{{ route('admin.empleados.store') }}" method="POST">
                @csrf
                <div class="field">
                    <label>Nombre</label>
                    <input type="text" name="nombre" value="{{ old('nombre') }}" placeholder="Nombre...">
                    @error('nombre') <p>{{ $message }}</p> @enderror
                </div>
                <div class="field">
                    <label>Apellido</label>
                    <input type="text" name="apellido" value="{{ old('apellido') }}" placeholder="Apellido...">
                    @error('apellido') <p>{{ $message }}</p> @enderror
                </div>
                <div class="field">
                    <label>Tipo de identificación</label>
                    <select name="tipo_id">
                        <option disabled selected>Selecciona</option>
                        <option {{ old('tipo_id') == 'Cédula de Ciudadanía' ? 'selected' : '' }}>Cédula de Ciudadanía</option>
                        <option {{ old('tipo_id') == 'Cédula de Extranjería' ? 'selected' : '' }}>Cédula de Extranjería</option>
                        <option {{ old('tipo_id') == 'Pasaporte' ? 'selected' : '' }}>Pasaporte</option>
                    </select>
                    @error('tipo_id') <p>{{ $message }}</p> @enderror
                </div>
                <div class="field">
                    <label>Número de identificación</label>
                    <input type="text" name="numero_id" value="{{ old('numero_id') }}" placeholder="Ej: 1000000000">
                    @error('numero_id') <p>{{ $message }}</p> @enderror
                </div>
                <div class="field">
                    <label>Cargo</label>
                    <select name="cargo">
                        <option disabled selected>Selecciona</option>
                        <option {{ old('cargo') == 'Médico General' ? 'selected' : '' }}>Médico General</option>
                        <option {{ old('cargo') == 'Especialista' ? 'selected' : '' }}>Especialista</option>
                        <option {{ old('cargo') == 'Enfermero/a' ? 'selected' : '' }}>Enfermero/a</option>
                        <option {{ old('cargo') == 'Recepcionista' ? 'selected' : '' }}>Recepcionista</option>
                        <option {{ old('cargo') == 'Administrativo' ? 'selected' : '' }}>Administrativo</option>
                    </select>
                    @error('cargo') <p>{{ $message }}</p> @enderror
                </div>
                <div class="field">
                    <label>Correo electrónico</label>
                    <input type="text" name="email" value="{{ old('email') }}" placeholder="correo@clinica.com">
                    @error('email') <p>{{ $message }}</p> @enderror
                </div>
                <div class="field">
                    <label>Teléfono</label>
                    <input type="text" name="telefono" value="{{ old('telefono') }}" placeholder="Ej: 3001234567">
                    @error('telefono') <p>{{ $message }}</p> @enderror
                </div>
                <button type="submit" class="btn-crear">CREAR EMPLEADO</button>
            </form>
        </div>

        <div class="table-wrap">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>ID</th>
                        <th>Cargo</th>
                        <th>Correo</th>
                        <th>Teléfono</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($empleados as $empleado)
                    <tr>
                        <td>{{ $empleado->nombre }} {{ $empleado->apellido }}</td>
                        <td class="muted">{{ $empleado->numero_id }}</td>
                        <td class="muted">{{ $empleado->cargo }}</td>
                        <td class="muted">{{ $empleado->email }}</td>
                        <td class="muted">{{ $empleado->telefono }}</td>
                        <td>
                            <div class="action-btns">
                                <a href="{{ route('admin.empleados.edit', $empleado->id) }}" class="btn-editar">Editar</a>
                                <form action="{{ route('admin.empleados.destroy', $empleado->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-eliminar">Eliminar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="empty-msg">No hay empleados registrados.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

</div>
@endsection