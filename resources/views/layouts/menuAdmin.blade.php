<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Clínica - Admin')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;600;700&family=Inter:wght@300;400;500;600&display=swap">
    <link rel="stylesheet" href="/css/home.css">
    @yield('css')
</head>

<body>
    <div class="page bg-global">

        <nav class="navbar">
            <div class="logo-wrap">
                <div class="logo-hex">CX</div>
                <div>
                    <div class="logo-text">CLINICA</div>
                    <div class="logo-sub">PANEL ADMIN</div>
                </div>
            </div>
            <nav class="nav-links">
                <a href="{{ route('admin.dashboard') }}">Inicio</a>
                <a href="{{ route('admin.informacion') }}">Información</a>
                <a href="{{ route('admin.citas') }}">Ver citas</a>
                <a href="{{ route('admin.empleados') }}">Empleados</a>
            </nav>
            <div class="nav-btns">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-ghost">Cerrar sesión</button>
                </form>
            </div>
        </nav>

        @yield('content')

        <div class="footer">
            <div class="footer-brand">CLINICA © 2026</div>
            <div class="footer-line">Panel de administración · Colombia</div>
        </div>

    </div>
    @yield('scripts')
</body>

</html>