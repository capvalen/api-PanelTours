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
        Schema::create('cotizacion', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('usuarios')->onDelete('cascade');
            $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade');
            $table->date('fecha');
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();
            $table->integer('adults')->nullable()->default(0);
            $table->integer('kids')->nullable()->default(0);
            $table->integer('cuantas_personas')->default(0);
            $table->foreignId('departamento_id')->constrained('departamentos')->onDelete('cascade');
            $table->string('ciudad')->nullable();
            $table->decimal('precio', 10, 2)->default(0)->nullable();
            $table->decimal('precio_adultos', 10, 2)->default(0)->nullable();
            $table->decimal('precio_kids', 10, 2)->default(0)->nullable();
            $table->decimal('adelanto', 10, 2)->default(0)->nullable();
            $table->decimal('costo', 10, 2)->default(0)->nullable();
            $table->decimal('descuento', 10, 2)->default(0)->nullable();
            $table->string('motivo_descuento')->nullable();
            $table->enum('estado', ['activo', 'anulado', 'convertido'])->default('activo');
            $table->enum('nacionalidad', ['peruana', 'extranjera'])->default('peruana');
            $table->boolean('activo')->default(true)->comment('no/si');
            $table->timestamps();

            // Índices
            $table->index('cliente_id');
            $table->index('usuario_id');
            $table->index('fecha');
            $table->index('departamento_id');
            $table->index('estado');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cotizacion');
    }
};
