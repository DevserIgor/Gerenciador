<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoDespesa extends Model
{
    public $timestamps = false;
    protected $fillable = ['descricao','conta'];
    protected $table = 'tipos_despesas';
}
