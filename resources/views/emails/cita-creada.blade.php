<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Cita</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #0a0a1a; padding: 40px 0; }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #0d0d1f;
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid rgba(0,255,136,0.2);
            box-shadow: 0 0 40px rgba(0,255,136,0.08), 0 0 80px rgba(0,100,255,0.05);
        }

        .header {
            background: linear-gradient(135deg, #0d0d1f 0%, #0a1628 100%);
            padding: 40px;
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
            font-weight: 600;
        }
        .header h1 { font-size: 26px; font-weight: 800; color: #fff; letter-spacing: 1px; }
        .header h1 span { color: #00ff88; }
        .header .subtitle { font-size: 13px; color: rgba(255,255,255,0.4); margin-top: 6px; letter-spacing: 1px; }

        .greeting { padding: 32px 40px 0; }
        .greeting h2 { font-size: 19px; color: #fff; font-weight: 600; }
        .greeting h2 span { color: #00ff88; }
        .greeting p { color: rgba(255,255,255,0.5); font-size: 14px; margin-top: 8px; line-height: 1.7; }

        .card {
            margin: 28px 40px;
            background: rgba(255,255,255,0.02);
            border: 1px solid rgba(0,255,136,0.15);
            border-radius: 12px;
            overflow: hidden;
        }
        .card-header {
            background: rgba(0,255,136,0.06);
            border-bottom: 1px solid rgba(0,255,136,0.15);
            padding: 14px 20px;
        }
        .card-header span { color: #00ff88; font-size: 12px; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; }
        .row { display: flex; align-items: center; padding: 14px 20px; border-bottom: 1px solid rgba(255,255,255,0.04); }
        .row:last-child { border-bottom: none; }
        .row .ico {
            width: 36px; height: 36px;
            background: rgba(0,255,136,0.06);
            border: 1px solid rgba(0,255,136,0.2);
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            font-size: 16px; margin-right: 16px; flex-shrink: 0;
        }
        .row .info .label { font-size: 10px; color: rgba(255,255,255,0.3); text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 3px; }
        .row .info .value { font-size: 15px; color: #fff; font-weight: 600; }
        .badge {
            display: inline-block; padding: 4px 14px; border-radius: 20px;
            font-size: 12px; font-weight: 600;
            background: rgba(255,193,7,0.1); color: #ffc107;
            border: 1px solid rgba(255,193,7,0.3);
        }

        .divider { height: 1px; background: linear-gradient(90deg, transparent, rgba(0,255,136,0.3), transparent); margin: 0 40px; }

        .note {
            margin: 24px 40px;
            background: rgba(255,193,7,0.04);
            border: 1px solid rgba(255,193,7,0.2);
            border-left: 3px solid #ffc107;
            border-radius: 8px;
            padding: 14px 18px;
        }
        .note p { font-size: 13px; color: rgba(255,255,255,0.5); line-height: 1.6; }
        .note p strong { color: #ffc107; }

        .footer {
            background: rgba(0,0,0,0.3);
            border-top: 1px solid rgba(0,255,136,0.08);
            padding: 24px 40px; text-align: center;
        }
        .footer .clinic-name { color: #00ff88; font-size: 13px; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; margin-bottom: 6px; }
        .footer p { font-size: 12px; color: rgba(255,255,255,0.25); line-height: 1.6; }
        .line { width: 40px; height: 2px; background: linear-gradient(90deg, transparent, #00ff88, transparent); margin: 12px auto; }
    </style>
</head>
<body>
<div class="container">

    <div class="header">
        <div class="logo-wrap">
            <img src="https://i.postimg.cc/L5hWSM5z/logo.png" alt="Logo Clínica Colombia" style="width:60px;height:60px;object-fit:contain;">
        </div>
        <div class="tag">Sistema de Salud</div>
        <h1>Clínica <span>Colombia</span></h1>
        <p class="subtitle">Confirmación de cita médica</p>
    </div>

    <div class="greeting">
        <h2>Hola, <span>{{ $user->nombre }} {{ $user->apellido }}</span> 👋</h2>
        <p>Tu cita ha sido agendada exitosamente en nuestro sistema. A continuación encontrarás el resumen completo de tu cita médica.</p>
    </div>

    <div class="card">
        <div class="card-header">
            <span>📋 Detalle de la cita</span>
        </div>
        <div class="row">
            <div class="ico">📅</div>
            <div class="info">
                <div class="label">Fecha</div>
                <div class="value">{{ \Carbon\Carbon::parse($cita->fecha)->format('d/m/Y') }}</div>
            </div>
        </div>
        <div class="row">
            <div class="ico">⏰</div>
            <div class="info">
                <div class="label">Hora</div>
                <div class="value">{{ substr($cita->hora, 0, 5) }}</div>
            </div>
        </div>
        <div class="row">
            <div class="ico">🩺</div>
            <div class="info">
                <div class="label">Especialidad</div>
                <div class="value">{{ $cita->especialidad }}</div>
            </div>
        </div>
        <div class="row">
            <div class="ico">📌</div>
            <div class="info">
                <div class="label">Estado</div>
                <div class="value"><span class="badge">⏳ Pendiente de confirmación</span></div>
            </div>
        </div>
    </div>

    <div class="divider"></div>

    <div class="note">
        <p>⚠️ <strong>Importante:</strong> Tu cita está pendiente de confirmación por parte de nuestro equipo médico. Recibirás una notificación cuando sea aceptada.</p>
    </div>

    <div class="footer">
        <div class="clinic-name">Clínica Colombia</div>
        <div class="line"></div>
        <p>Este correo fue generado automáticamente por nuestro sistema.<br>Por favor no respondas a este mensaje.</p>
    </div>

</div>
</body>
</html>