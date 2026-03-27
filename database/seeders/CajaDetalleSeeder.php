<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CajaDetalleSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('caja_detalles')->insert([
            [
                'caja_id' => 2,
                'tipo' => 'ingreso',
                'categoria' => 'venta turismo',
                'monto' => 2350.00,
                'concepto' => 'Pago completo paquete Johnson - Cusco/Machu Picchu',
                'fecha' => '2026-03-20 10:30:00',
                'comprobante_pago' => 'boleta',
                'serie' => 'B001-00045',
                'venta_id' => 2,
                'observaciones' => 'Pago con tarjeta Visa',
								'proveedor_id' => 1,
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'caja_id' => 2,
                'tipo' => 'egreso',
                'categoria' => 'gasto operativo',
                'monto' => 150.00,
                'concepto' => 'Pago combustible transporte aeropuerto',
                'fecha' => '2026-03-20 12:00:00',
                'comprobante_pago' => 'ticket',
								'proveedor_id' => 1,
                'serie' => null,
                'venta_id' => null,
                'observaciones' => null,
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'caja_id' => 2,
                'tipo' => 'ingreso',
                'categoria' => 'venta turismo',
                'monto' => 1050.50,
                'concepto' => 'Adelanto paquete Torres - Puno',
                'fecha' => '2026-03-20 15:00:00',
                'comprobante_pago' => 'factura',
                'serie' => 'F001-00012',
                'venta_id' => 4,
                'observaciones' => 'Adelanto del 50%, saldo pendiente',
								'proveedor_id' => 1,
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
