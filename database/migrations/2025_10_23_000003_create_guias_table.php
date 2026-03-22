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
        Schema::create('guias', function (Blueprint $table) {
            $table->id();
            $table->string('dni', 8)->nullable();
            $table->string('nombre');
            $table->string('celular', 20)->nullable();
            $table->string('contacto_emergencia', 20)->nullable();
            $table->string('especialidad')->nullable();
            $table->string('idiomas')->nullable(); // "español, inglés"
            $table->foreignId('departamento_id')->constrained('departamentos')->onDelete('cascade');
            $table->boolean('activo')->default(true)->comment('no/si');
            $table->timestamps();

            $table->index('dni');
            $table->index('departamento_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guias');
    }
};
