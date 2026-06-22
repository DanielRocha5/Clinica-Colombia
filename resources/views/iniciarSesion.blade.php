<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;600;700&family=Inter:wght@300;400;500;600&display=swap">
    <link rel="stylesheet" href="/css/login.css">
</head>

<body>

    <div class="bg-img"></div>
    <div class="grid"></div>
    <div class="orb-l"></div>
    <div class="orb-r"></div>

    <a href="/" class="back-btn"><span class="back-arrow">←</span> VOLVER</a>

    <div class="card">
        <div class="card-tag"><span class="dot-live"></span>Sistema activo</div>
        <div class="card-title">Iniciar <span>sesión</span></div>
        <div class="card-sub">Accede a tu panel médico</div>

        <form action="{{ route('iniciarSesion') }}" method="POST">
            @csrf
            <div class="field">
                <label>Correo electrónico</label>
                <input type="email" name="email"
                    value="{{ old('email') }}"
                    placeholder="usuario@correo.com">
                @error('email')
                <span style="color:red; font-size:12px;">{{ $message }}</span>
                @enderror
            </div>

            <div class="field">
                <label>Contraseña</label>
                <input type="password" name="password" placeholder="••••••••••">
                @error('password')
                <span style="color:red; font-size:12px;">{{ $message }}</span>
                @enderror
            </div>
            <div class="forgot"><a href="crearCuenta">¿Olvidaste tu contraseña?</a></div>
            <button type="submit" class="btn-ingresar">Ingresar</button>
            <div class="divider">
                <div class="divider-line"></div>
                <span>O</span>
                <div class="divider-line"></div>
            </div>
            <div class="register-link">¿No tienes cuenta? <a href="{{ route('crearCuenta') }}">Crear cuenta</a></div>
        </form>
    </div>

</body>

</html>