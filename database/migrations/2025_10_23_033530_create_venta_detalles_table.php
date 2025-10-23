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
        Schema::create('venta_detalles', function (Blueprint $table) {
            $table->id();
						 $table->foreignId('venta_id')->constrained('ventas')->onDelete('cascade');
            $table->enum('tipo_servicio', ['tour', 'paquete', 'vehículo']);
            $table->string('concepto');
            $table->unsignedBigInteger('servicio_id');
            $table->enum('viaje', ['nacional', 'internacional'])->nullable();
            $table->decimal('subtotal', 10, 2);
						$table->boolean('activo')->default(true)->comment('no/si');
            $table->timestamps();

						$table->index('venta_id');
            $table->index('tipo_servicio');
            $table->index('servicio_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('venta_detalles');
    }
};
