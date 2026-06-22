<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Cuenta</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;600;700&family=Inter:wght@300;400;500;600&display=swap">
    <link rel="stylesheet" href="/css/account.css">
</head>

<body>

    <div class="bg-img"></div>
    <div class="grid"></div>
    <div class="orb-l"></div>
    <div class="orb-r"></div>

    <a href="/" class="back-btn"><span>←</span> VOLVER</a>

    <div class="card">
        <div class="card-tag"><span class="dot-live"></span>Registro nuevo</div>
        <div class="card-title">Crear <span>cuenta</span></div>
        <div class="card-sub">Completa tus datos para registrarte</div>

        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="row">
                <div class="field">
                    <label>Nombre</label>
                    <input type="text" name="nombre" value="{{ old('nombre') }}" placeholder="Tu nombre...">
                    @error('nombre')
                        <p style="color:red; font-size:12px;">{{ $message }}</p>
                    @enderror
                </div>
                <div class="field">
                    <label>Apellido</label>
                    <input type="text" name="apellido" value="{{ old('apellido') }}" placeholder="Tu apellido...">
                    @error('apellido')
                        <p style="color:red; font-size:12px;">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="field">
                <label>Tipo de identificación</label>
                <div class="select-wrap">
                    <select name="tipo_id">
                        <option disabled selected>Selecciona una opción</option>
                        <option>Cédula de Ciudadanía</option>
                        <option>Cédula de Extranjería</option>
                        <option>Pasaporte</option>
                    </select>
                </div>
                @error('tipo_id')
                    <p style="color:red; font-size:12px;">{{ $message }}</p>
                @enderror
            </div>

            <div class="field">
                <label>Número de identificación</label>
                <input type="text" name="numero_id" value="{{ old('numero_id') }}" placeholder="Ej: 1000000000">
                @error('numero_id')
                    <p style="color:red; font-size:12px;">{{ $message }}</p>
                @enderror
            </div>

            <div class="field">
                <label>Correo electrónico</label>
                <input type="text" name="email" value="{{ old('email') }}" placeholder="usuario@correo.com">
                @error('email')
                    <p style="color:red; font-size:12px;">{{ $message }}</p>
                @enderror
            </div>

            <div class="row">
                <div class="field">
                    <label>Contraseña</label>
                    <input type="password" name="password" placeholder="••••••••">
                    @if($errors->has('password'))
                        @foreach($errors->get('password') as $error)
                            @if(!str_contains($error, 'coinciden'))
                                <p style="color:red; font-size:12px;">{{ $error }}</p>
                            @endif
                        @endforeach
                    @endif
                </div>
                <div class="field">
                    <label>Confirmar</label>
                    <input type="password" name="password_confirmation" placeholder="••••••••">
                    @if($errors->has('password'))
                        @foreach($errors->get('password') as $error)
                            @if(str_contains($error, 'coinciden'))
                                <p style="color:red; font-size:12px;">{{ $error }}</p>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>

            <button type="submit" class="btn-registrar">Crear cuenta</button>
            <div class="divider">
                <div class="divider-line"></div>
                <span>O</span>
                <div class="divider-line"></div>
            </div>
            <div class="login-link">¿Ya tienes cuenta? <a href="{{ route('iniciarSesion') }}">Iniciar sesión</a></div>
        </form>
    </div>

</body>
</html>