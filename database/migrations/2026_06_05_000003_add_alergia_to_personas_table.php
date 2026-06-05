<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('personas', function (Blueprint $table) {
            $table->enum('alergia', ['si', 'no'])->default('no')->after('detalle_enfermedades');
            $table->text('detalle_alergia')->nullable()->after('alergia');
            $table->text('pedido_especial')->nullable()->after('detalle_alergia');
        });
    }

    public function down(): void
    {
        Schema::table('personas', function (Blueprint $table) {
            $table->dropColumn(['alergia', 'detalle_alergia', 'pedido_especial']);
        });
    }
};
