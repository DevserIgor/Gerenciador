<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class EmpresaEditarRequest extends FormRequest
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
            "nro_empresa" => "required|exclude_if:nro_empresa,{$request->nro_empresa}|unique:empresas",
            "cnpj" => "required|exclude_if:cnpj,{$request->cnpj}|unique:empresas",
            "nome" => "required|exclude_if:nome,{$request->nome}|unique:empresas"
        ];
    }
}
