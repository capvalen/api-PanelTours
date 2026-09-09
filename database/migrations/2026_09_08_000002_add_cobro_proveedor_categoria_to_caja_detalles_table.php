<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Agrega la categoría 'cobro a proveedor' al enum de caja_detalles.
     */
    public function up(): void
    {
        DB::statement("ALTER TABLE caja_detalles MODIFY categoria ENUM('ingreso','salida','venta', 'gasto operativo', 'servicios básicos', 'pago de personal', 'pago de proveedores', 'pago de comisión', 'cobro a proveedor', 'otros') NOT NULL");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE caja_detalles MODIFY categoria ENUM('ingreso','salida','venta', 'gasto operativo', 'servicios básicos', 'pago de personal', 'pago de proveedores', 'pago de comisión', 'otros') NOT NULL");
    }
};