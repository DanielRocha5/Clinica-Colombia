@extends('layouts.menuAdmin')

@section('title', 'Inicio Admin')

@section('content')

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
        <a href="{{ route('admin.citas') }}" class="btn-cta">Ver citas solicitadas</a>
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

@endsection

@section('scripts')
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
    if(t < 10) return mid;
    if(t < 15) return mid - 4;
    if(t < 20) return mid + 4;
    if(t < 25) return mid - 22;
    if(t < 28) return mid + 18;
    if(t < 33) return mid - 6;
    if(t < 40) return mid + 2;
    if(t < 55) return mid + 6;
    if(t < 65) return mid - 6;
    return mid;
}

function draw() {
    const W = canvas.width;
    ctx.clearRect(0, 0, W, H);
    x += speed;
    points.push({ x: W, y: ecgPoint(x) });
    for(let i = 0; i < points.length; i++) points[i].x -= speed;
    points = points.filter(p => p.x > 0);

    if(points.length > 1) {
        ctx.beginPath();
        ctx.moveTo(points[0].x, points[0].y);
        for(let i = 1; i < points.length; i++) ctx.lineTo(points[i].x, points[i].y);
        ctx.strokeStyle = '#00ff88';
        ctx.lineWidth = 2;
        ctx.shadowColor = '#00ff88';
        ctx.shadowBlur = 8;
        ctx.stroke();
        ctx.shadowBlur = 0;
    }

    frameCount++;
    if(frameCount % 180 === 0) {
        bpm = 65 + Math.floor(Math.random() * 20);
        bpmEl.textContent = bpm;
    }
    requestAnimationFrame(draw);
}
draw();
</script>
@endsection