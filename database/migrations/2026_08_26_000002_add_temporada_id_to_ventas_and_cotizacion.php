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
        Schema::table('ventas', function (Blueprint $table) {
            $table->unsignedBigInteger('temporada_id')->nullable()->after('departamento_id');
        });

        Schema::table('cotizacion', function (Blueprint $table) {
            $table->unsignedBigInteger('temporada_id')->nullable()->after('departamento_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ventas', function (Blueprint $table) {
            $table->dropColumn('temporada_id');
        });

        Schema::table('cotizacion', function (Blueprint $table) {
            $table->dropColumn('temporada_id');
        });
    }
};
