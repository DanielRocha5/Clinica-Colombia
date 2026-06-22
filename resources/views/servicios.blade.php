<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servicios - Clínica</title>
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
                <a href="{{ route('citas.agendarCita') }}">Agenda tu cita</a>
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

    <div style="padding: 6rem 4rem 4rem; max-width: 1200px; margin: 0 auto;">

        <div style="text-align: center; margin-bottom: 4rem;">
            <div style="font-family: 'Orbitron', sans-serif; font-size: 11px; color: #00ff88; letter-spacing: 3px; margin-bottom: 12px;">LO QUE OFRECEMOS</div>
            <h1 style="font-family: 'Orbitron', sans-serif; font-size: 36px; color: #fff; margin: 0;">Nuestros <span style="color: #00ff88;">servicios</span></h1>
            <p style="color: #888; font-size: 16px; margin-top: 12px; max-width: 500px; margin-left: auto; margin-right: auto;">Atención médica integral con tecnología de vanguardia para tu bienestar.</p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem;">

            <div style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); border-radius: 16px; padding: 2rem;">
                <div style="font-size: 2.5rem; margin-bottom: 1rem;">🩺</div>
                <div style="font-family: 'Orbitron', sans-serif; font-size: 13px; color: #00ff88; margin-bottom: 8px;">CONSULTA GENERAL</div>
                <p style="color: #aaa; font-size: 14px; line-height: 1.7;">Atención médica general para diagnóstico, tratamiento y seguimiento de enfermedades comunes. Disponible para todas las edades.</p>
            </div>

            <div style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); border-radius: 16px; padding: 2rem;">
                <div style="font-size: 2.5rem; margin-bottom: 1rem;">🦋</div>
                <div style="font-family: 'Orbitron', sans-serif; font-size: 13px; color: #00ff88; margin-bottom: 8px;">CONSULTA DE TIROIDES</div>
                <p style="color: #aaa; font-size: 14px; line-height: 1.7;">Evaluación especializada de la glándula tiroides. Diagnóstico de hipotiroidismo, hipertiroidismo y nódulos tiroideos.</p>
            </div>

            <div style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); border-radius: 16px; padding: 2rem;">
                <div style="font-size: 2.5rem; margin-bottom: 1rem;">🔬</div>
                <div style="font-family: 'Orbitron', sans-serif; font-size: 13px; color: #00ff88; margin-bottom: 8px;">ECOGRAFÍA ABDOMINAL</div>
                <p style="color: #aaa; font-size: 14px; line-height: 1.7;">Examen de imagen para evaluar órganos abdominales como hígado, vesícula, riñones y páncreas con equipos de última generación.</p>
            </div>

            <div style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); border-radius: 16px; padding: 2rem;">
                <div style="font-size: 2.5rem; margin-bottom: 1rem;">🫀</div>
                <div style="font-family: 'Orbitron', sans-serif; font-size: 13px; color: #00ff88; margin-bottom: 8px;">CARDIOLOGÍA</div>
                <p style="color: #aaa; font-size: 14px; line-height: 1.7;">Evaluación y tratamiento de enfermedades del corazón. Electrocardiograma, ecocardiograma y monitoreo continuo.</p>
            </div>

            <div style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); border-radius: 16px; padding: 2rem;">
                <div style="font-size: 2.5rem; margin-bottom: 1rem;">🧠</div>
                <div style="font-family: 'Orbitron', sans-serif; font-size: 13px; color: #00ff88; margin-bottom: 8px;">NEUROLOGÍA</div>
                <p style="color: #aaa; font-size: 14px; line-height: 1.7;">Diagnóstico y tratamiento de enfermedades del sistema nervioso. Atención de migrañas, epilepsia y trastornos neurológicos.</p>
            </div>

            <div style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); border-radius: 16px; padding: 2rem;">
                <div style="font-size: 2.5rem; margin-bottom: 1rem;">🦴</div>
                <div style="font-family: 'Orbitron', sans-serif; font-size: 13px; color: #00ff88; margin-bottom: 8px;">ORTOPEDIA</div>
                <p style="color: #aaa; font-size: 14px; line-height: 1.7;">Tratamiento de lesiones y enfermedades del sistema músculo-esquelético. Fracturas, artritis y rehabilitación física.</p>
            </div>

            <div style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); border-radius: 16px; padding: 2rem;">
                <div style="font-size: 2.5rem; margin-bottom: 1rem;">👁️</div>
                <div style="font-family: 'Orbitron', sans-serif; font-size: 13px; color: #00ff88; margin-bottom: 8px;">OFTALMOLOGÍA</div>
                <p style="color: #aaa; font-size: 14px; line-height: 1.7;">Exámenes visuales completos, tratamiento de enfermedades oculares y cirugía refractiva con tecnología láser.</p>
            </div>

            <div style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); border-radius: 16px; padding: 2rem;">
                <div style="font-size: 2.5rem; margin-bottom: 1rem;">🧬</div>
                <div style="font-family: 'Orbitron', sans-serif; font-size: 13px; color: #00ff88; margin-bottom: 8px;">LABORATORIO CLÍNICO</div>
                <p style="color: #aaa; font-size: 14px; line-height: 1.7;">Análisis clínicos completos: sangre, orina, cultivos y pruebas especializadas con resultados en línea.</p>
            </div>

            <div style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); border-radius: 16px; padding: 2rem;">
                <div style="font-size: 2.5rem; margin-bottom: 1rem;">💊</div>
                <div style="font-family: 'Orbitron', sans-serif; font-size: 13px; color: #00ff88; margin-bottom: 8px;">FARMACIA</div>
                <p style="color: #aaa; font-size: 14px; line-height: 1.7;">Dispensación de medicamentos con asesoría farmacéutica especializada. Medicamentos de marca y genéricos disponibles.</p>
            </div>

        </div>

        <div style="text-align: center; margin-top: 4rem;">
            <p style="color: #888; font-size: 15px; margin-bottom: 1.5rem;">¿Listo para agendar tu cita?</p>
            @auth
                <a href="{{ route('citas.agendarCita') }}" class="btn-neon" style="padding: 14px 32px; font-size: 14px;">Agendar cita ahora</a>
            @else
                <a href="{{ route('iniciarSesion') }}" class="btn-neon" style="padding: 14px 32px; font-size: 14px;">Agendar cita ahora</a>
            @endauth
        </div>

    </div>

    <div class="footer">
        <div class="footer-brand">CLINICA © 2026</div>
        <div class="footer-line">Sistema de salud avanzada · Colombia</div>
    </div>

</div>
</body>
</html>