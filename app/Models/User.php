<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    protected $fillable = [
        'nombre',
        'apellido',
        'cedula',
        'email',
        'password',
        'telefono',
        'fecha_nac',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * Cast.
     */
    protected $casts = [
        'email_verified_at' => 'datetime:d-m-y',
        'created_at' => 'datetime:d-m-y',
        'updated_at' => 'datetime:d-m-y',
    ];

    /**
     * Relaciones ER .
     */


    public function casas() {
        return $this->belongsToMany(Casa::class,'user_casa');
    }


   /**
     * Accessors y Mutators.
     */

    public function setNombreAttribute($value)
    {
        $this->attributes['nombre'] = ucwords(trim(strtolower($value)));
    }

    public function setApellidoAttribute($value)
    {
       $this->attributes['apellido'] = ucwords(trim(strtolower($value)));
    }


    public function getFullNameAttribute()
    {
        return $this->nombre . ' ' . $this->apellido;
    }

    public function getIsPropietarioAttribute()
    {
        return $this->propietario = 1;
    }

    public function getNameAttribute()
    {
        $nombre = strpos(trim($this->nombre)," ") ? substr($this->nombre,0,strpos(trim($this->nombre)," ")) : trim($this->nombre);
        $apellido = strpos(trim($this->apellido)," ") ? substr($this->apellido,0,strpos(trim($this->apellido)," ")) : trim($this->apellido);
        return $nombre . ' ' . $apellido;
    }

    /**
     * Appends .
     */
 
    protected $appends = [
        'profile_photo_url', 'name',
    ];
}
