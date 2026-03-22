<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VentaVueloPasajeroSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('venta_vuelos_pasajeros')->insert([
            // Pasajero 1 - Tramo 1 (Lima→Cusco)
            [
                'venta_vuelo_tramo_id' => 1,
                'numero_asiento' => '12A',
                'dni' => '45678912',
                'nombre' => 'Roberto Flores Quispe',
                'fecha_nacimiento' => '1985-03-15',
                'numero_pasaporte' => 'PE45678912',
                'fecha_vencimiento_pasaporte' => '2027-06-20',
                'pais_emision_pasaporte' => 'Perú',
                'certificado_fiebre_amarilla' => 'FA2024-001',
                'fecha_vacunacion_fiebre_amarilla' => '2024-08-10',
                'certificado_valido_hasta' => '2034-08-10',
                'check_in_realizado' => false,
                'fecha_check_in' => null,
                'usuario_check_in' => null,
                'observaciones_check_in' => null,
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Pasajero 2 - Tramo 1 (Lima→Cusco)
            [
                'venta_vuelo_tramo_id' => 1,
                'numero_asiento' => '12B',
                'dni' => '46789012',
                'nombre' => 'Ana María Flores Ramos',
                'fecha_nacimiento' => '1988-09-22',
                'numero_pasaporte' => null,
                'fecha_vencimiento_pasaporte' => null,
                'pais_emision_pasaporte' => null,
                'certificado_fiebre_amarilla' => null,
                'fecha_vacunacion_fiebre_amarilla' => null,
                'certificado_valido_hasta' => null,
                'check_in_realizado' => false,
                'fecha_check_in' => null,
                'usuario_check_in' => null,
                'observaciones_check_in' => null,
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Pasajero 1 en tramo 3 (Lima→Cusco Sky)
            [
                'venta_vuelo_tramo_id' => 3,
                'numero_asiento' => '5F',
                'dni' => null,
                'nombre' => 'Sarah Johnson',
                'fecha_nacimiento' => '1990-07-22',
                'numero_pasaporte' => 'US987654321',
                'fecha_vencimiento_pasaporte' => '2028-01-15',
                'pais_emision_pasaporte' => 'Estados Unidos',
                'certificado_fiebre_amarilla' => 'US-YF-2025',
                'fecha_vacunacion_fiebre_amarilla' => '2025-01-15',
                'certificado_valido_hasta' => '2035-01-15',
                'check_in_realizado' => true,
                'fecha_check_in' => '2026-04-04 20:00:00',
                'usuario_check_in' => 'maria.lopez',
                'observaciones_check_in' => 'Check-in web realizado, boarding pass enviado por email',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
