<?php

namespace App\Http\Controllers;

use App\Despesa;
use App\Exports\DespesaExport;
use App\Http\Requests\DespesaRequest;
use App\Services\Session;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;


class DespesaController extends Controller
{
    private $tableLayout;

    public function __construct()
    {
        $this->tableLayout =  true;
    }


    public function index(Request $request)
    {

        $tableLayout = $this->tableLayout;
        //DB::enableQueryLog();
        $despesas = Despesa::query()
            ->where('empresa_id', session()->get('empresaAtual'))
            ->where('data_cadastro', '<=', date('Y-m-d',session()->get('tableDataFim')))
            ->where('data_cadastro', '>=', date('Y-m-d',session()->get('tableDataInicio')))
            ->orderBy('data_cadastro','desc')->get();
        //$queries = DB::getQueryLog();
        //$last_query = end($queries);
//        dd($last_query);

        $mensagemAlerta = $request->session()->get("mensagemAlerta");

        return view(
            "despesas.index",
            compact(
                'tableLayout',
                'despesas',
                'mensagemAlerta'
            )
        );
    }

    public function store(DespesaRequest $request)
    {

        $data = $request->except('_token');
        //dd($data);
        Despesa::create($data);
        $request->session()->flash('mensagemAlerta', "Despesa adicionada com sucesso!");
        return redirect()->route('despesas.index');
    }

    public function update(DespesaRequest $request, Despesa $despesa)
    {
        $despesa->data_cadastro = $request->data_cadastro;
        $despesa->tipo_despesa_id = $request->tipo_despesa_id;
        $despesa->valor = $request->valor;
        $despesa->historico = $request->historico;
        $despesa->empresa_id = $request->empresa_id;
        $despesa->save();
        $request->session()->flash('mensagemAlerta', "A Tipo Depesa alterado com sucesso!");
        return redirect()->route('despesas.index');
    }

    public function destroy(int $id, Request $request)
    {
        Despesa::destroy($id);
        $request->session()->flash('mensagemAlerta', "Despesa removida com sucesso!");

        return redirect()->route('despesas.index');
    }

    public function setaIntervaloTable(Request $request, Session $sessoes)
    {

        $data = $request->except('_token');
        $sessoes->getIntervaloBuscaGrid($data);
        return redirect()->route('despesas.index');
    }

    public function exportExcelDespesas(Request $request)
    {

        //dd(new DespesaExport());
        return Excel::download(new DespesaExport, 'despesas'.Carbon::now().'.xlsx');
    }

}
