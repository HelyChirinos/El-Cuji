<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fondo_Detalle extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'fondo_detalles';    

    public function factura()
    {
        return $this->belongsTo(Factura::class);
    }
    
    public function fondo()
    {
        return $this->belongsTo(Fondo::class);
    }    

}
