<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VentaHospedajeSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('venta_hospedajes')->insert([
            [
                'venta_item_id' => 2, // Venta 1 - Hospedaje Hotel Libertador
                'hospedaje_id' => 1,
                'tipo_habitacion' => 'Doble',
                'numero_habitacion' => '305',
                'fecha_ingreso' => '2026-03-28',
                'fecha_salida' => '2026-04-01',
                'hora_checkin' => '14:00:00',
                'hora_checkout' => '12:00:00',
                'cantidad_noches' => 4,
                'cantidad_adultos' => 2,
                'cantidad_ninos' => 0,
                'nombres_huespedes' => 'Roberto Flores Quispe, Ana María Flores Ramos',
                'precio_por_noche' => 280.00,
                'subtotal' => 1120.00,
                'impuestos' => 201.60,
                'cargo_servicio' => 0.00,
                'total' => 1321.60,
                'anticipo' => 500.00,
                'saldo_pendiente' => 821.60,
                'estado_pago' => 'parcial',
                'metodo_pago' => 'yape',
                'estado' => 'confirmado',
                'motivo_cancelacion' => null,
                'tipo_cama' => 'matrimonial',
                'requiere_cuna' => false,
                'habitacion_fumador' => false,
                'preferencias_especiales' => 'Piso alto con vista a la plaza',
                'nombre_titular' => 'Roberto Flores Quispe',
                'documento_titular' => '45678912',
                'email_contacto' => 'roberto.flores@gmail.com',
                'telefono_contacto' => '951234567',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'venta_item_id' => 8, // Venta 4 - Hospedaje Puno
                'hospedaje_id' => 3, // Sonesta Arequipa (ejemplo)
                'tipo_habitacion' => 'Suite',
                'numero_habitacion' => '501',
                'fecha_ingreso' => '2026-04-10',
                'fecha_salida' => '2026-04-13',
                'hora_checkin' => '15:00:00',
                'hora_checkout' => '11:00:00',
                'cantidad_noches' => 3,
                'cantidad_adultos' => 2,
                'cantidad_ninos' => 1,
                'nombres_huespedes' => 'Carmen Torres Huamán, Raúl Torres, Sofía Torres (menor)',
                'precio_por_noche' => 350.00,
                'subtotal' => 1050.00,
                'impuestos' => 189.00,
                'cargo_servicio' => 52.50,
                'total' => 1291.50,
                'anticipo' => 1291.50,
                'saldo_pendiente' => 0.00,
                'estado_pago' => 'pagado',
                'metodo_pago' => 'tarjeta',
                'estado' => 'reservado',
                'motivo_cancelacion' => null,
                'tipo_cama' => 'king',
                'requiere_cuna' => false,
                'habitacion_fumador' => false,
                'preferencias_especiales' => 'Cama extra para niña, vista al lago Titicaca',
                'nombre_titular' => 'Carmen Torres Huamán',
                'documento_titular' => '31234567',
                'email_contacto' => 'carmen.torres@viajesdelsur.pe',
                'telefono_contacto' => '943218765',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
