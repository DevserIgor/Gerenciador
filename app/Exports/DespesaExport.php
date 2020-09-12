<?php

namespace App\Exports;

use App\Despesa;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DespesaExport implements FromView
{

    public function view(): View
    {
        $despesas =  Despesa::query()
            ->where('empresa_id', session()->get('empresaAtual'))
            ->where('data_cadastro', '<=', date('Y-m-d',session()->get('tableDataFim')))
            ->where('data_cadastro', '>=', date('Y-m-d',session()->get('tableDataInicio')))
            ->orderBy('data_cadastro','desc')->get();

        return view('despesas.despesaExport', compact('despesas'));
    }

}
