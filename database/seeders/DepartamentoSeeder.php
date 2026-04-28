<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartamentoSeeder extends Seeder
{
    public function run(): void
    {
        $departamentos = [
            ['nombre' => 'Amazonas',       'abreviatura' => 'AZA'],
            ['nombre' => 'Áncash',         'abreviatura' => 'ANC'],
            ['nombre' => 'Apurímac',       'abreviatura' => 'APU'],
            ['nombre' => 'Arequipa',       'abreviatura' => 'AQP'],
            ['nombre' => 'Ayacucho',       'abreviatura' => 'AYC'],
            ['nombre' => 'Cajamarca',      'abreviatura' => 'CJA'],
            ['nombre' => 'Callao',         'abreviatura' => 'LIM'], // Comparte aeropuerto con Lima
            ['nombre' => 'Cusco',          'abreviatura' => 'CUZ'],
            ['nombre' => 'Huancavelica',   'abreviatura' => 'HUV'],
            ['nombre' => 'Huánuco',        'abreviatura' => 'HUU'],
            ['nombre' => 'Ica',            'abreviatura' => 'ICA'],
            ['nombre' => 'Junín',          'abreviatura' => 'JAU'], // Huancayo/Jauja
            ['nombre' => 'La Libertad',    'abreviatura' => 'TRU'], // Trujillo
            ['nombre' => 'Lambayeque',     'abreviatura' => 'CIX'], // Chiclayo
            ['nombre' => 'Lima',           'abreviatura' => 'LIM'],
            ['nombre' => 'Loreto',         'abreviatura' => 'IQT'], // Iquitos
            ['nombre' => 'Madre de Dios',  'abreviatura' => 'PEM'], // Puerto Maldonado
            ['nombre' => 'Moquegua',       'abreviatura' => 'MQQ'],
            ['nombre' => 'Pasco',          'abreviatura' => 'PCO'],
            ['nombre' => 'Piura',          'abreviatura' => 'PIU'],
            ['nombre' => 'Puno',           'abreviatura' => 'JUL'], // Juliaca
            ['nombre' => 'San Martín',     'abreviatura' => 'TPP'], // Tarapoto
            ['nombre' => 'Tacna',          'abreviatura' => 'TCQ'],
            ['nombre' => 'Tumbes',         'abreviatura' => 'TUM'],
            ['nombre' => 'Ucayali',        'abreviatura' => 'PCL'], // Pucallpa
        ];

        foreach ($departamentos as $dep) {
            DB::table('departamentos')->insert([
                'departamento'  => $dep['nombre'],
                'abreviatura'   => $dep['abreviatura'],
                'activo'        => true,
            ]);
        }
    }
}