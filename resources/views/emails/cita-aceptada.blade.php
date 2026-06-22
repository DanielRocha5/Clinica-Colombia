<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cita Aceptada</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #0a0a1a; padding: 40px 0; }
        .container {
            max-width: 520px;
            margin: 0 auto;
            background: #0d0d1f;
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid rgba(0,255,136,0.2);
            box-shadow: 0 0 40px rgba(0,255,136,0.08);
        }

        .header {
            background: linear-gradient(135deg, #0d0d1f, #0a1628);
            padding: 36px 40px;
            text-align: center;
            border-bottom: 1px solid rgba(0,255,136,0.15);
        }
        .logo-wrap {
            width: 100px;
            height: 100px;
            background: transparent;
            border: 2px solid rgba(0,255,136,0.35);
            border-radius: 50%;
            margin: 0 auto 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 0 28px rgba(0,255,136,0.2);
            overflow: hidden;
        }
        .logo-wrap img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            display: block;
        }
        .tag {
            font-size: 10px;
            color: #00ff88;
            letter-spacing: 4px;
            text-transform: uppercase;
            margin-bottom: 8px;
        }
        .header h1 { font-size: 22px; font-weight: 800; color: #fff; }
        .header h1 span { color: #00ff88; }

        .body { padding: 32px 40px; text-align: center; }
        .main-msg { font-size: 20px; font-weight: 700; color: #fff; margin-bottom: 10px; }
        .main-msg span { color: #00ff88; }
        .sub-msg { font-size: 14px; color: rgba(255,255,255,0.45); line-height: 1.7; margin-bottom: 28px; }

        .cita-info {
            background: rgba(255,255,255,0.02);
            border: 1px solid rgba(0,255,136,0.1);
            border-radius: 10px;
            padding: 16px 20px;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 14px;
            text-align: left;
        }
        .cita-info .ico {
            width: 34px; height: 34px;
            background: rgba(0,255,136,0.06);
            border: 1px solid rgba(0,255,136,0.2);
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            font-size: 15px; flex-shrink: 0;
        }
        .cita-info .label { font-size: 10px; color: rgba(255,255,255,0.3); letter-spacing: 1px; text-transform: uppercase; }
        .cita-info .value { font-size: 14px; color: #fff; font-weight: 600; margin-top: 2px; }

        .footer {
            background: rgba(0,0,0,0.3);
            border-top: 1px solid rgba(0,255,136,0.08);
            padding: 20px 40px;
            text-align: center;
        }
        .footer .clinic { color: #00ff88; font-size: 12px; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; margin-bottom: 6px; }
        .footer p { font-size: 11px; color: rgba(255,255,255,0.2); line-height: 1.6; }
        .line { width: 40px; height: 1px; background: linear-gradient(90deg, transparent, #00ff88, transparent); margin: 10px auto; }
    </style>
</head>
<body>
<div class="container">

    <div class="header">
        <div class="logo-wrap">
            <img src="https://i.postimg.cc/L5hWSM5z/logo.png" alt="Logo Clínica Colombia" style="width:60px;height:60px;object-fit:contain;">
        </div>
        <div class="tag">Clínica Colombia</div>
        <h1>Tu cita fue <span>aceptada</span></h1>
    </div>

    <div class="body">
        <div class="main-msg">¡Hola, <span>{{ $user->nombre }}</span>!</div>
        <div class="sub-msg">
            Tu cita médica ha sido confirmada por nuestro equipo.<br>
            Ingresa a la plataforma para ver toda la información.
        </div>

        <div class="cita-info">
            <div class="ico">📅</div>
            <div>
                <div class="label">Fecha</div>
                <div class="value">{{ \Carbon\Carbon::parse($cita->fecha)->format('d/m/Y') }}</div>
            </div>
        </div>
        <div class="cita-info">
            <div class="ico">⏰</div>
            <div>
                <div class="label">Hora</div>
                <div class="value">{{ substr($cita->hora, 0, 5) }}</div>
            </div>
        </div>
        <div class="cita-info">
            <div class="ico">🩺</div>
            <div>
                <div class="label">Especialidad</div>
                <div class="value">{{ $cita->especialidad }}</div>
            </div>
        </div>
    </div>

    <div class="footer">
        <div class="clinic">Clínica Colombia</div>
        <div class="line"></div>
        <p>Este correo fue generado automáticamente.<br>Por favor no respondas a este mensaje.</p>
    </div>

</div>
</body>
</html>