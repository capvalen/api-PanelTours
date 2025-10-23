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
        Schema::create('requisitos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('venta_detalle_id')->constrained('venta_detalles')->onDelete('cascade');
            $table->enum('tipo_servicio', ['tour', 'paquete', 'vehiculo']);
            
            // Campos para tour o paquete
            $table->foreignId('alojamiento_id')->nullable()->constrained('alojamientos')->onDelete('set null');
            $table->integer('cantidad_habitaciones')->nullable();
            $table->text('observacion_habitacion')->nullable();
            $table->boolean('silla_ruedas')->default(false);
            
            // Campos para alquiler de vehículo
            $table->foreignId('vehiculo_id')->nullable()->constrained('vehiculos')->onDelete('set null');
            $table->string('lugar_recogida')->nullable();
            $table->enum('viaje', ['nacional', 'internacional'])->nullable();
            $table->string('destino_final')->nullable();
            $table->time('hora_inicio')->nullable();
            $table->time('hora_final')->nullable();
            $table->date('fecha_recogida')->nullable();
						$table->boolean('activo')->default(true)->comment('no/si');
            $table->timestamps();
            
            // Índices
            $table->index('venta_detalle_id');
            $table->index('tipo_servicio');
            $table->index('vehiculo_id');
            $table->index('fecha_recogida');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requisitos');
    }
};
