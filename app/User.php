<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens,Notifiable, SoftDeletes;

    const USUARIO_VERIFICADO = '1';
    const USUARIO_NO_VERIFICADO = '0';

    const USUARIO_ADMINISTRADOR = 'true';
    const USUARIO_REGULAR = 'false';

    protected $table = 'users';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'verified',
        'verification_token',
        'admin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
//        'verification_token',
        'remember_token'
    ];

    protected $dates = ['deleted_at'];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtolower($value);
    }

    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = strtolower($value);
    }

    public function getNameAttribute($value)
    {
        return ucwords($value);
    }


    public function esVerificado()
    {
        return $this->verified == User::USUARIO_VERIFICADO;
    }

    public function esAdministrador()
    {
        return $this->admin == User::USUARIO_ADMINISTRADOR;
    }

    public static function generateVerificationToken()
    {
        return str_random(40);
    }
}
