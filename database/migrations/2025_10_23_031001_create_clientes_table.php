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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
						 // Datos de empresa/persona jurídica
            $table->string('ruc', 11)->nullable()->unique();
            $table->string('razon_social')->nullable();
            
            // Datos personales
            $table->string('nombres')->nullable();
            $table->string('apellidos')->nullable();
            $table->string('dni', 8)->nullable()->unique();
            $table->string('carnet_extranjeria', 20)->nullable()->unique();
            $table->date('fecha_nacimiento')->nullable();
            
            // Contacto
            $table->string('correo')->nullable();
            $table->string('celular', 20)->nullable();
            $table->string('telefono', 20)->nullable();
            $table->text('direccion')->nullable();
            
            // Ubicación
            $table->string('nacionalidad')->nullable();
            $table->string('pais_origen')->nullable();
            
            // Documentos de viaje
            $table->boolean('pasaporte')->default(false)->comment('no/si');
            $table->date('vigencia_pasaporte')->nullable()->comment('Vigencia de 6 meses');;
            $table->boolean('visado')->default(false)->comment('no/si');
            $table->date('valido_visa')->nullable();
            
            // Información adicional
            $table->boolean('vacunacion')->default(false)->comment('no/si');
            $table->boolean('tiene_seguro')->default(false)->comment('no/si');
            $table->text('seguro')->nullable();
            $table->enum('autorizacion_viaje', ['si', 'no', 'no aplica'])->nullable(); // para menores de edad

            // Archivos adjuntos
            $table->json('archivos')->nullable();
						$table->boolean('activo')->default(true)->comment('no/si');
            
            
            // Índices adicionales para búsquedas frecuentes
            $table->index('correo');
            $table->index('celular');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
