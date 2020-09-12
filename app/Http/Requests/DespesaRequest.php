<?php

namespace App\Http\Requests;

use App\Services\Util;
use Illuminate\Foundation\Http\FormRequest;

class DespesaRequest extends FormRequest
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
    public function rules()
    {
        $this->tratar();

        return [
            "data_cadastro" => 'required',
            "tipo_despesa_id" => "required",
            "valor" => "required",
            "historico" => "required",
            "empresa_id" => "required"
        ];
    }

    protected function tratar()
    {
        $data = $this->all();
        $data['data_cadastro'] = date('Y-m-d',strtotime(Util::validaData($data['data_cadastro'])));

        $data['valor'] = floatval(str_replace(',', '.', str_replace('.','',$data['valor'])));
        $data['historico'] = strtoupper($data['historico']);

        $this->replace($data);

    }

}
