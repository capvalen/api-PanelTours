<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HospedajeSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('hospedajes')->insert([
            [
                'hospedaje' => 'Hotel Libertador Cusco',
                'direccion' => 'Plazoleta Santo Domingo 259, Cusco',
                'contacto' => 'Reservas Hotel',
                'celular' => '984123456',
                'correo' => 'reservas@libertador.com.pe',
                'departamento_id' => 8, // Cusco
                'incluye_desayuno' => true,
                'incluye_estacionamiento' => true,
                'incluye_wifi' => true,
                'servicios_extra' => 'Spa, lavandería, room service 24h, bar',
                'activo' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'hospedaje' => 'Casa Andina Premium Valle Sagrado',
                'direccion' => 'Quinta Vivero s/n, Valle Sagrado, Urubamba',
                'contacto' => 'Front Desk',
                'celular' => '974234567',
                'correo' => 'vallesagrado@casa-andina.com',
                'departamento_id' => 8, // Cusco
                'incluye_desayuno' => true,
                'incluye_estacionamiento' => true,
                'incluye_wifi' => true,
                'servicios_extra' => 'Piscina temperada, restaurante gourmet, jardines',
                'activo' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'hospedaje' => 'Sonesta Hotel Arequipa',
                'direccion' => 'Portal de Flores 116, Plaza de Armas, Arequipa',
                'contacto' => 'Atención al huésped',
                'celular' => '954345678',
                'correo' => 'arequipa@sonesta.com',
                'departamento_id' => 4, // Arequipa
                'incluye_desayuno' => true,
                'incluye_estacionamiento' => false,
                'incluye_wifi' => true,
                'servicios_extra' => 'Restaurante, terraza panorámica',
                'activo' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'hospedaje' => 'Hotel Paracas',
                'direccion' => 'Av. Paracas s/n, Paracas, Ica',
                'contacto' => 'Reservaciones',
                'celular' => '964456789',
                'correo' => 'info@hotelparacas.com',
                'departamento_id' => 11, // Ica
                'incluye_desayuno' => true,
                'incluye_estacionamiento' => true,
                'incluye_wifi' => true,
                'servicios_extra' => 'Piscina infinita, spa, playa privada, kayak',
                'activo' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'hospedaje' => 'Aranwa Sacred Valley',
                'direccion' => 'Antigua Hacienda Yaravilca, Huayllabamba, Urubamba',
                'contacto' => 'Guest Relations',
                'celular' => '984567890',
                'correo' => 'sacredvalley@aranwahotels.com',
                'departamento_id' => 8, // Cusco
                'incluye_desayuno' => true,
                'incluye_estacionamiento' => true,
                'incluye_wifi' => true,
                'servicios_extra' => 'Spa andino, planetario, capilla colonial, museo',
                'activo' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
