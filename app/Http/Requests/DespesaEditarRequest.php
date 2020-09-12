<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DespesaEditarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
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

        try {
            $data['data_cadastro'] = date('Y-m-d', strtotime($data['data_cadastro']));
            $data['valor'] = floatval(str_replace(',', '.', str_replace('.','',$data['valor'])));
            $data['historico'] = strtoupper($data['historico']);

        }catch (\Exception $e){
            return $e->getMessage();
        }

        $this->replace($data);

    }
}
