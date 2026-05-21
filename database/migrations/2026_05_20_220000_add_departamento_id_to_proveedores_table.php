<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('proveedores', function (Blueprint $table) {
            if (!Schema::hasColumn('proveedores', 'departamento_id')) {
                $table->foreignId('departamento_id')->nullable()->after('categoria')->constrained('departamentos')->nullOnDelete();
                $table->index('departamento_id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('proveedores', function (Blueprint $table) {
            if (Schema::hasColumn('proveedores', 'departamento_id')) {
                $table->dropForeign(['departamento_id']);
                $table->dropIndex(['departamento_id']);
                $table->dropColumn('departamento_id');
            }
        });
    }
};
