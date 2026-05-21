<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accion extends Model
{
    use HasFactory;

    protected $table = 'acciones';

    protected $fillable = [
        'nombre',
    ];

    public function seguimientos()
    {
        return $this->hasMany(Seguimiento::class, 'accion_id');
    }
}
