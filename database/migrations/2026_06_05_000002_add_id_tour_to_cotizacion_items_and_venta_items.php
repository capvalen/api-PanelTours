<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cotizacion_items', function (Blueprint $table) {
            $table->integer('id_tour')->nullable()->after('id');
        });

        Schema::table('venta_items', function (Blueprint $table) {
            $table->integer('id_tour')->nullable()->after('id');
        });
    }

    public function down(): void
    {
        Schema::table('cotizacion_items', function (Blueprint $table) {
            $table->dropColumn('id_tour');
        });

        Schema::table('venta_items', function (Blueprint $table) {
            $table->dropColumn('id_tour');
        });
    }
};
