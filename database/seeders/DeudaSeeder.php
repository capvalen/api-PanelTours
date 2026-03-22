<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeudaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('deudas')->insert([
            [
                'fecha_pago' => '2026-03-25',
                'monto' => 1200.00,
                'informacion' => 'Pago a Hotel Libertador por reserva grupo Flores - 4 noches habitación doble',
                'contacto_pagar' => 'Hotel Libertador - Reservas',
                'comprobante' => null,
                'medio_pago' => 'banco',
                'estado_pago' => 'pendiente',
                'codigo_referencia' => null,
                'activo' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'fecha_pago' => '2026-03-22',
                'monto' => 320.00,
                'informacion' => 'Comisión guía turístico Machu Picchu - Tour Johnson',
                'contacto_pagar' => 'Miguel Condori - 984567123',
                'comprobante' => 'RH-2026-015',
                'medio_pago' => 'yape',
                'estado_pago' => 'completado',
                'codigo_referencia' => 'YAPE-20260322-001',
                'activo' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'fecha_pago' => '2026-03-30',
                'monto' => 850.00,
                'informacion' => 'Pago LATAM boletos grupo Flores - vuelo LA2040/LA2041',
                'contacto_pagar' => 'LATAM Airlines - Agencias',
                'comprobante' => null,
                'medio_pago' => 'tarjeta',
                'estado_pago' => 'pendiente',
                'codigo_referencia' => null,
                'activo' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
