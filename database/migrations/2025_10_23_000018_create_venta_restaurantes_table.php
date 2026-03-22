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

            $table->text('nombre_cliente');
            
            // Control de la reserva
			$table->enum('estado', ['pendiente', 'confirmado', 'cancelado', 'completado'])->default('pendiente'); 
            $table->string('comprobante', 10)->unique();
            $table->timestamp('fecha_confirmacion')->nullable();
            $table->text('motivo_cancelacion')->nullable();
            
            // Logística del restaurante (sin mesa, duración ni zona)
            $table->enum('turno', ['comida', 'cena', 'brunch', 'desayuno', 'madrugada'])->nullable();
            $table->enum('tipo_servicio', ['buffet', 'carta', 'degustacion', 'evento'])->default('carta');
            $table->enum('espacio', ['interior','salon_principal', 'salon_privado', 'terraza', 'jardin', 'barra'])->default('interior')->nullable();
            
            // Datos de la reserva
            $table->integer('numero_personas');
            $table->timestamp('fecha_hora_reserva');
            $table->text('pedido_especial')->nullable();
            $table->unsignedBigInteger('restaurante_id');
            
            // Timestamps y soft deletes
            $table->timestamps();
            $table->softDeletes();
            
            // Índices
            $table->index('restaurante_id');
            $table->index('fecha_hora_reserva');
            $table->index('estado');
            
            // Llaves foráneas
            $table->foreign('restaurante_id')->references('id')->on('restaurantes')->onDelete('cascade');
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
