<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle extends Model
{
    use HasFactory;
    protected $guarded = [];    

    public function factura()
    {
        return $this->belongsTo(Factura::class);
    }
    
    public function gasto()
    {
        return $this->belongsTo(Gasto::class);
    }
}
