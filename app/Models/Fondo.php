<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fondo extends Model
{
    use HasFactory;
    protected $fillable = [
        'descripcion',
        'monto',
        'tipo',
        'activo',
    ];        

    public function fondo_detalles()
    {
        return $this->hasMany(Fondo_Detalle::class);
    }
}
