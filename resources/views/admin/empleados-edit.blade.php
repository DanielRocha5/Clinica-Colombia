@extends('layouts.menuAdmin')

@section('title', 'Editar Empleado')

@section('css')
<link rel="stylesheet" href="/css/adminEmpleados.css">
@endsection

@section('content')
<div class="admin-wrap">

    <div class="admin-header">
        <div class="admin-tag">PANEL DE CONTROL</div>
        <h2 class="admin-title">Editar <span>empleado</span></h2>
        <p class="admin-sub">Modifica los datos del empleado.</p>
    </div>

    @if($errors->any())
        <div class="alert-error">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <div class="form-card" style="max-width: 580px;">
        <div class="form-card-title">DATOS DEL EMPLEADO</div>

        <form action="{{ route('admin.empleados.update', $empleado->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="field">
                <label>Nombre</label>
                <input type="text" name="nombre" value="{{ old('nombre', $empleado->nombre) }}" placeholder="Nombre...">
                @error('nombre') <p>{{ $message }}</p> @enderror
            </div>

            <div class="field">
                <label>Apellido</label>
                <input type="text" name="apellido" value="{{ old('apellido', $empleado->apellido) }}" placeholder="Apellido...">
                @error('apellido') <p>{{ $message }}</p> @enderror
            </div>

            <div class="field">
                <label>Tipo de identificación</label>
                <select name="tipo_id">
                    <option disabled>Selecciona</option>
                    <option {{ old('tipo_id', $empleado->tipo_id) == 'Cédula de Ciudadanía'  ? 'selected' : '' }}>Cédula de Ciudadanía</option>
                    <option {{ old('tipo_id', $empleado->tipo_id) == 'Cédula de Extranjería' ? 'selected' : '' }}>Cédula de Extranjería</option>
                    <option {{ old('tipo_id', $empleado->tipo_id) == 'Pasaporte'             ? 'selected' : '' }}>Pasaporte</option>
                </select>
                @error('tipo_id') <p>{{ $message }}</p> @enderror
            </div>

            <div class="field">
                <label>Número de identificación</label>
                <input type="text" name="numero_id" value="{{ old('numero_id', $empleado->numero_id) }}" placeholder="Ej: 1000000000">
                @error('numero_id') <p>{{ $message }}</p> @enderror
            </div>

            <div class="field">
                <label>Cargo</label>
                <select name="cargo">
                    <option disabled>Selecciona</option>
                    <option {{ old('cargo', $empleado->cargo) == 'Médico General'  ? 'selected' : '' }}>Médico General</option>
                    <option {{ old('cargo', $empleado->cargo) == 'Especialista'    ? 'selected' : '' }}>Especialista</option>
                    <option {{ old('cargo', $empleado->cargo) == 'Enfermero/a'     ? 'selected' : '' }}>Enfermero/a</option>
                    <option {{ old('cargo', $empleado->cargo) == 'Recepcionista'   ? 'selected' : '' }}>Recepcionista</option>
                    <option {{ old('cargo', $empleado->cargo) == 'Administrativo'  ? 'selected' : '' }}>Administrativo</option>
                </select>
                @error('cargo') <p>{{ $message }}</p> @enderror
            </div>

            <div class="field">
                <label>Correo electrónico</label>
                <input type="email" name="email" value="{{ old('email', $empleado->email) }}" placeholder="correo@clinica.com">
                @error('email') <p>{{ $message }}</p> @enderror
            </div>

            <div class="field">
                <label>Teléfono</label>
                <input type="text" name="telefono" value="{{ old('telefono', $empleado->telefono) }}" placeholder="Ej: 3001234567">
                @error('telefono') <p>{{ $message }}</p> @enderror
            </div>

            <div class="action-btns" style="margin-top: 1.5rem;">
                <button type="submit" class="btn-crear">GUARDAR CAMBIOS</button>
                <a href="{{ route('admin.empleados') }}" class="btn-cancelar">Cancelar</a>
            </div>

        </form>
    </div>

</div>
@endsection