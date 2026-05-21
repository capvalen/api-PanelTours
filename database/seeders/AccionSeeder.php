<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Accion;

class AccionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $acciones = [
            'cotización generada',
            'cambio de estado a cotización',
            'cambio de estado a venta',
            'cambio de estado a facturada',
            'cambio de estado a en seguimiento',
            'cambio de estado a finalizado',
            'venta eliminada',
            'pago realizado',
            'pago rechazado',
        ];

        foreach ($acciones as $accion) {
            Accion::updateOrCreate(['nombre' => $accion]);
        }
    }
}
