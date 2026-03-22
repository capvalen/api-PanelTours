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
            $table->string('nombre_tour', 255);
            $table->enum('tipo', ['paquete', 'tour'])->default('tour');
            $table->text('descripcion')->nullable();
            
            // Fechas y duración
            $table->date('fecha_salida');
            $table->date('fecha_retorno')->nullable();
            $table->integer('duracion_dias')->nullable();
            $table->integer('duracion_noches')->nullable();
            
            // Capacidad
            $table->integer('cantidad_personas');
            
            // Precios
            $table->decimal('precio', 10, 2); // Precio de venta al cliente
            $table->decimal('costo', 10, 2); // Costo para la empresa
            
            // Incluye / No incluye
            $table->text('incluye')->nullable();
            $table->text('no_incluye')->nullable();
            
            // Logística
            $table->string('punto_partida', 255)->nullable();
            $table->string('punto_llegada', 255)->nullable();
            $table->time('hora_salida')->nullable();
            $table->time('hora_retorno')->nullable();
            
            // Estado y control
            $table->enum('estado', ['disponible', 'confirmado', 'en_curso', 'finalizado', 'cancelado'])->default('disponible');
            $table->enum('estado_pago', ['pendiente', 'parcial', 'pagado'])->default('pendiente');
            $table->decimal('anticipo', 10, 2)->default(0);
            $table->decimal('debe', 10, 2)->nullable();
            
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
            $table->index('tipo');
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
