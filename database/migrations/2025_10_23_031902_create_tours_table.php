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
        Schema::create('tours', function (Blueprint $table) {
            $table->id();
						$table->text('contenido');
            $table->tinyInteger('visible')->default(1);
            $table->tinyInteger('activo')->default(1);
            $table->string('url', 1000);
            $table->integer('tipo');
            $table->integer('pais');
            $table->dateTime('registro');
            $table->float('calificacion')->nullable();
            $table->integer('votantes')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tours');
    }
};
