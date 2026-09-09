<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Permite registrar pagos de proveedores (cobros/egresos) sin venta asociada.
     */
    public function up(): void
    {
        Schema::table('pagos', function (Blueprint $table) {
            $table->dropForeign(['venta_id']);
            $table->dropIndex(['venta_id']);
            $table->foreignId('venta_id')->nullable()->change();
            $table->foreignId('proveedor_id')->nullable()->after('venta_id')->constrained('proveedores')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('pagos', function (Blueprint $table) {
            $table->dropForeign(['proveedor_id']);
            $table->dropColumn('proveedor_id');
            $table->foreignId('venta_id')->nullable(false)->change();
            $table->foreign('venta_id')->references('id')->on('ventas')->onDelete('cascade');
        });
    }
};