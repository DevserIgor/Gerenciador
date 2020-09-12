<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlanoConta extends Model
{
    public $timestamps = false;
    protected $fillable = ['descricao','conta_contabil', 'empresa_id'];

    public function tipoDespesas()
    {
        return $this->hasMany(TipoDespesa::class, 'plano_conta_id', 'id');
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id', 'id');
    }
}
