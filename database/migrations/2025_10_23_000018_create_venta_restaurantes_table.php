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
       Schema::create('venta_restaurantes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('venta_item_id')->constrained('venta_items')->onDelete('cascade');
            $table->foreignId('restaurante_id')->nullable()->constrained('restaurantes')->onDelete('cascade');

            $table->text('nombre_cliente')->nullable();
            
            // Control de la reserva
			$table->enum('estado', ['pendiente', 'confirmado', 'cancelado', 'completado'])->default('pendiente'); 
            $table->string('comprobante', 10)->unique()->nullable();
            $table->timestamp('fecha_confirmacion')->nullable();
            $table->text('motivo_cancelacion')->nullable();
            
            // Logística del restaurante (sin mesa, duración ni zona)
            $table->enum('turno', ['comida', 'cena', 'brunch', 'desayuno', 'madrugada'])->default('comida');
            $table->enum('tipo_servicio', ['buffet', 'carta', 'degustación', 'evento'])->default('carta');
            $table->enum('espacio', ['interior','salón principal', 'salón privado', 'terraza', 'jardín', 'barra'])->default('interior')->nullable();
            
            // Datos de la reserva
            $table->integer('numero_personas')->nullable();
            $table->decimal('precio', 10, 2)->default(0);
            $table->date('fecha_reserva')->nullable();
            $table->time('hora_reserva')->nullable();
            $table->text('pedido_especial')->nullable();
            
            
            // Timestamps y soft deletes
            $table->timestamps();
            $table->softDeletes();
            
            // Índices
            $table->index('restaurante_id');
            $table->index('fecha_reserva');
            $table->index('estado');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('venta_restaurantes');
    }
};
