<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Ticket de Pago {{ $codigo }}</title>
    <style>
        @page {
            margin: 0;
            padding: 0;
        }
        body {
            font-family: 'DejaVu Sans Mono', 'DejaVu Sans', monospace;
            font-size: 10px;
            color: #222;
            width: 74mm;
            margin: 0 auto;
            padding: 2mm 3mm;
        }
        .center {
            text-align: center;
        }
        .logo {
            text-align: center;
            margin-bottom: 2mm;
        }
        .logo img {
            max-width: 50mm;
            max-height: 15mm;

        }
        .empresa {
            font-size: 14px;
            font-weight: bold;
            text-align: center;
            letter-spacing: 1px;
            margin-bottom: 1mm;
        }
        .codigo {
            text-align: center;
            font-size: 11px;
            font-weight: bold;
            margin-bottom: 1mm;
        }
        .fecha {
            text-align: center;
            font-size: 9px;
            color: #666;
            margin-bottom: 2mm;
        }
        hr {
            border: none;
            border-top: 1px dashed #333;
            margin: 2mm 0;
        }
        .section-title {
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 1mm;
            
            padding-bottom: 0.5mm;
        }
        table.info {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1mm;
        }
        table.info td {
            padding: 0.5mm 0;
            font-size: 9px;
            vertical-align: top;
        }
        table.info td.label {
            width: 32mm;
            color: #555;
        }
        table.info td.value {
            font-weight: bold;
        }
        .total-box {
            text-align: center;            
            padding: 2mm;
            
        }
        .total-box .label {
            font-size: 8px;
            text-transform: uppercase;
            color: #555;
        }
        .total-box .monto {
            font-size: 18px;
            font-weight: bold;
        }
        .total-box .saldo {
            font-size: 9px;
            margin-top: 1mm;
        }
        .footer {
            text-align: center;
            font-size: 7px;
            color: #888;
            margin-top: 2mm;
            border-top: 1px dashed #333;
            padding-top: 2mm;
        }
        .footer p {
            margin: 0.5mm 0;
        }
        .estado-box {
            text-align: center;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 2px;
            padding: 1mm 0;
        }
    </style>
</head>
<body>
    <div class="logo">
        <img src="data:image/webp;base64,{{ $logoBase64 }}" alt="Logo">
    </div>

    <div class="empresa">GRUPO EUROANDINO S.A.C.</div>
    <div style="text-align:center;font-size:8px;color:#555;margin-bottom:1mm;">RUC 1111111110</div>
    <div class="codigo">{{ $codigo }}</div>
    <div class="fecha">{{ \Carbon\Carbon::parse($pago->fecha)->format('d/m/Y g:i a') }}</div>

    <hr>

    <div class="section-title">Cliente</div>
    <table class="info">
        <tr>
            <td class="label">Nombre</td>
            <td class="value">{{ $cliente->razon_social ?? ($cliente->apellidos . ' ' . $cliente->nombres) }}</td>
        </tr>
        <tr>
            <td class="label">DNI / RUC</td>
            <td class="value">{{ $cliente->dni ?? $cliente->ruc ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label">Celular</td>
            <td class="value">{{ $cliente->celular ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label">Venta</td>
            <td class="value">{{ $ventaCodigo }}</td>
        </tr>
        <tr>
            <td class="label">Método de pago</td>
            <td class="value">{{ ucfirst($pago->metodo_pago ?? '-') }}</td>
        </tr>
    </table>

    <hr>

    <div class="section-title">Servicios</div>
    <table class="">
        @foreach($items as $item)
        <tr>
            <td class="value" colspan="2">
                {{ ucfirst($item->tipo) }}: {{ $item->descripcion ?? '-' }}
                @if($item->destino) - {{ $item->destino }} @endif
            </td>
        </tr>
        @endforeach
    </table>
    
    <table class="info">
        @if($pago->observaciones)
        <tr>
            <td class="label">Observaciones</td>
            <td class="value">{{ $pago->observaciones }}</td>
        </tr>
        @endif
    </table>

    <div class="estado-box">
        @switch($pago->estado_pago)
            @case('pagado')
                --- PAGADO ---
                @break
            @case('adelantado')
                --- ADELANTO ---
                @break
            @case('pendiente')
                --- PENDIENTE ---
                @break
            @case('anulado')
                --- ANULADO ---
                @break
            @default
                {{ strtoupper($pago->estado_pago) }}
        @endswitch
    </div>

    <div class="total-box">
        <div class="label">Monto abonado</div>
        <div class="monto">S/ {{ number_format($pago->monto_abonado, 2) }}</div>
        @if($pago->saldo_pendiente > 0)
            <div class="saldo" style="color: #c00;">Saldo pendiente: S/ {{ number_format($pago->saldo_pendiente, 2) }}</div>
        @else
            <div class="saldo" style="color: #0a0;">PAGO COMPLETO</div>
        @endif
    </div>

    <div class="footer">
        <p>Generado el {{ now()->format('d/m/Y g:i a') }}</p>
        <p>Este documento es un comprobante interno de pago.</p>
    </div>
</body>
</html>
