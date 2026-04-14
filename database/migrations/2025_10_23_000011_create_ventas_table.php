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
            $table->enum('tipo', ['cotización', 'venta'])->default('cotización');
            $table->enum('estado_pago', ['pendiente', 'adelantado', 'completo', 'anulado'])->default('pendiente');
            $table->date('fecha');
            $table->decimal('precio', 10, 2)->default(0)->nullable();
			$table->boolean('activo')->default(true)->comment('no/si');
            $table->timestamps();

            // Índices
            $table->index('cliente_id');
            $table->index('fecha');
            $table->index('tipo');
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
