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
        Schema::create('caja_detalles', function (Blueprint $table) {
            $table->id();
						$table->foreignId('caja_id')->constrained('cajas')->onDelete('cascade');
            $table->enum('tipo', ['ingreso', 'egreso']);
            $table->enum('categoria', ['venta turismo', 'gasto operativo', 'servicios básicos', 'pago personal', 'otros']);
            $table->decimal('monto', 10, 2);
            $table->string('concepto');
            $table->dateTime('fecha');
            $table->enum('comprobante_pago', ['ticket', 'boleta', 'factura', 'proforma']);
            $table->string('serie', 50)->nullable();
            $table->foreignId('venta_id')->nullable()->constrained('ventas')->onDelete('set null');
            $table->text('observaciones')->nullable();
						$table->boolean('activo')->default(true)->comment('no/si');
            $table->timestamps();

						$table->index('caja_id');
            $table->index('tipo');
            $table->index('categoria');
            $table->index('fecha');
            $table->index('venta_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('caja_detalles');
    }
};
