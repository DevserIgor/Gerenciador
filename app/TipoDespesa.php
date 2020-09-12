<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoDespesa extends Model
{
    public $timestamps = false;
    protected $fillable = ['descricao','plano_conta_id', 'empresa_id'];
    protected $table = 'tipos_despesas';

    public function planoConta()
    {
        return $this->belongsTo(PlanoConta::class,'plano_conta_id', 'id');
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class,'empresa_id', 'id');
    }

    public function despesas()
    {
        return $this->hasMany(Despesa::class, 'tipo_despesa_id', 'id');
    }

}
