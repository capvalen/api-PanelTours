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
        Schema::create('venta_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('venta_id')->constrained('ventas')->onDelete('cascade');
            $table->enum('tipo', ['vuelo', 'hospedaje', 'auto', 'comida', 'turismo']);
            $table->decimal('precio', 10, 2);
            $table->string('descripcion');
						$table->boolean('activo')->default(true)->comment('no/si');
            $table->timestamps();

						$table->index('venta_id');
            $table->index('tipo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('venta_items');
    }
};
