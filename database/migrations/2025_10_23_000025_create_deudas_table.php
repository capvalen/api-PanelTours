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
        Schema::create('deudas', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_pago');
            $table->decimal('monto', 10, 2);
            $table->text('informacion')->nullable();
            $table->string('contacto_pagar');
            $table->string('comprobante')->nullable();
            $table->enum('medio_pago', ['yape', 'tarjeta', 'depósito', 'efectivo', 'banco']);
            $table->enum('estado_pago', ['pendiente', 'completado', 'fallido', 'condonado'])->default('pendiente');
            $table->string('codigo_referencia')->nullable()->comment('Para transferencias o depósitos');
            $table->tinyInteger('activo')->default(1);
            $table->timestamps();
            
            // Índices
            $table->index('fecha_pago');
            $table->index('estado_pago');
            $table->index('medio_pago');
            $table->index('activo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deudas');
    }
};
