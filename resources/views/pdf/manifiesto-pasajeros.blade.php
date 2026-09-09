<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Manifiesto Pasajeros {{ $logistica->titulo }}</title>
    <style>
        @page { margin: 8mm; size: portrait; }
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            color: #222;
        }
        .header {
            text-align: center;
            margin-bottom: 5mm;
        }
        .header img { max-width: 60mm; max-height: 18mm; }
        .header h2 { margin: 2mm 0 1mm; font-size: 16px; }
        .header p { margin: 0; font-size: 12px; color: #555; }
        .info-grid {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 4mm;
        }
        .info-grid td {
            padding: 1mm 2mm;
            font-size: 12px;
            vertical-align: top;
        }
        .info-grid td.label { font-weight: bold; width: 30mm; }
        table.passengers {
            width: 100%;
            border-collapse: collapse;
            margin-top: 4mm;
        }
        table.passengers th {
            background: #eee;
            padding: 1.5mm 2mm;
            font-size: 12px;
            text-align: left;
            border: 1px solid #ccc;
        }
        table.passengers td {
            padding: 1.5mm 2mm;
            font-size: 12px;
            border: 1px solid #ccc;
        }
        .check-cell {
            text-align: center;
            width: 40px;
        }
        .check-cell .box {
            display: inline-block;
            width: 16px;
            height: 16px;
            border: 2px solid #333;
            border-radius: 2px;
        }
        .footer {
            text-align: center;
            font-size: 9px;
            color: #888;
            margin-top: 5mm;
            border-top: 1px dashed #333;
            padding-top: 2mm;
        }
    </style>
</head>
<body>
    <div class="header">
        <table style="margin: 0 auto; border-collapse: collapse;">
            <tr>
                <td style="width: 80px; vertical-align: middle; text-align: center;">
                    <img src="data:image/webp;base64,{{ $logoBase64 }}" alt="Logo" style="max-width: 70px;">
                </td>
                <td style="vertical-align: middle; text-align: center;">
                    <h2 style="margin: 0; font-size: 16px;">MANIFIESTO DE PASAJEROS</h2>
                    <p style="margin: 0; font-size: 12px; color: #555;">{{ $logistica->titulo }} - {{ \Carbon\Carbon::parse($logistica->fecha)->format('d/m/Y') }}</p>
                </td>
            </tr>
        </table>
    </div>

    <table class="info-grid">
        <tr>
            <td class="label">Salida:</td>
            <td>{{ $logistica->titulo }}</td>
            <td class="label">Fecha:</td>
            <td>{{ \Carbon\Carbon::parse($logistica->fecha)->format('d/m/Y') }}</td>
        </tr>
        <tr>
            <td class="label">Destino:</td>
            <td>{{ $logistica->destino ?? '-' }}</td>
            <td class="label">Lugar:</td>
            <td>{{ $logistica->lugar ?? '-' }}</td>
        </tr>
        @if($logistica->guia)
        <tr>
            <td class="label">Guía:</td>
            <td colspan="3">{{ $logistica->guia->nombre }} ({{ $logistica->guia->celular ?? '-' }})</td>
        </tr>
        @endif
        @if($logistica->vehiculo)
        <tr>
            <td class="label">Vehículo:</td>
            <td colspan="3">{{ $logistica->vehiculo->placa }} - {{ $logistica->vehiculo->tipo_vehiculo }} / Conductor: {{ $logistica->vehiculo->nombre_conductor ?? '-' }}</td>
        </tr>
        @endif
    </table>

    <table class="passengers">
        <thead>
            <tr>
                <th style="width: 30px;">N°</th>
                <th>DNI</th>
                <th>Nombre</th>
                <th>Edad</th>
                <th class="check-cell">Check</th>
            </tr>
        </thead>
        <tbody>
            @php $contador = 0; @endphp
            @foreach($logistica->ventas as $venta)
                @foreach($venta->personas ?? [] as $persona)
                    @php
                        $contador++;
                        $edad = null;
                        if ($persona->fecha_nacimiento) {
                            $edad = \Carbon\Carbon::parse($persona->fecha_nacimiento)->age;
                        }
                    @endphp
                    <tr>
                        <td style="text-align:center;">{{ $contador }}</td>
                        <td>{{ $persona->dni ?? '-' }}</td>
                        <td>{{ $persona->nombre }}</td>
                        <td>{{ $edad !== null ? $edad . ' años' : '-' }}</td>
                        <td class="check-cell"><span class="box"></span></td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>

    <p style="margin-top: 3mm; font-size: 12px;">
        Total pasajeros: {{ $contador }}
    </p>

    <div class="footer">
        <p>Generado el {{ now()->format('d/m/Y g:i a') }} · Grupo Euro Andino S.A.C.</p>
    </div>
</body>
</html>
