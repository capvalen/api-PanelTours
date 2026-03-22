<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('venta_vuelos_pasajeros', function (Blueprint $table) {
            $table->id();
            $table->foreignId('venta_vuelo_tramo_id')->constrained('venta_vuelos_tramos')->onDelete('cascade');

            // Datos del pasajero
            $table->string('numero_asiento', 10)->nullable();

            // Documentación
            $table->string('dni', 50)->nullable();
            $table->string('nombre', 100)->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('numero_pasaporte', 50)->nullable();
            $table->date('fecha_vencimiento_pasaporte')->nullable();
            $table->string('pais_emision_pasaporte', 100)->nullable();

            // Vacunación fiebre amarilla
            $table->string('certificado_fiebre_amarilla', 100)->nullable();
            $table->date('fecha_vacunacion_fiebre_amarilla')->nullable();
            $table->date('certificado_valido_hasta')->nullable();

            // Check in
            $table->boolean('check_in_realizado')->default(false);
            $table->timestamp('fecha_check_in')->nullable();
            $table->string('usuario_check_in', 100)->nullable();
            $table->text('observaciones_check_in')->nullable();

            $table->boolean('activo')->default(true)->comment('no/si');
            $table->timestamps();

            $table->index('venta_vuelo_tramo_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('venta_vuelos_pasajeros');
    }
};
