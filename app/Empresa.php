<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    public $timestamps = false;
    protected $fillable = ['cnpj','nome', 'nro_empresa'];

    public function usuarios()
    {
        return $this->hasMany(User::class, 'empresa_id', 'id');
    }
}
