<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Historial de abonos (adelantos y pagos totales) de los cobros a proveedores.
     */
    public function up(): void
    {
        Schema::create('cobro_abonos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cobro_id')->constrained('pagos')->onDelete('cascade');
            $table->date('fecha');
            $table->decimal('monto', 10, 2);
            $table->string('metodo_pago')->nullable();
            $table->string('codigo_referencia')->nullable();
            $table->text('observaciones')->nullable();
            $table->boolean('activo')->default(true);
            $table->timestamps();

            $table->index('cobro_id');
            $table->index('fecha');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cobro_abonos');
    }
};