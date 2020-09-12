<?php

namespace App\Http\Requests;

use App\Services\Util;
use Illuminate\Foundation\Http\FormRequest;

class DocumentoRequest extends FormRequest
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
            "descricao" => "required",
            "empresa_id" => "required"
        ];
    }

    protected function tratar()
    {
        $data = $this->all();
        $data['documento'] = $this->file('documento');
        $data['data_cadastro'] = date('Y-m-d');
        $encoding = 'UTF-8'; // ou ISO-8859-1...
        $descricao =mb_convert_case(strtoupper($data['descricao']), MB_CASE_UPPER, $encoding);
        $data['descricao'] = $descricao;

        $this->replace($data);

    }
}
