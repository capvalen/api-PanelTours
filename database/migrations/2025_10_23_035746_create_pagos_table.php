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
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
             $table->foreignId('venta_id')->constrained('ventas')->onDelete('cascade');
            $table->dateTime('fecha');
						$table->boolean('es_compromiso')->default(false)->comment('0=pago, 1=es compromiso');
						$table->date('fecha_compromiso')->nullable()->comment('Fecha en que el cliente se compromete a pagar');
            $table->decimal('monto_abonado', 10, 2);
            $table->decimal('saldo_pendiente', 10, 2);
            $table->enum('metodo_pago', ['yape', 'tarjeta', 'depósito', 'efectivo'])->default('efectivo');
            $table->enum('estado_pago', ['pendiente', 'completado', 'fallido', 'reembolsado'])->default('pendiente');
            $table->string('codigo_referencia')->nullable()->comment('Para transferencias o depósitos');
						$table->boolean('activo')->default(true)->comment('no/si');
            $table->timestamps();
            
            // Índices
            $table->index('venta_id');
            $table->index('fecha');
            $table->index('estado_pago');
            $table->index('metodo_pago');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos');
    }
};
