<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Agrega archivos adjuntos (JSON) a la tabla pagos (cobros de proveedores).
     */
    public function up(): void
    {
        Schema::table('pagos', function (Blueprint $table) {
            $table->json('archivos')->nullable()->after('codigo_referencia');
        });
    }

    public function down(): void
    {
        Schema::table('pagos', function (Blueprint $table) {
            $table->dropColumn('archivos');
        });
    }
};