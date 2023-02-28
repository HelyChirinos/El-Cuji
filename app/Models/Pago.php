<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;
    protected $guarded = [];   

    public function casa()
    {
        return $this->belongsTo(Casa::class);
    }
}
