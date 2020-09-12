<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'tipo', 'empresa_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class,'empresa_id', 'id');
    }

    public function empresas()
    {
        return $this->belongsToMany(Empresa::class,'usuarios_empresas', 'user_id', 'empresa_id');
    }

    public function hasEmpresa($empresaId){
        $empresas = $this->empresas;
        foreach($empresas as $empresa){
            if($empresa->id === $empresaId){
                return true;
            }
        }

        return false;

    }
}
