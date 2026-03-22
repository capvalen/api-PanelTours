<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RecordatorioSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('recordatorios')->insert([
            [
                'tipo_evento' => 'pagos',
                'fecha_hora' => '2026-03-25 10:00:00',
                'estado' => 'pendiente',
                'titulo' => 'Cobrar saldo pendiente - Cliente Flores',
                'comentario' => 'El cliente Roberto Flores tiene un saldo pendiente de S/ 1,200 por paquete Cusco.',
                'usuario_id' => 2,
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tipo_evento' => 'boletos',
                'fecha_hora' => '2026-03-22 08:00:00',
                'estado' => 'activo',
                'titulo' => 'Emitir boletos LATAM - Lima/Cusco',
                'comentario' => 'Emitir boletos para la familia Johnson, vuelo LA2040 del 28 de marzo.',
                'usuario_id' => 2,
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tipo_evento' => 'reunion',
                'fecha_hora' => '2026-03-24 15:00:00',
                'estado' => 'pendiente',
                'titulo' => 'Reunión con proveedor Hotel Libertador',
                'comentario' => 'Negociar tarifas corporativas para temporada alta 2026.',
                'usuario_id' => 1,
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tipo_evento' => 'tarea',
                'fecha_hora' => '2026-03-23 09:00:00',
                'estado' => 'pendiente',
                'titulo' => 'Actualizar catálogo de tours Arequipa',
                'comentario' => null,
                'usuario_id' => 3,
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
