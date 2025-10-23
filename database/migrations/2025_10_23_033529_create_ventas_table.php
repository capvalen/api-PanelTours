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
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade');
            $table->date('fecha_inicio');
            $table->date('fecha_final');
            
            // Reserva
            $table->enum('es_reserva', ['venta', 'reserva'])->default('venta');
            $table->enum('reserva', ['pendiente', 'confirmado', 'anulado', 'finalizado'])->default('pendiente');
            
            // Pagos
            $table->enum('estado_pago', ['pendiente', 'adelantado', 'pagado'])->default('pendiente');
            $table->decimal('deuda', 10, 2)->default(0);
            $table->decimal('adelanto', 10, 2)->default(0);
            $table->decimal('costo', 10, 2)->comment('Precio sin descuento');
            $table->decimal('descuento', 10, 2)->default(0);
            $table->text('motivo_descuento')->nullable();
            $table->decimal('total', 10, 2);
            
            // Información del viaje
            $table->integer('pasajeros');
            $table->boolean('check_in')->default(false);
            $table->enum('metodo_pago', ['yape', 'tarjeta', 'depósito', 'efectivo'])->nullable();
            
            // Necesidades especiales
            $table->boolean('silla_ruedas')->default(false);
            $table->boolean('enfermedades')->default(false);
            $table->text('enfermedad')->nullable();
            $table->boolean('cama_extra')->default(false);
            $table->integer('cuantas_camas')->nullable();
            $table->boolean('cuna')->default(false);
            $table->boolean('dieta_especial')->default(false);
            $table->text('dieta')->nullable();
            
            // Control
            $table->enum('estado', ['activo', 'eliminado'])->default('activo');
            $table->foreignId('usuario_id')->constrained('usuarios')->onDelete('cascade');
						$table->boolean('activo')->default(true)->comment('no/si');
            
            $table->timestamps();
            
            // Índices
            $table->index('cliente_id');
            $table->index('fecha_inicio');
            $table->index('fecha_final');
            $table->index('es_reserva');
            $table->index('estado_pago');
            $table->index('estado');
            $table->index('usuario_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};
