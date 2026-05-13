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
        Schema::create('personas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('venta_id')->constrained('ventas')->onDelete('cascade');
            $table->boolean('es_titular')->default(false);
            
            $table->string('dni', 20)->nullable();
            $table->string('nombre', 150);
            $table->date('fecha_nacimiento')->nullable();
            
            $table->enum('parentesco', [
                'padre', 'madre', 'hijo', 'hermano/a', 'tio/a', 
                'amistad', 'jefe', 'empleado', 'esposo/a', 'pareja', 
                'acompañante', 'tutor/a', 'alumno'
            ])->nullable()->default('acompañante');
            
            $table->enum('enfermedades', ['si', 'no'])->default('no');
            $table->text('detalle_enfermedades')->nullable();
            
            $table->string('pasaporte', 50)->nullable();
            $table->date('fecha_caducidad_pasaporte')->nullable();
            $table->string('pais_emision', 100)->nullable();
            
            $table->enum('vacunas', ['si', 'no'])->default('no');
            $table->text('detalle_vacunas')->nullable();
            
            $table->text('observaciones')->nullable();
            $table->boolean('activo')->default(true)->nullable()->comment('no/si');
            
            $table->timestamps();

            // Índices
            $table->index('venta_id');
            $table->index('dni');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personas');
    }
};
