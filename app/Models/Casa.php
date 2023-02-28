<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Casa extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'observacion', 'saldo',
    ];

    public function habitantes() {
        return $this->belongsToMany(User::class,'user_casa');
    }
    public function owners() {
        return $this->belongsToMany(User::class,'user_casa')->where('users.propietario',1)->where('users.status',1);
    }
  
    public function pagos()
    {
        return $this->hasMany(Pago::class);
    }
    
    public function vehiculos()
    {
        return $this->hasMany(Vehiculo::class);
    }
    
}
