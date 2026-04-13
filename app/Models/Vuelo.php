<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vuelo extends Model
{
    use HasFactory;

    protected $table = 'vuelos';

    protected $fillable = [
        'vuelo', 'observaciones', 'activo',
    ];

    protected $casts = [
        'activo' => 'boolean',
    ];
        // Sobrescribe la consulta base
    protected static function boot()
    {
        parent::boot();
        
        static::addGlobalScope('activo', function ($query) {
            $query->where('activo', 1);
        });
    }
    
}
