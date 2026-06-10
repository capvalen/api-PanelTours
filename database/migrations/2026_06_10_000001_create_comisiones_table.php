<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('comisiones', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            
            $table->foreignId('logistica_id')->nullable()->constrained('logistica')->nullOnDelete();
            $table->integer('cant_personas')->default(0);
            $table->decimal('monto', 10, 2)->default(0);
            $table->enum('estado_pago', ['pendiente', 'adelantado', 'pagado', 'anulado'])->default('pendiente');
            $table->text('observaciones')->nullable();
            $table->morphs('comisionable');
            $table->boolean('activo')->default(true);
            $table->timestamps();

            $table->index('fecha');
            $table->index('estado_pago');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comisiones');
    }
};
