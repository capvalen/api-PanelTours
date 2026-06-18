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
                'nombre' => 'Carlos Pariona',
                'user' => 'cpariona',
                'perfil' => 'administrador',
                'password' => Hash::make('nus'),
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Usuario Test 2',
                'user' => 'test2',
                'perfil' => 'counter',
                'password' => Hash::make('123456'),
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Usuario Test 3',
                'user' => 'test3',
                'perfil' => 'logística',
                'password' => Hash::make('123456'),
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Usuario Test 4',
                'user' => 'test4',
                'perfil' => 'caja',
                'password' => Hash::make('123456'),
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
