<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Manifiesto {{ $logistica->titulo }}</title>
    <style>
        @page { margin: 10mm; }
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
        .venta-title {
            background: #f5f5f5;
            font-weight: bold;
            padding: 1.5mm 2mm;
            font-size: 12px;
            border: 1px solid #ccc;
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
        <img src="data:image/webp;base64,{{ $logoBase64 }}" alt="Logo">
        <h2>MANIFIESTO DE PASAJEROS</h2>
        <p>{{ $logistica->titulo }} - {{ \Carbon\Carbon::parse($logistica->fecha)->format('d/m/Y') }}</p>
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
        <tr>
            <td class="label">Estado:</td>
            <td>{{ ucfirst($logistica->estado) }}</td>
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
        @if($logistica->usuario)
        <tr>
            <td class="label">Vendedor:</td>
            <td colspan="3">{{ $logistica->usuario->nombre ?? $logistica->usuario->usuario ?? '-' }}</td>
        </tr>
        @endif
    </table>

    @php
        $totalPasajeros = 0;
        $totalPersonas = 0;
    @endphp

    <table class="passengers">
        <thead>
            <tr>
                <th style="width: 30px;">N°</th>
                <th>Nombre</th>
                <th>DNI</th>
                <th>Cliente</th>
                <th>Celular</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logistica->ventas as $venta)
                @php
                    $personas = $venta->personas ?? [];
                    $totalPasajeros += count($personas);
                    $totalPersonas += (int)($venta->cuantas_personas ?? 0);
                @endphp
                @if(count($personas) > 0)
                    <tr>
                        <td colspan="5" class="venta-title">
                            {{ $venta->cliente->razon_social ?? ($venta->cliente->apellidos . ' ' . $venta->cliente->nombres) ?? 'Sin cliente' }}
                            @if($venta->ciudad) - {{ $venta->ciudad }} @endif
                        </td>
                    </tr>
                    @foreach($personas as $idx => $persona)
                        <tr>
                            <td style="text-align:center;">{{ $idx + 1 }}</td>
                            <td>{{ $persona->nombre }}
                                @if($persona->es_titular) <strong>(Titular)</strong> @endif
                            </td>
                            <td>{{ $persona->dni ?? '-' }}</td>
                            <td>{{ $venta->cliente->razon_social ?? ($venta->cliente->apellidos . ' ' . $venta->cliente->nombres) ?? '-' }}</td>
                            <td>{{ $venta->cliente->celular ?? '-' }}</td>
                        </tr>
                    @endforeach
                @endif
            @endforeach
        </tbody>
    </table>

    <p style="margin-top: 3mm; font-size: 12px;">
        Pasajeros inscritos: {{ $totalPasajeros }}/{{ $totalPersonas }}
        @if($totalPersonas - $totalPasajeros > 0)
            <span style="color: #c00;"> | Faltan check-in: {{ $totalPersonas - $totalPasajeros }}</span>
        @else
            <span style="color: #0a0;"> | Check-ins completos</span>
        @endif
    </p>

    <div class="footer">
        <p>Generado el {{ now()->format('d/m/Y g:i a') }}</p>
        <p>Grupo Euroandino S.A.C.</p>
    </div>
</body>
</html>
