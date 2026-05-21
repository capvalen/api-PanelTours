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
            $table->foreignId('guia_id')->constrained('guias')->onDelete('cascade');
                        $table->date('fecha')->nullable();
            $table->time('hora')->nullable();
            $table->text('lugar_encuentro')->nullable();
            $table->decimal('costo', 10, 2)->default(0);
            $table->enum('tipo_servicio', ['privado', 'grupal', 'empresarial', 'individual'])->default('privado');
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
