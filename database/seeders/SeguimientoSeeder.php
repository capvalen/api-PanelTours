<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Seguimiento;
use App\Models\Accion;
use App\Models\Usuario;

class SeguimientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usuarios = Usuario::pluck('id')->toArray();
        $acciones = Accion::pluck('id')->toArray();
        $ventas = \App\Models\Venta::pluck('id')->toArray();

        if (empty($usuarios) || empty($acciones) || empty($ventas)) {
            return;
        }

        $seguimientos = [
            [
                'venta_id' => $ventas[0],
                'accion_id' => $acciones[0], // cotización generada
                'fecha' => now()->subDays(5),
                'id_usuario' => $usuarios[0],
            ],
            [
                'venta_id' => $ventas[0],
                'accion_id' => $acciones[1], // cambio de estado a venta
                'fecha' => now()->subDays(4),
                'id_usuario' => $usuarios[1],
            ],
            [
                'venta_id' => $ventas[0],
                'accion_id' => $acciones[2], // pago realizado
                'fecha' => now()->subDays(3),
                'id_usuario' => $usuarios[2],
            ],
            [
                'venta_id' => $ventas[0],
                'accion_id' => $acciones[3], // pago rechazado
                'fecha' => now()->subDays(2),
                'id_usuario' => $usuarios[3],
            ],
        ];

        foreach ($seguimientos as $seg) {
            Seguimiento::create($seg);
        }
    }
}
