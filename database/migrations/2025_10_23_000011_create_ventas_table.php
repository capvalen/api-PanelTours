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
            $table->foreignId('usuario_id')->constrained('usuarios')->onDelete('cascade');
            $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade');
            $table->date('fecha');
            $table->enum('tipo', ['cotización', 'venta'])->default('cotización');
            $table->enum('estado_pago', ['pendiente', 'adelantado', 'completo', 'anulado'])->default('pendiente');
            $table->integer('personas')->default(0);
            $table->foreignId('departamento_id')->constrained('departamentos')->onDelete('cascade');
						$table->string('ciudad')->nullable();
            $table->decimal('precio', 10, 2)->default(0)->nullable();
						$table->integer('nivel')->default(1)->comment('1=venta/reserva, 2=confirmación, 3=operatividad');
						$table->enum('estado', ['activo', 'anulado', 'confirmado', 'operativo', 'en curso', 'finalizado' ])->default('activo')->comment('no/si');
						$table->boolean('activo')->default(true)->comment('no/si');
            $table->timestamps();

            // Índices
            $table->index('cliente_id');
            $table->index('usuario_id');
            $table->index('fecha');
            $table->index('tipo');
            $table->index('estado_pago');
            $table->index('departamento_id');
            $table->index('estado');
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
