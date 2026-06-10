<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('comision_pagos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('comision_id')->constrained('comisiones')->onDelete('cascade');
            $table->date('fecha');
            $table->decimal('monto', 10, 2)->default(0);
            $table->text('observaciones')->nullable();
            $table->boolean('activo')->default(true);
            $table->timestamps();

            $table->index('fecha');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comision_pagos');
    }
};
