<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // Grupo 1: Tablas independientes
            UsuarioSeeder::class,
            ClienteSeeder::class,
            DepartamentoSeeder::class,
            GuiaSeeder::class,
            VueloSeeder::class,
            ProveedorSeeder::class,
            AerolineaSeeder::class,
            RecordatorioSeeder::class,

            // Grupo 2: Dependencia leve (proveedores)
            HospedajeSeeder::class,
            RestauranteSeeder::class,
            VehiculoSeeder::class,

            // Grupo 3: Tablas de transacción
            VentaSeeder::class,
            CajaSeeder::class,

            // Grupo 4: Detalle e items
            VentaItemSeeder::class,
            CajaDetalleSeeder::class,
            VentaHospedajeSeeder::class,
            VentaAutoSeeder::class,
            VentaRestauranteSeeder::class,
            VentaTurismoSeeder::class,
            VentaGuiaSeeder::class,

            // Grupo 5: SubDetalles
            VentaVueloSeeder::class,
            VentaVueloPasajeroSeeder::class,
            VentaAutoPasajeroSeeder::class,
            PersonaSeeder::class,

            // Grupo 6: Finanzas
            PagoSeeder::class,
            DeudaSeeder::class,
        ]);
    }
}
