<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('vehiculos', function (Blueprint $table) {
            $table->string('banco')->nullable()->after('seguro');
            $table->string('numero_cuenta', 30)->nullable()->after('banco');
            $table->string('aplicativo')->nullable()->after('numero_cuenta');
            $table->string('propietario_aplicativo')->nullable()->after('aplicativo');
        });
    }

    public function down(): void
    {
        Schema::table('vehiculos', function (Blueprint $table) {
            $table->dropColumn(['banco', 'numero_cuenta', 'aplicativo', 'propietario_aplicativo']);
        });
    }
};
