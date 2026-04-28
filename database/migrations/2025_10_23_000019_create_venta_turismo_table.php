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
        Schema::create('venta_turismo', function (Blueprint $table) {
            $table->id();
            $table->foreignId('venta_item_id')->constrained('venta_items')->onDelete('cascade');
            
            // Datos del tour
            $table->unsignedBigInteger('tour_id')->nullable();
            $table->string('nombre_tour', 255)->nullable();
            $table->enum('tipo_tour', ['paquete', 'tour'])->default('tour');
            $table->text('descripcion')->nullable();
            
            // Fechas y duración
            $table->date('fecha_salida')->nullable();
            $table->date('fecha_retorno')->nullable();
            
            // Capacidad
            $table->integer('cantidad_personas')->nullable();
            $table->integer('cantidad_adultos')->default(0);
            $table->integer('cantidad_ninos')->default(0);
            $table->integer('peruanos_adultos')->default(0);
            $table->integer('peruanos_kids')->default(0);
            $table->integer('extranjeros_adultos')->default(0);
            $table->integer('extranjeros_kids')->default(0);
            
            // Precios
            $table->decimal('precio', 10, 2)->default(0)->nullable(); // Precio de venta al cliente
            $table->decimal('costo', 10, 2)->default(0)->nullable(); // Costo para la empresa
            
            // Incluye / No incluye
            $table->text('incluye')->nullable();
            $table->text('no_incluye')->nullable();
            
            // Logística
            $table->string('punto_partida', 255)->nullable();
            $table->string('punto_llegada', 255)->nullable();
            $table->time('hora_salida')->nullable();
            $table->time('hora_retorno')->nullable();
            
            // Estado y control
            $table->enum('estado', ['pendiente', 'confirmado', 'en_curso', 'finalizado', 'cancelado'])->default('pendiente');
            
            // Requisitos
            $table->text('requisitos')->nullable(); // Vacunas, documentos, etc.
            
            // Observaciones
            $table->text('observaciones')->nullable();
            
            // Control
            $table->boolean('activo')->default(true)->comment('no/si');
            $table->timestamps();
            
            // Índices
            $table->index('venta_item_id');
            $table->index('fecha_salida');
            $table->index('tipo_tour');
            $table->index('estado');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('venta_turismo');
    }
};
