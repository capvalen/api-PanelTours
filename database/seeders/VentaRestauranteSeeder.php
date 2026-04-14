<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VentaRestauranteSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('venta_restaurantes')->insert([
            [
                'venta_item_id' => 5,
                'nombre_cliente' => 'Roberto Flores Quispe',
                'estado' => 'confirmado',
                'comprobante' => 'REST-0001',
                'fecha_confirmacion' => '2026-03-21 14:00:00',
                'motivo_cancelacion' => null,
                'turno' => 'cena',
                'tipo_servicio' => 'carta',
                'espacio' => 'terraza',
                'numero_personas' => 4,
                'precio' => 120.50,
                'fecha_reserva' => '2026-03-29',
                'hora_reserva' => '19:30:00',
                'pedido_especial' => 'Mesa con vista al patio, un comensal vegetariano',
                'restaurante_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'venta_item_id' => 5,
                'nombre_cliente' => 'Sarah Johnson',
                'estado' => 'pendiente',
                'comprobante' => 'REST-0002',
                'fecha_confirmacion' => null,
                'motivo_cancelacion' => null,
                'turno' => 'comida',
                'tipo_servicio' => 'degustación',
                'espacio' => 'salón privado',
                'numero_personas' => 2,
                'precio' => 250.00,
                'fecha_reserva' => '2026-04-06',
                'hora_reserva' => '12:30:00',
                'pedido_especial' => 'Menú degustación con maridaje de vinos peruanos',
                'restaurante_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'venta_item_id' => 5,
                'nombre_cliente' => 'Carmen Torres Huamán',
                'estado' => 'confirmado',
                'comprobante' => 'REST-0003',
                'fecha_confirmacion' => '2026-03-20 10:00:00',
                'motivo_cancelacion' => null,
                'turno' => 'brunch',
                'tipo_servicio' => 'buffet',
                'espacio' => 'jardin',
                'numero_personas' => 8,
                'precio' => 400.00,
                'fecha_reserva' => '2026-03-28',
                'hora_reserva' => '10:00:00',
                'pedido_especial' => 'Grupo empresarial, incluir opciones sin gluten',
                'restaurante_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
