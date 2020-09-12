<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    public $timestamps = false;
    protected $fillable = ['data_cadastro','documento','descricao','empresa_id'];
    protected $table = 'documentos';

    public function empresa()
    {
        return $this->belongsTo(Empresa::class,'empresa_id', 'id');
    }

}
