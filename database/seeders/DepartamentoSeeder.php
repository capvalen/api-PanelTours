<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartamentoSeeder extends Seeder
{
    public function run(): void
    {
        $departamentos = [
            'Amazonas', 'Áncash', 'Apurímac', 'Arequipa', 'Ayacucho',
            'Cajamarca', 'Callao', 'Cusco', 'Huancavelica', 'Huánuco',
            'Ica', 'Junín', 'La Libertad', 'Lambayeque', 'Lima',
            'Loreto', 'Madre de Dios', 'Moquegua', 'Pasco', 'Piura',
            'Puno', 'San Martín', 'Tacna', 'Tumbes', 'Ucayali',
        ];

        foreach ($departamentos as $dep) {
            DB::table('departamentos')->insert([
                'departamento' => $dep,
                'activo' => true,
            ]);
        }
    }
}
