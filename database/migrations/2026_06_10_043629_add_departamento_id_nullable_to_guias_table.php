<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('guias', function (Blueprint $table) {
            $table->dropForeign(['departamento_id']);
            $table->foreignId('departamento_id')->nullable()->change();
            $table->foreign('departamento_id')->references('id')->on('departamentos')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('guias', function (Blueprint $table) {
            $table->dropForeign(['departamento_id']);
            $table->foreignId('departamento_id')->nullable(false)->change();
            $table->foreign('departamento_id')->references('id')->on('departamentos')->onDelete('cascade');
        });
    }
};
