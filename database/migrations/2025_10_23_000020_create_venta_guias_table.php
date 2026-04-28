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
        Schema::create('venta_guias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('venta_item_id')->constrained('venta_items')->onDelete('cascade');
            $table->foreignId('guia_id')->nullable()->constrained('guias')->onDelete('cascade');
            $table->string('ruta', 255)->nullable();
            $table->date('fecha')->nullable();
            $table->time('hora')->nullable();
            $table->text('lugar_encuentro')->nullable();
            $table->decimal('precio', 10, 2)->default(0);
            $table->decimal('costo', 10, 2)->default(0);
            $table->integer('duracion_horas')->nullable(); // Duración del tour en horas
            $table->enum('tipo_servicio', ['privado', 'grupal', 'empresarial'])->default('privado');
            $table->integer('cantidad_personas')->default(1); // Número de personas
            $table->text('pedido_especial')->nullable();
            $table->boolean('activo')->default(true)->comment('no/si');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('venta_guias');
    }
};
