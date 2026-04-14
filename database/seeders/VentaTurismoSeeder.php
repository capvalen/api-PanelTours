<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VentaTurismoSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('venta_turismo')->insert([
            [
                'venta_item_id' => 4, // Venta 2 - Tour Machu Picchu
                'nombre_tour' => 'Machu Picchu Full Day',
                'tipo_tour' => 'tour',
                'tour_id' => null,
                'descripcion' => 'Tour completo a Machu Picchu incluyendo tren Vistadome, bus de subida/bajada, guía profesional y almuerzo buffet.',
                'fecha_salida' => '2026-04-07',
                'fecha_retorno' => '2026-04-07',
                'cantidad_personas' => 1,
                'cantidad_adultos' => 1,
                'cantidad_ninos' => 0,
                'peruanos_adultos' => 0,
                'peruanos_kids' => 0,
                'extranjeros_adultos' => 1,
                'extranjeros_kids' => 0,
                'precio' => 600.00,
                'costo' => 380.00,
                'incluye' => 'Tren Vistadome Ollanta-Aguas Calientes, bus Consettur, entrada Machu Picchu, guía bilingüe, almuerzo buffet',
                'no_incluye' => 'Propinas, souvenirs, bebidas adicionales',
                'punto_partida' => 'Hotel en Cusco (recojo)',
                'punto_llegada' => 'Hotel en Cusco (retorno)',
                'hora_salida' => '04:30:00',
                'hora_retorno' => '21:00:00',
                'estado' => 'confirmado',
                'requisitos' => 'Pasaporte o DNI vigente, calzado cómodo para caminata',
                'observaciones' => 'Pasajera estadounidense, llevar protector solar y repelente',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'venta_item_id' => 9, // Venta 4 - Tour Islas Uros y Taquile
                'nombre_tour' => 'Islas Uros y Taquile - Lago Titicaca',
                'tipo_tour' => 'tour',
                'tour_id' => null,
                'descripcion' => 'Visita a las islas flotantes de los Uros y la isla Taquile, con almuerzo típico incluido.',
                'fecha_salida' => '2026-04-11',
                'fecha_retorno' => '2026-04-11',
                'cantidad_personas' => 3,
                'cantidad_adultos' => 2,
                'cantidad_ninos' => 1,
                'peruanos_adultos' => 2,
                'peruanos_kids' => 1,
                'extranjeros_adultos' => 0,
                'extranjeros_kids' => 0,
                'precio' => 350.00,
                'costo' => 200.00,
                'incluye' => 'Lancha rápida, entrada Islas Uros y Taquile, guía bilingüe, almuerzo típico en Taquile',
                'no_incluye' => 'Artesanías, bebidas, propinas',
                'punto_partida' => 'Puerto de Puno',
                'punto_llegada' => 'Puerto de Puno',
                'hora_salida' => '07:00:00',
                'hora_retorno' => '17:00:00',
                'estado' => 'pendiente',
                'requisitos' => 'DNI o pasaporte, protector solar, abrigo (hace frío en el lago)',
                'observaciones' => 'Grupo familiar con una menor de edad',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
