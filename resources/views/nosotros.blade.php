<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nosotros</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;600;700&family=Inter:wght@300;400;500;600&display=swap">
    <link rel="stylesheet" href="/css/nosotros.css">
</head>
<body>

    <div class="bg-grid"></div>
    <div class="orb1"></div>
    <div class="orb2"></div>

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
                <a href="{{ route('citas.agendarCita') }}">Agenda tu cita</a>
            @else
                <a href="{{ route('iniciarSesion') }}">Agenda tu cita</a>
            @endauth
            <a href="/servicios">Servicios</a>
            <a href="/nosotros" class="active">Nosotros</a>
        </nav>
        <a href="/" class="back-btn">← VOLVER</a>
    </nav>

    <div class="hero">
        <div class="hero-left">
            <div class="hero-tag"><span class="dot-live"></span>Sobre nosotros</div>
            <h1 class="hero-title">Más de 4 décadas<br>cuidando tu <span>salud</span></h1>
            <p class="hero-desc">Desde 1978 somos referentes en atención médica en Colombia. Comenzamos con un pequeño consultorio en Ibagué y hoy contamos con 3 sucursales en todo el país, ofreciendo tecnología de vanguardia y atención humanizada.</p>
            <div class="hero-btns">
                @auth
                    <a href="{{ route('citas.agendarCita') }}" class="btn-primary">Agendar cita</a>
                @else
                    <a href="{{ route('iniciarSesion') }}" class="btn-primary">Agendar cita</a>
                @endauth
                <a href="/servicios" class="btn-ghost">Ver servicios</a>
            </div>
        </div>
        <div class="hero-right">
            <div class="stat-grid">
                <div class="stat-box"><div class="stat-num">46+</div><div class="stat-label">Años de experiencia</div></div>
                <div class="stat-box"><div class="stat-num">3</div><div class="stat-label">Sucursales</div></div>
                <div class="stat-box"><div class="stat-num">50K+</div><div class="stat-label">Pacientes</div></div>
                <div class="stat-box"><div class="stat-num">98%</div><div class="stat-label">Satisfacción</div></div>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="sec-tag">Línea de tiempo</div>
        <div class="sec-title">Nuestra <span>historia</span></div>
        <div class="sec-sub">El camino que nos trajo hasta aquí</div>
        <div class="timeline">
            <div class="tl-item">
                <div class="tl-dot-wrap">
                    <div class="tl-dot">1978</div>
                    <div class="tl-line"></div>
                </div>
                <div class="tl-content">
                    <div class="tl-year">1978</div>
                    <div class="tl-title">Los inicios en Ibagué</div>
                    <div class="tl-desc">El Dr. Jhoceb Maconskin abre su primer consultorio en el barrio El Salado con apenas 3 empleados y una visión clara: salud accesible para todos los colombianos.</div>
                </div>
            </div>
            <div class="tl-item">
                <div class="tl-dot-wrap">
                    <div class="tl-dot">1995</div>
                    <div class="tl-line"></div>
                </div>
                <div class="tl-content">
                    <div class="tl-year">1995</div>
                    <div class="tl-title">Primera expansión</div>
                    <div class="tl-desc">Apertura de la segunda sucursal en Bogotá, incorporando equipos de diagnóstico de última generación y ampliando el equipo médico a más de 30 especialistas.</div>
                </div>
            </div>
            <div class="tl-item">
                <div class="tl-dot-wrap">
                    <div class="tl-dot">2010</div>
                    <div class="tl-line"></div>
                </div>
                <div class="tl-content">
                    <div class="tl-year">2010</div>
                    <div class="tl-title">Digitalización del servicio</div>
                    <div class="tl-desc">Implementación del sistema de historias clínicas digitales y la plataforma de agendamiento en línea, reduciendo tiempos de espera en un 60%.</div>
                </div>
            </div>
            <div class="tl-item">
                <div class="tl-dot-wrap">
                    <div class="tl-dot">2024</div>
                </div>
                <div class="tl-content">
                    <div class="tl-year">2024</div>
                    <div class="tl-title">Clínica del futuro</div>
                    <div class="tl-desc">Lanzamiento de nuestra plataforma digital avanzada con inteligencia artificial para diagnóstico preventivo y tercera sucursal en Medellín.</div>
                </div>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="sec-tag">El equipo</div>
        <div class="sec-title">Nuestros <span>médicos</span></div>
        <div class="sec-sub">Especialistas comprometidos con tu bienestar</div>
        <div class="team-grid">
            <div class="team-card">
                <div class="team-avatar">👨‍⚕️</div>
                <div class="team-name">Dr. Juan Pérez</div>
                <div class="team-role">Medicina General</div>
                <div class="team-desc">15 años de experiencia en atención primaria y diagnóstico temprano.</div>
            </div>
            <div class="team-card">
                <div class="team-avatar">👨‍⚕️</div>
                <div class="team-name">Dr. Breyner Camilo</div>
                <div class="team-role">Endocrinología</div>
                <div class="team-desc">Especialista en tiroides y enfermedades metabólicas con 12 años de trayectoria.</div>
            </div>
            <div class="team-card">
                <div class="team-avatar">👨‍⚕️</div>
                <div class="team-name">Dr. Fredy Mogica</div>
                <div class="team-role">Radiología</div>
                <div class="team-desc">Experto en ecografía abdominal y diagnóstico por imágenes avanzado.</div>
            </div>
            <div class="team-card">
                <div class="team-avatar">👩‍⚕️</div>
                <div class="team-name">Dr. Laura Rojas</div>
                <div class="team-role">Cirugía General</div>
                <div class="team-desc">Cirujana con más de 800 procedimientos exitosos y enfoque en medicina mínimamente invasiva.</div>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="sec-tag">Nuestros valores</div>
        <div class="sec-title">Lo que nos <span>define</span></div>
        <div class="sec-sub">Los principios que guían cada decisión que tomamos</div>
        <div class="valores-grid">
            <div class="valor-card">
                <div class="valor-icon">🎯</div>
                <div class="valor-title">Precisión diagnóstica</div>
                <div class="valor-desc">Utilizamos tecnología de punta para garantizar diagnósticos certeros y tratamientos efectivos en el menor tiempo posible.</div>
            </div>
            <div class="valor-card">
                <div class="valor-icon">🤝</div>
                <div class="valor-title">Atención humanizada</div>
                <div class="valor-desc">Cada paciente es único. Nos tomamos el tiempo necesario para escuchar, entender y acompañar en cada proceso médico.</div>
            </div>
            <div class="valor-card">
                <div class="valor-icon">🔬</div>
                <div class="valor-title">Innovación constante</div>
                <div class="valor-desc">Invertimos en investigación y en las últimas tecnologías médicas para ofrecerte siempre lo mejor de la ciencia.</div>
            </div>
            <div class="valor-card">
                <div class="valor-icon">🛡️</div>
                <div class="valor-title">Seguridad del paciente</div>
                <div class="valor-desc">Protocolos estrictos de bioseguridad y calidad en cada procedimiento para garantizar tu tranquilidad.</div>
            </div>
            <div class="valor-card">
                <div class="valor-icon">🌍</div>
                <div class="valor-title">Acceso universal</div>
                <div class="valor-desc">Creemos que la salud de calidad debe ser un derecho, no un privilegio. Trabajamos para hacerla accesible a todos.</div>
            </div>
            <div class="valor-card">
                <div class="valor-icon">⚡</div>
                <div class="valor-title">Respuesta inmediata</div>
                <div class="valor-desc">Sistema de atención ágil con tiempos de espera mínimos y disponibilidad de citas en menos de 24 horas.</div>
            </div>
        </div>
    </div>

    <div class="footer">
        <div class="footer-brand">CLINICA © 2026</div>
        <div class="footer-line">Sistema de salud avanzada · Colombia</div>
    </div>

</body>
</html>