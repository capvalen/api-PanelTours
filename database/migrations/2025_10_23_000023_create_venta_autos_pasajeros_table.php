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
        Schema::create('venta_autos_pasajeros', function (Blueprint $table) {
            $table->id();

            $table->foreignId('venta_auto_id')->constrained('venta_autos')->onDelete('cascade');
            $table->foreignId('vehiculo_id')->nullable()->constrained('vehiculos')->onDelete('cascade');

            $table->string('numero_asiento', 10)->nullable()->comment('piso 1, 3b');

            // Documentación
            $table->string('dni', 50)->nullable();
            $table->string('nombre', 100)->nullable();
            
            

            $table->boolean('activo')->default(true)->comment('no/si');
            $table->timestamps();

            $table->index('venta_auto_id');
            $table->index('vehiculo_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('venta_autos_pasajeros');
    }
};
