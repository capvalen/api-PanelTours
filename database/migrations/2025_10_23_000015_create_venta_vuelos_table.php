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
        Schema::create('venta_vuelos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('venta_item_id')->constrained('venta_items')->onDelete('cascade');
            $table->string('origen')->nullable();
            $table->string('destino')->nullable();
            $table->integer('pasajeros')->nullable();
            $table->enum('lleva_equipaje', ['si', 'no'])->default('no');
            $table->integer('kilos')->default(0);
            $table->string('que_equipaje')->nullable();
            $table->decimal('precio_ticket', 10, 2)->nullable();
            $table->decimal('precio_soles', 10, 2)->nullable();
            $table->decimal('precio_dolares', 10, 2)->nullable();
            $table->decimal('costo_soles', 10, 2)->nullable();
            $table->decimal('costo_dolares', 10, 2)->nullable();

            // Identificación del vuelo
            $table->string('codigo_vuelo', 20)->nullable();
            $table->string('aerolinea', 100)->nullable();
            $table->string('numero_vuelo', 10)->nullable();
            $table->string('aeronave', 50)->nullable();

            // Horarios
            $table->timestamp('fecha_salida')->nullable();
            $table->timestamp('fecha_llegada')->nullable();
            $table->time('hora_salida')->nullable();
            $table->time('horario_llegada')->nullable();
            $table->integer('duracion_minutos')->nullable();

            // Terminales y puertas
            $table->string('terminal_salida', 10)->nullable();
            $table->string('puerta_embarque', 10)->nullable();
            $table->string('terminal_llegada', 10)->nullable();

            // Estados y gestión
            $table->enum('estado_tramo', ['pendiente', 'confirmado', 'emitido', 'checkin_disponible', 'checkin_realizado', 'abordado', 'cancelado', 'completado'])->default('pendiente');
            $table->string('asientos_asignados', 200)->nullable();

            // Información adicional
            $table->enum('clase_vuelo', ['económica', 'económica plus', 'turista', 'ejecutiva', 'primera'])->default('económica');
            $table->boolean('escala')->default(false);
            $table->text('observaciones')->nullable();

            $table->boolean('activo')->default(true)->comment('no/si');
            $table->timestamps();

            $table->index('venta_item_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('venta_vuelos');
    }
};
