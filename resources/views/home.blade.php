<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clínica</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;600;700&family=Inter:wght@300;400;500;600&display=swap">
    <link rel="stylesheet" href="/css/home.css">
</head>

<body>
    <div class="page bg-global">

        <nav class="navbar">
            <div class="logo-wrap">
                <div class="logo-hex">CX</div>
                <div>
                    <div class="logo-text">CLINICA</div>
                    <div class="logo-sub">ADVANCED HEALTH</div>
                </div>
            </div>
            <nav class="nav-links">
                <a href="/">Inicio</a>
                @auth
                @if(Auth::user()->hasRole('user'))
                <a href="{{ route('citas.agendarCita') }}">Agenda tu cita</a>
                @endif
                @else
                <a href="{{ route('iniciarSesion') }}">Agenda tu cita</a>
                @endauth
                <a href="/servicios">Servicios</a>
                <a href="/nosotros">Nosotros</a>
            </nav>
            <div class="nav-btns">
                @auth
                <span style="color:#fff; margin-right:10px;">{{ Auth::user()->nombre }}</span>
                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn-ghost">Cerrar sesión</button>
                </form>
                @else
                <a href="{{ route('iniciarSesion') }}">
                    <button class="btn-ghost">Iniciar sesión</button>
                </a>
                <a href="{{ route('crearCuenta') }}">
                    <button class="btn-neon">Crear cuenta</button>
                </a>
                @endauth
            </div>
        </nav>

        <div class="hero-section">
            <video class="hero-video" autoplay muted loop playsinline>
                <source src="/videos/tu-video.mp4" type="video/mp4">
            </video>
            <div class="orb1"></div>
            <div class="orb2"></div>
            <div class="orb3"></div>
            <span class="hero-badge"><span class="dot-live"></span>Sistema médico activo</span>
            <h1 class="hero-title">
                Tu salud es nuestra<br>
                <span class="neon-cyan">prioridad</span> <span class="neon-blue">#1</span>
            </h1>
            <p class="hero-desc">Medicina de vanguardia con tecnología del futuro. Agenda tu cita y accede a los mejores especialistas del país.</p>
            @auth
            <a href="{{ route('citas.agendarCita') }}" class="btn-cta">Agendar cita ahora</a>
            @else
            <a href="{{ route('iniciarSesion') }}" class="btn-cta">Agendar cita ahora</a>
            @endauth
        </div>

        <div class="pulso-wrap">
            <div class="pulso-inner">
                <div class="pulso-label">PULSO VITAL</div>
                <canvas id="pulso" height="50"></canvas>
                <div class="pulso-val" id="bpmVal">72</div>
                <div class="pulso-unit">BPM</div>
            </div>
        </div>

        <div class="stats-bar">
            <div class="stat-item">
                <div class="stat-num">3</div>
                <div class="stat-label">Sucursales en Colombia</div>
            </div>
            <div class="stat-item">
                <div class="stat-num">20+</div>
                <div class="stat-label">Años de experiencia</div>
            </div>
            <div class="stat-item">
                <div class="stat-num">50K+</div>
                <div class="stat-label">Pacientes atendidos</div>
            </div>
            <div class="stat-item">
                <div class="stat-num">100%</div>
                <div class="stat-label">Compromiso contigo</div>
            </div>
        </div>

        <div class="section-dark">
            <div class="sec-header">
                <div class="sec-tag">Módulo de servicios</div>
                <div class="sec-title">Servicios recomendados</div>
                <div class="sec-sub">Selecciona tu especialidad y agenda en segundos</div>
            </div>
            <div class="cards-row">
                <div class="card-serv">
                    <div class="card-icon">🩺</div>
                    <div class="card-title">Consulta general primera vez</div>
                    @auth
                    <a href="{{ route('citas.agendarCita') }}" class="btn-card">Agendar cita</a>
                    @else
                    <a href="{{ route('iniciarSesion') }}" class="btn-card">Agendar cita</a>
                    @endauth
                </div>
                <div class="card-serv">
                    <div class="card-icon">🦋</div>
                    <div class="card-title">Consulta de tiroides primera vez</div>
                    @auth
                    <a href="{{ route('citas.agendarCita') }}" class="btn-card">Agendar cita</a>
                    @else
                    <a href="{{ route('iniciarSesion') }}" class="btn-card">Agendar cita</a>
                    @endauth
                </div>
                <div class="card-serv">
                    <div class="card-icon">🔬</div>
                    <div class="card-title">Ecografía abdominal primera vez</div>
                    @auth
                    <a href="{{ route('citas.agendarCita') }}" class="btn-card">Agendar cita</a>
                    @else
                    <a href="{{ route('iniciarSesion') }}" class="btn-card">Agendar cita</a>
                    @endauth
                </div>
            </div>
        </div>

        <div class="section-alt">
            <div class="nosotros-grid">
                <div class="nosotros-text">
                    <div class="nos-tag">Historia clínica</div>
                    <div class="nos-title">Nosotros</div>
                    <div class="nos-sub">Más de 4 décadas cuidando tu salud</div>
                    <p class="nos-desc">En 1978 el cirujano Jhoceb Maconskin, con más de 20 años de experiencia, abrió su primer consultorio en Ibagué. Su perseverancia lo llevó a crecer de 3 empleados a 3 sucursales en todo el país. Hoy somos la clínica más reconocida de Colombia. Gracias por ser parte de nuestra comunidad.</p>
                </div>
                <div class="nos-img">
                    <div class="nos-img-label">[ info.png ]</div>
                </div>
            </div>
        </div>

        <div class="footer">
            <div class="footer-brand">CLINICA © 2026</div>
            <div class="footer-line">Sistema de salud avanzada · Colombia</div>
        </div>

    </div>

    <script>
        const canvas = document.getElementById('pulso');
        const ctx = canvas.getContext('2d');
        const H = canvas.height;
        let points = [];
        let x = 0;
        const speed = 3;
        const bpmEl = document.getElementById('bpmVal');
        let bpm = 72;
        let frameCount = 0;

        function resizeCanvas() {
            canvas.width = canvas.offsetWidth;
            points = [];
        }

        resizeCanvas();
        window.addEventListener('resize', resizeCanvas);

        function ecgPoint(xPos) {
            const cycle = 120;
            const t = xPos % cycle;
            const mid = H / 2;
            if (t < 10) return mid;
            if (t < 15) return mid - 4;
            if (t < 20) return mid + 4;
            if (t < 25) return mid - 22;
            if (t < 28) return mid + 18;
            if (t < 33) return mid - 6;
            if (t < 40) return mid + 2;
            if (t < 55) return mid + 6;
            if (t < 65) return mid - 6;
            return mid;
        }

        function draw() {
            const W = canvas.width;
            ctx.clearRect(0, 0, W, H);
            x += speed;
            points.push({
                x: W,
                y: ecgPoint(x)
            });
            for (let i = 0; i < points.length; i++) points[i].x -= speed;
            points = points.filter(p => p.x > 0);

            if (points.length > 1) {
                ctx.beginPath();
                ctx.moveTo(points[0].x, points[0].y);
                for (let i = 1; i < points.length; i++) ctx.lineTo(points[i].x, points[i].y);
                ctx.strokeStyle = '#00ff88';
                ctx.lineWidth = 2;
                ctx.shadowColor = '#00ff88';
                ctx.shadowBlur = 8;
                ctx.stroke();
                ctx.shadowBlur = 0;
            }

            frameCount++;
            if (frameCount % 180 === 0) {
                bpm = 65 + Math.floor(Math.random() * 20);
                bpmEl.textContent = bpm;
            }
            requestAnimationFrame(draw);
        }
        draw();
    </script>
    @auth
    <x-chat-widget />
    @endauth
</body>

</html>