<?php

namespace App\Http\Controllers;

use App\Http\Requests\TipoDespesaEditarRequest;
use App\Http\Requests\TipoDespesaRequest;
use App\PlanoConta;
use App\TipoDespesa;
use Illuminate\Http\Request;

class TipoDespesaController extends Controller
{
    private $tableLayout;

    public function __construct()
    {
        $this->tableLayout =  true;
    }

    public function index(Request $request)
    {
        $tableLayout = $this->tableLayout;
        $tipoDespesas = TipoDespesa::query()->where('empresa_id', session()->get('empresaAtual'))->orderBy('descricao')->get();
        $mensagemAlerta = $request->session()->get("mensagemAlerta");
        return view("tipo-despesas.index", compact('tableLayout', 'tipoDespesas', 'mensagemAlerta'));
    }

    public function store(TipoDespesaRequest $request)
    {
        $data = $request->except('_token');
        $tipoDespesa = TipoDespesa::create($data);
        $request->session()->flash('mensagemAlerta', "O Tipo de Despesas '{$tipoDespesa->descricao}' criada com sucesso!");
        return redirect()->route('tipo-despesas.index');
    }

    public function update(TipoDespesaEditarRequest $request, TipoDespesa $tipoDespesa)
    {
        //$tipoDespesa = TipoDespesa::find($tipoDespesaID);
        $tipoDespesa->descricao = $request->descricao;
        $tipoDespesa->plano_conta_id = $request->plano_conta_id;
        $tipoDespesa->empresa_id = $request->empresa_id;

        $tipoDespesa->save();
        $request->session()->flash('mensagemAlerta', "A Tipo Depesa alterado com sucesso!");
        return redirect()->route('tipo-despesas.index');
    }

    public function destroy(int $id, Request $request)
    {
        TipoDespesa::destroy($id);
        $request->session()->flash('mensagemAlerta', "Tipo de Despesa removida com sucesso");

        return redirect()->route('tipo-despesas.index');
    }

    public function retornaTipoDespesas()
    {
        $tipoDespesas =  TipoDespesa::query()
            ->where("empresa_id",session()->get('empresaAtual'))->orderBy('descricao')
            ->with('planoConta')
            ->get();

        return json_encode($tipoDespesas);
    }
}
