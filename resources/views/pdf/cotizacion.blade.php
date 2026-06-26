<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Cotización {{ $codigo }}</title>
    <style>
        @page { margin: 20px; }
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            color: #333;
            padding: 20px;
        }
        .header {
            border-bottom: 3px solid #023475;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }
        .header h1 {
            color: #023475;
            font-size: 22px;
            margin: 0;
        }
        .header .codigo {
            font-size: 14px;
            color: #666;
            margin-top: 5px;
        }
        .header .fecha {
            font-size: 11px;
            color: #999;
        }
        .section {
            margin-bottom: 20px;
        }
        .section-title {
            background: #023475;
            color: white;
            padding: 6px 12px;
            font-size: 13px;
            font-weight: bold;
            border-radius: 4px;
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        table.info td {
            padding: 4px 8px;
            font-size: 12px;
        }
        table.info td.label {
            width: 120px;
            color: #666;
            font-weight: bold;
        }
        table.info td.value {
            font-weight: normal;
        }
        table.items {
            border: 1px solid #ddd;
        }
        table.items th {
            background: #f0f4f8;
            padding: 8px 10px;
            font-size: 11px;
            text-align: left;
            border-bottom: 2px solid #ddd;
            text-transform: uppercase;
        }
        table.items td {
            padding: 7px 10px;
            border-bottom: 1px solid #eee;
            font-size: 11px;
        }
        table.items tr:last-child td {
            border-bottom: none;
        }
        .text-end { text-align: right; }
        .text-center { text-align: center; }
        .fw-bold { font-weight: bold; }
        .total-row td {
            font-size: 14px;
            font-weight: bold;
            padding: 10px;
            border-top: 2px solid #023475;
        }
        .footer {
            margin-top: 30px;
            padding-top: 15px;
            border-top: 1px solid #ddd;
            font-size: 10px;
            color: #999;
            text-align: center;
        }
        .badge {
            display: inline-block;
            padding: 2px 8px;
            font-size: 10px;
            border-radius: 10px;
            background: #5a5a5a;
            color: white;
        }
        .resumen-box {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 12px;
            margin-top: 10px;
        }
        .resumen-box .total-final {
            font-size: 20px;
            font-weight: bold;
            color: #023475;
        }
    </style>
</head>
<body>
    <div class="header">
        <table style="width: 100%;">
            <tr>
                <td style="width: 90px;">
                    <img src="{{ $logoBase64 }}" alt="Logo" style="max-width: 80px; max-height: 60px;">
                </td>
                <td>
                    <h1 class="mb-0">Grupo Euro Andino S.A.C.</h1>
                    <div style="font-size: 10px; color: #023475; font-weight: bold; margin-top: 2px;">RUC: 20568390629</div>
                    <div style="font-size: 10px; color: #666;">Dirección: Cal. Independencia N° 415 - El Tambo - Huancayo - Junín</div>
                    <div style="font-size: 10px; color: #666;">Contacto: 947614293</div>
                </td>
                <td style="text-align: right;">
                    <div class="codigo">{{ $codigo }}</div>
                    <div class="fecha">Fecha de cotización: {{ \Carbon\Carbon::parse($cotizacion->fecha)->format('d/m/Y') }}</div>
                    <div style="margin-top: 5px;"><span class="badge">Cotización en curso</span></div>
                </td>
            </tr>
        </table>
    </div>

    @if(count($tourData['fotosBase64'] ?? []) > 0)
        <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
            <tr>
                <td style="width: 50%; vertical-align: top; padding: 5px;">
                    <img src="{{ $tourData['fotosBase64'][0] ?? '' }}" style="width: 100%; height: 260px; object-fit: cover; border-radius: 4px;">
                </td>
                <td style="width: 50%; vertical-align: top;">
                  <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                      <td style="width: 50%; padding: 3px;">
                          <img src="{{ $tourData['fotosBase64'][1] ?? '' }}" style="width: 100%; height: 128px; object-fit: cover; border-radius: 4px;">
                      </td>
                      <td style="width: 50%; padding: 3px;">
                          <img src="{{ $tourData['fotosBase64'][2] ?? '' }}" style="width: 100%; height: 128px; object-fit: cover; border-radius: 4px;">
                      </td>
                    </tr>
                    <tr>
                      <td style="width: 50%; padding: 3px;">
                          <img src="{{ $tourData['fotosBase64'][3] ?? '' }}" style="width: 100%; height: 128px; object-fit: cover; border-radius: 4px;">
                      </td>
                      <td style="width: 50%; padding: 3px;">
                          <img src="{{ $tourData['fotosBase64'][4] ?? '' }}" style="width: 100%; height: 128px; object-fit: cover; border-radius: 4px;">
                      </td>
                    </tr>
                  </table>
                </td>
            </tr>
        </table>
    @endif

    <div class="section">
        <div class="section-title">Datos del Cliente</div>
        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                <td style="width: 50%; vertical-align: top;">
                    <table class="info">
                        <tr>
                            <td class="label">Nombre / Razón Social:</td>
                            <td class="value">{{ $cliente->razon_social ?? ($cliente->apellidos . ' ' . $cliente->nombres) }}</td>
                        </tr>
                        <tr>
                            <td class="label">DNI / RUC:</td>
                            <td class="value">{{ $cliente->dni ?? $cliente->ruc ?? '-' }}</td>
                        </tr>
                    </table>
                </td>
                <td style="width: 50%; vertical-align: top;">
                    <table class="info">
                        <tr>
                            <td class="label">Celular:</td>
                            <td class="value">{{ $cliente->celular ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="label">Nacionalidad:</td>
                            <td class="value">{{ ucfirst($cotizacion->nacionalidad ?? 'Peruana') }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>

    <div class="section">
        <div class="section-title">Datos del Viaje</div>
        <table class="info">
            <tr>
                <td class="label">Destino:</td>
                <td class="value">{{ $cotizacion->departamento->departamento ?? '-' }}</td>
                <td style="padding: 4px 8px;">
                    <span style="color: #666; font-weight: bold;">Adultos:</span> {{ $cotizacion->adults ?? 0 }}
                </td>
                <td style="padding: 4px 8px;">
                    <span style="color: #666; font-weight: bold;">Niños:</span> {{ $cotizacion->kids ?? 0 }}
                </td>
                <td style="padding: 4px 8px;">
                    <span style="color: #666; font-weight: bold;">Total:</span> {{ $cotizacion->cuantas_personas ?? ($cotizacion->adults + $cotizacion->kids) }}
                </td>
            </tr>
        </table>
    </div>

    <div class="section">
        <div class="section-title">Servicios Cotizados</div>
        @if(count($items) > 0)
            <table class="items">
                <thead>
                    <tr>
                        <th style="width: 30px;">#</th>
                        <th>Tipo</th>
                        <th>Servicio</th>
                        <th class="text-end">P. Adulto</th>
                        <th class="text-end">P. Niño</th>
                        <th class="text-end">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $index => $item)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}.</td>
                            <td>{{ ucfirst($item->tipo) }}</td>
                            <td>{{ $item->descripcion ?? '-' }}</td>
                            <td class="">S/ {{ number_format($item->precio_adulto, 2) }}</td>
                            <td class="">S/ {{ number_format($item->precio_kids, 2) }}</td>
                            <td class="fw-bold">S/ {{ number_format($item->precio, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p style="color: #999; text-align: center;">Sin servicios registrados</p>
        @endif

        <div class="resumen-box" style="text-align: right;">
            <div style="font-size: 14px; color: #666;">Total a pagar</div>
            <div class="total-final">S/ {{ number_format($total, 2) }}</div>
        </div>
    </div>

    @if($tourData)
			<div class="section">
					<div class="section-title">Detalles del Tour</div>
					@if($tourData['nombre'])
							<h2 style="font-size: 16px; color: #023475; margin-bottom: 12px;">{!! $tourData['nombre'] !!}</h2>
					@endif

					@if($tourData['descripcion'])
							<p style="margin-bottom: 8px;"><strong>Descripción:</strong></p>
							<div style="font-size: 11px; color: #555; margin-bottom: 12px;">{!! $tourData['descripcion'] !!}</div>
					@endif

					@if($tourData['partida'])
							<p style="margin-bottom: 8px;"><strong>Punto de partida:</strong></p>
							<div style="font-size: 11px; color: #555; margin-bottom: 12px;">{!! $tourData['partida'] !!}</div>
					@endif

					@if($tourData['itinerario'])
							<p style="margin-bottom: 8px;"><strong>Itinerario:</strong></p>
							<div style="font-size: 11px; color: #555; margin-bottom: 12px;">{!! $tourData['itinerario'] !!}</div>
					@endif

					@if($tourData['incluidos'])
							<p style="margin-bottom: 8px;"><strong>Incluye:</strong></p>
							<div style="font-size: 11px; color: #555; margin-bottom: 12px;">{!! $tourData['incluidos'] !!}</div>
					@endif

					@if($tourData['noincluidos'])
							<p style="margin-bottom: 8px;"><strong>No incluye:</strong></p>
							<div style="font-size: 11px; color: #555; margin-bottom: 12px;">{!! $tourData['noincluidos'] !!}</div>
					@endif
			</div>
    @endif

    @if($cotizacion->ruta || count($cotizacion->servicios ?? []) > 0 || count($cotizacion->incluye ?? []) > 0 || count($cotizacion->no_incluye ?? []) > 0)
			<div class="section">
					<div class="section-title">Información Extra</div>

					@if($cotizacion->ruta)
							<p style="margin-bottom: 8px;"><strong>Ruta:</strong></p>
							<div style="font-size: 11px; color: #555; margin-bottom: 12px;">{{ $cotizacion->ruta }}</div>
					@endif

					@if(count($cotizacion->servicios ?? []) > 0)
							<p style="margin-bottom: 4px;"><strong>Servicios:</strong></p>
							<ul style="font-size: 11px; color: #555; margin-bottom: 12px; padding-left: 20px;">
									@foreach($cotizacion->servicios as $srv)
											<li>{{ $srv }}</li>
									@endforeach
							</ul>
					@endif

					@if(count($cotizacion->incluye ?? []) > 0)
							<p style="margin-bottom: 4px;"><strong>Incluye:</strong></p>
							<ul style="font-size: 11px; color: #555; margin-bottom: 12px; padding-left: 20px;">
									@foreach($cotizacion->incluye as $inc)
											<li>{{ $inc }}</li>
									@endforeach
							</ul>
					@endif

					@if(count($cotizacion->no_incluye ?? []) > 0)
							<p style="margin-bottom: 4px;"><strong>No incluye:</strong></p>
							<ul style="font-size: 11px; color: #555; margin-bottom: 12px; padding-left: 20px;">
									@foreach($cotizacion->no_incluye as $noinc)
											<li>{{ $noinc }}</li>
									@endforeach
							</ul>
					@endif
			</div>
    @endif

    <div class="footer">
        <p>Grupo Euro Andino - Cotización generada el {{ now()->format('d/m/Y H:i a') }}</p>
        <p>Este documento es una cotización informativa, no constituye una factura o comprobante de pago.</p>
        <p>Visite nuestra web: <a href="https://grupoeuroandino.com" style="color: #023475; text-decoration: none;">https://grupoeuroandino.com</a></p>
    </div>
</body>
</html>
