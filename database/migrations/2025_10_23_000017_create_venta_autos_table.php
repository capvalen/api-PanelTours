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
        Schema::create('venta_autos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('venta_item_id')->constrained('venta_items')->onDelete('cascade');
            $table->foreignId('vehiculo_id')->constrained('vehiculos')->onDelete('cascade');
            $table->string('origen', 255)->nullable();
            $table->string('destino', 255)->nullable();
            
            // Fechas del alquiler
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->time('hora_recogida')->nullable();
            $table->time('hora_devolucion')->nullable();
            
            // Control del alquiler
            $table->enum('estado_alquiler', ['pendiente','reservado', 'activo', 'finalizado', 'cancelado'])->default('pendiente');
            $table->decimal('costo', 10, 2);
            $table->decimal('precio', 10, 2);
            $table->integer('pasajeros')->default(1);
            // Entregas
            $table->text('observaciones')->nullable();
          
            
            $table->boolean('activo')->default(true)->comment('no/si');
            $table->timestamps();
            
            // Índices
            $table->index('vehiculo_id');
            $table->index('fecha_inicio');
            $table->index('fecha_fin');
            $table->index('estado_alquiler');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('venta_autos');
    }
};
