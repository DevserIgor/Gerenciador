<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Despesa extends Model
{
    public $timestamps = false;
    protected $fillable = ['data_cadastro','tipo_despesa_id','valor','historico', 'empresa_id'];
    protected $table = 'despesas';

    public function tipo_despesa()
    {
        return $this->belongsTo(TipoDespesa::class,'tipo_despesa_id', 'id');
    }
}
