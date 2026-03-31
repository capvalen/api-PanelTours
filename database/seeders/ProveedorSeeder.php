<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProveedorSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('proveedores')->insert([
            [
                'ruc' => '00000000',
                'razon_social' => 'Ninguno',
                'direccion' => '',
                'contacto' => '',
                'celular' => '',
                'banco' => '',
                'numero_cuenta' => '',
                'categoria' => 'local',
                'archivos' => null,
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ruc' => '20601234567',
                'razon_social' => 'Hotel Libertador Cusco',
                'direccion' => 'Plazoleta Santo Domingo 259, Cusco',
                'contacto' => 'Reservas Hotel',
                'celular' => '984123456',
                'banco' => 'BCP',
                'numero_cuenta' => '19128734561098',
                'categoria' => 'alojamiento',
                'archivos' => null,
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ruc' => '20602345678',
                'razon_social' => 'Transportes Cruz del Sur S.A.',
                'direccion' => 'Av. Javier Prado 1109, La Victoria, Lima',
                'contacto' => 'Área Comercial',
                'celular' => '975234567',
                'banco' => 'Interbank',
                'numero_cuenta' => '20031456789012',
                'categoria' => 'transporte',
                'archivos' => null,
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ruc' => '20603456789',
                'razon_social' => 'Restaurante La Mar Cebichería',
                'direccion' => 'Av. La Mar 770, Miraflores, Lima',
                'contacto' => 'Gerencia',
                'celular' => '966345678',
                'banco' => 'BBVA',
                'numero_cuenta' => '01134567890123',
                'categoria' => 'restaurant',
                'archivos' => null,
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ruc' => '20604567890',
                'razon_social' => 'Centro de Convenciones Cusco',
                'direccion' => 'Av. El Sol 602, Cusco',
                'contacto' => 'Administración',
                'celular' => '957456789',
                'banco' => 'Scotiabank',
                'numero_cuenta' => '00912345678901',
                'categoria' => 'local',
                'archivos' => null,
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ruc' => '20605678901',
                'razon_social' => 'Agencia Inca Trail Adventures',
                'direccion' => 'Calle Plateros 348, Cusco',
                'contacto' => 'Operaciones',
                'celular' => '948567890',
                'banco' => 'BCP',
                'numero_cuenta' => '19156789012345',
                'categoria' => 'agencia',
                'archivos' => null,
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
