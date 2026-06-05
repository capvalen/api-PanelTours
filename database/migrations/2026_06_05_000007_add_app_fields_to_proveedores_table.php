<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('proveedores', function (Blueprint $table) {
            $table->string('aplicativo')->nullable()->after('numero_cuenta');
            $table->string('propietario_aplicativo')->nullable()->after('aplicativo');
        });
    }

    public function down(): void
    {
        Schema::table('proveedores', function (Blueprint $table) {
            $table->dropColumn(['aplicativo', 'propietario_aplicativo']);
        });
    }
};
