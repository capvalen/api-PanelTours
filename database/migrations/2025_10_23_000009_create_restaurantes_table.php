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
        Schema::create('restaurantes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('departamento_id')->constrained('departamentos')->onDelete('cascade');
            $table->string('ruc', 15)->nullable();
            $table->string('nombre');
            $table->text('direccion')->nullable();
            $table->string('contacto')->nullable();
            $table->string('celular', 20)->nullable();
            $table->json('archivos')->nullable();
            $table->boolean('activo')->default(true)->comment('no/si');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurantes');
    }
};
