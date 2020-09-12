<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TipoDespesaEditarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        return [
            "descricao" => [
                "required",
                "min:3",
                "exclude_if:descricao,{$request->descricao}",
                Rule::unique('tipos_despesas')->where(function ($query) use($request){
                    return $query->where('empresa_id', $request->empresa_id);
                }),
            ],
            "plano_conta_id" => "required",
            "empresa_id" => "required",
        ];
    }
}
