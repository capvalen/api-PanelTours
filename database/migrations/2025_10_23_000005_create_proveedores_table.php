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
        Schema::create('proveedores', function (Blueprint $table) {
            $table->id();
						$table->string('ruc', 11)->unique();
            $table->string('razon_social');
            $table->text('direccion')->nullable();
            $table->string('contacto')->nullable();
            $table->string('celular', 20)->nullable();
            $table->string('cuenta_bancaria')->nullable();
            $table->string('numero_cuenta', 30)->nullable();
            $table->enum('categoria', ['alojamiento', 'transporte', 'restaurant', 'local', 'agencia'])->nullable();
            $table->json('archivos')->nullable();
						$table->boolean('activo')->default(true)->comment('no/si');
            $table->timestamps();

						$table->index('ruc');
            $table->index('categoria');
            $table->index('activo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proveedores');
    }
};
