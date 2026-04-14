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
        Schema::create('venta_hospedajes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('venta_item_id')->constrained('venta_items')->onDelete('cascade');
            $table->foreignId('hospedaje_id')->constrained('hospedajes')->onDelete('cascade');

            $table->enum('tipo_habitacion', ['Suite', 'Doble', 'Individual', 'King', 'Queen', 'Familiar', 'Económica', 'Compartida', 'Triple', 'Cuádruple'])->nullable()->comment('Tipos de habitación disponibles');
            $table->string('numero_habitacion', 20)->nullable()->comment('Ej: "101", "204", "Bungalow 3"');
            
            // Datos de la reserva
            $table->date('fecha_ingreso');
            $table->date('fecha_salida');
            $table->time('hora_checkin')->nullable();
            $table->time('hora_checkout')->nullable();
            $table->integer('cantidad_noches');
            
            // Huéspedes
            $table->integer('cantidad_adultos')->default(1);
            $table->integer('cantidad_ninos')->default(0);
            $table->text('nombres_huespedes')->nullable();
            
            // Precios
            $table->decimal('precio_por_noche', 10, 2);
            $table->decimal('precio', 10, 2);
            
            // Estado de pago
            $table->enum('estado_pago', ['pendiente', 'parcial', 'pagado'])->default('pendiente');
            
            // Estado de la reserva
            $table->enum('estado', ['pendiente','reservado', 'confirmado', 'checkin', 'checkout', 'cancelado'])->default('pendiente');
            $table->text('motivo_cancelacion')->nullable();
                        
            // Preferencias
            $table->boolean('requiere_cuna')->default(false);
            $table->boolean('habitacion_fumador')->default(false);
            $table->text('preferencias_especiales')->nullable();
            
            // Contacto
            $table->string('nombre_titular', 100);
            $table->string('documento_titular', 20)->nullable();
            $table->string('email_contacto', 150)->nullable();
            $table->string('telefono_contacto', 20)->nullable();
            
            $table->boolean('activo')->default(true)->comment('no/si');
            $table->timestamps();
            
            // Índices
            $table->index('venta_item_id');
            $table->index('hospedaje_id');
            $table->index(['fecha_ingreso', 'fecha_salida']);
            $table->index('estado');
            $table->index('estado_pago');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('venta_hospedajes');
    }
};
