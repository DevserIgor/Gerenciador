<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class TipoDespesaRequest extends FormRequest
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
//        $data= $request;
//        $v = Validator::make($data, [
//            "descricao" => Rule::unique('tipos_despesas')->where(function ($query) use($request){
//                return $query->where('empresa_id', $request->empresa_id);
//            }),
//            "plano_conta_id" => "required",
//            "empresa_id" => "required",
//        ]);
//        return $v;
        return [
            "descricao" => [
                'required',
                'min:2',
                Rule::unique('tipos_despesas')->where(function ($query) use($request){
                    return $query->where('empresa_id', $request->empresa_id);
                }),
            ],
            "plano_conta_id" => "required",
            "empresa_id" => "required",
        ];
    }
}
