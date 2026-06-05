<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('personas', function (Blueprint $table) {
            $table->string('celular', 20)->nullable()->after('pedido_especial');
            $table->string('contacto_emergencia', 150)->nullable()->after('celular');
            $table->string('celular_emergencia', 20)->nullable()->after('contacto_emergencia');
        });
    }

    public function down(): void
    {
        Schema::table('personas', function (Blueprint $table) {
            $table->dropColumn(['celular', 'contacto_emergencia', 'celular_emergencia']);
        });
    }
};
