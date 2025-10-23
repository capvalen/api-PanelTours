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
        Schema::create('calendarios', function (Blueprint $table) {
            $table->id();
						$table->enum('tipo_evento', ['pagos', 'boletos']);
            $table->dateTime('fecha_hora');
            $table->enum('estado', ['pendiente', 'activo', 'finalizado', 'anulado'])->default('pendiente');
            $table->string('titulo');
            $table->text('comentario')->nullable();
            $table->foreignId('usuario_id')->constrained('usuarios')->onDelete('cascade');
						$table->boolean('activo')->default(true)->comment('no/si');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calendarios');
    }
};
