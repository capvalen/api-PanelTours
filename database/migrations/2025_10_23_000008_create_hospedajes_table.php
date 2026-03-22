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
        Schema::create('hospedajes', function (Blueprint $table) {
            $table->id();
            $table->string('hospedaje');
            $table->string('direccion')->nullable();            $table->string('contacto')->nullable();
            $table->string('celular')->nullable();
            $table->string('correo')->nullable();
            $table->foreignId('departamento_id')->constrained('departamentos')->onDelete('cascade');
            $table->boolean('incluye_desayuno')->default(false);
            $table->boolean('incluye_estacionamiento')->default(false);
            $table->boolean('incluye_wifi')->default(true);
            $table->text('servicios_extra')->nullable()->comment('Spa, lavandería, etc.');

            $table->tinyInteger('activo')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hospedajes');
    }
};
