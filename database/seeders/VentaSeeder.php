<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VentaSeeder extends Seeder
{
	public function run(): void
	{
		DB::table('ventas')->insert([
			[
				'usuario_id' => 1,
				'cliente_id' => 1,
				'fecha' => '2026-03-21',
				'tipo' => 'venta',
				'estado_pago' => 'pendiente',
				'personas' => 3,
				'precio' => 1250,
				'departamento_id' => 15, // Lima
				'ciudad' => 'Lima',
				'nivel' => 1,
				'estado' => 'activo',
				'activo' => true,
				'created_at' => now(),
				'updated_at' => now(),
			],
			[
				'usuario_id' => 2,
				'cliente_id' => 2,
				'fecha' => '2026-03-20',
				'tipo' => 'venta',
				'estado_pago' => 'completo',
				'personas' => 2,
				'precio' => 2350,
				'departamento_id' => 4, // Arequipa
				'ciudad' => 'Arequipa',
				'nivel' => 1,
				'estado' => 'activo',
				'activo' => true,
				'created_at' => now(),
				'updated_at' => now(),
			],
			[
				'usuario_id' => 3,
				'cliente_id' => 3,
				'fecha' => '2026-03-19',
				'tipo' => 'cotización',
				'estado_pago' => 'pendiente',
				'personas' => 3,
				'precio' => 400,
				'departamento_id' => 9,
				'ciudad' => 'Acoria',
				'nivel' => 1,
				'estado' => 'activo',
				'activo' => true,
				'created_at' => now(),
				'updated_at' => now(),
			],
			[
				'usuario_id' => 4,
				'cliente_id' => 4,
				'fecha' => '2026-03-18',
				'tipo' => 'venta',
				'estado_pago' => 'adelantado',
				'personas' => 1,
				'precio' => 1800,
				'departamento_id' => 20, // Piura
				'ciudad' => 'Piura',
				'nivel' => 1,
				'estado' => 'activo',
				'activo' => true,
				'created_at' => now(),
				'updated_at' => now(),
			],
			[
				'usuario_id' => 1,
				'cliente_id' => 1,
				'fecha' => '2026-03-15',
				'tipo' => 'venta',
				'estado_pago' => 'anulado',
				'personas' => 0,
				'precio' => 0,
				'departamento_id' => 1, // Amazonas
				'ciudad' => 'Chachapoyas',
				'nivel' => 1,
				'estado' => 'anulado',
				'activo' => true,
				'created_at' => now(),
				'updated_at' => now(),
			],
		]);
	}
}
