<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('usuarios')->insert([
            [
                'nombre' => 'Carlos Mendoza',
                'user' => 'admin',
                'perfil' => 'administrador',
                'password' => Hash::make('admin123'),
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'María López',
                'user' => 'maria.lopez',
                'perfil' => 'agente',
                'password' => Hash::make('agente123'),
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Jorge Ramírez',
                'user' => 'jorge.ramirez',
                'perfil' => 'agente',
                'password' => Hash::make('agente123'),
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Ana Gutiérrez',
                'user' => 'ana.gutierrez',
                'perfil' => 'contador',
                'password' => Hash::make('contador123'),
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
