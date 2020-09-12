<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PlanoContaRequest extends FormRequest
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
            'conta_contabil' => [
                'required',
                'min:3',
                Rule::unique('plano_contas')->where(function ($query) use($request){
                    return $query->where('empresa_id', $request->empresa_id);
                }),
            ],
            'empresa_id' => 'required',
            'descricao' => [
                'required',
                Rule::unique('plano_contas')->where(function ($query) use($request){
                    return $query->where('empresa_id', $request->empresa_id);
                }),
            ]
        ];

    }
}
