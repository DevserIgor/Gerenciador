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

    public function planoContas()
    {
        return $this->hasMany(PlanoConta::class, 'empresa_id', 'id');
    }

    public function tiposDespesas()
    {
        return $this->hasMany(TipoDespesa::class, 'empresa_id', 'id');
    }

    public function usersResponsaveis()
    {
        return $this->belongsToMany(Empresa::class,'usuarios_empresas', 'empresa_id', 'user_id');
    }

    public function documentos()
    {
        return $this->hasMany(Documento::class, 'empresa_id', 'id');
    }
}
