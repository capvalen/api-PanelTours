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
			Schema::create('vehiculos', function (Blueprint $table) {
				$table->id();
				$table->string('tipo_vehiculo');
				$table->string('placa', 10)->unique();
				$table->string('dni_conductor', 8)->nullable();
				$table->string('nombre_conductor')->nullable();
				$table->string('licencia_conductor', 20)->nullable();
				$table->integer('edad_conductor')->default(0);
				$table->json('archivos')->nullable();
				$table->boolean('activo')->default(true)->comment('no/si');
				$table->timestamps();

				$table->index('dni_conductor');
				$table->index('placa');
			});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehiculos');
    }
};
