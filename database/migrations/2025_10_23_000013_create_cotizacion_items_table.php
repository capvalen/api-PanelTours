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
        Schema::create('cotizacion_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cotizacion_id')->constrained('cotizacion')->onDelete('cascade');
            $table->enum('tipo', ['vuelo', 'hospedaje', 'transporte', 'restaurante', 'tour', 'web']);
            $table->decimal('descuento', 10, 2)->default(0)->nullable();
            $table->string('motivo_descuento')->nullable();
            $table->decimal('precio', 10, 2);
            $table->decimal('precio_adulto', 10, 2)->default(0)->nullable();
            $table->decimal('precio_kids', 10, 2)->default(0)->nullable();
            $table->string('descripcion');
            $table->string('destino')->nullable();
            $table->boolean('activo')->default(true)->comment('no/si');
            $table->timestamps();

            $table->index('cotizacion_id');
            $table->index('tipo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cotizacion_items');
    }
};
