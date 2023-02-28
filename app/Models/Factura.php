<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;
    protected $guarded = [];    

    public function detalles()
    {
        return $this->hasMany(Detalle::class);
    }

    public function fondo_detalles()
    {
        return $this->hasMany(Fondo_Detalle::class);
    }

}
