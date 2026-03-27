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
						$table->date('fecha_nacimiento')->nullable();
						
						// Contacto
						$table->string('correo')->nullable();
						$table->string('celular', 20)->nullable();
						$table->string('telefono', 20)->nullable();
						$table->text('direccion')->nullable();
						
						// Ubicación
						$table->enum('nacionalidad', ['peruano', 'extranjero'])->default('peruano');
						$table->string('pais_origen')->nullable()->comment('ciudad o país de origen');
						
						// Documentos de viaje
						$table->string('pasaporte')->nullable();
						$table->date('vigencia_pasaporte')->nullable()->comment('Vigencia de 6 meses');;
						$table->enum('tipo_visado', ['turista', 'trabajo', 'visitante', 'freelance', 'estudiante', 'adopción', 'familiar', 'humanitario', 'oficial', 'militar', 'diplomático']);
						$table->date('valido_visa')->nullable();
						
						// Información adicional
						$table->json('vacunas')->nullable()->comment('certificado, fecha');
						$table->json('seguros')->nullable()->comment('seguro, fecha');
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
