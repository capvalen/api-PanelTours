<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cotizacion', function (Blueprint $table) {
            $table->text('ruta')->nullable()->after('nacionalidad');
            $table->json('servicios')->nullable()->default('[]')->after('ruta');
            $table->json('incluye')->nullable()->default('[]')->after('servicios');
            $table->json('no_incluye')->nullable()->default('[]')->after('incluye');
        });

        Schema::table('ventas', function (Blueprint $table) {
            $table->text('ruta')->nullable()->after('nacionalidad');
            $table->json('servicios')->nullable()->default('[]')->after('ruta');
            $table->json('incluye')->nullable()->default('[]')->after('servicios');
            $table->json('no_incluye')->nullable()->default('[]')->after('incluye');
        });
    }

    public function down(): void
    {
        Schema::table('cotizacion', function (Blueprint $table) {
            $table->dropColumn(['ruta', 'servicios', 'incluye', 'no_incluye']);
        });

        Schema::table('ventas', function (Blueprint $table) {
            $table->dropColumn(['ruta', 'servicios', 'incluye', 'no_incluye']);
        });
    }
};
