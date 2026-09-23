<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Permite múltiples registros con la misma clave (p. ej. varias temporadas).
     */
    public function up(): void
    {
        Schema::table('configuraciones', function (Blueprint $table) {
            $table->dropUnique('configuraciones_clave_unique');
            $table->index('clave');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('configuraciones', function (Blueprint $table) {
            $table->dropIndex(['clave']);
            $table->unique('clave');
        });
    }
};