<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlanoContaEditarRequest;
use App\Http\Requests\PlanoContaRequest;
use App\PlanoConta;
use Illuminate\Http\Request;

class PlanoContaController extends Controller
{
    private $tableLayout;
    public function __construct()
    {
        $this->tableLayout = true;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tableLayout = $this->tableLayout;
        $planoContas = PlanoConta::query()->where("empresa_id",session()->get('empresaAtual'))->orderBy('descricao')->get();
        $mensagemAlerta = $request->session()->get("mensagemAlerta");
        return view("plano-contas.index", compact('tableLayout', 'planoContas', 'mensagemAlerta'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PlanoContaRequest $request)
    {
        //pego todas variaveis do request menos o token
        $data = $request->except('_token');
        //cria um user e ja instancia ele
        $planoContas = PlanoConta::create($data);
        //flash mensagem top
        $request->session()->flash('mensagemAlerta', "Conta ". $planoContas->descricao ." cadastrada com sucesso!" );

        return redirect()->route('plano-contas.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PlanoConta  $planoConta
     * @return \Illuminate\Http\Response
     */
    public function update(PlanoContaEditarRequest $request, PlanoConta $planoConta)
    {
        //$planoConta = Empresa::find($planoContaId);
        $planoConta->descricao = $request->descricao;
        $planoConta->conta_contabil = $request->conta_contabil;
        $planoConta->empresa_id = $request->empresa_id;

        $planoConta->save();
        $request->session()->flash('mensagemAlerta', "Conta alterada com sucesso!");
        return redirect()->route('plano-contas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PlanoConta  $planoConta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,int $id)
    {
        PlanoConta::destroy($id);
        $request->session()->flash('mensagemAlerta', "Conta removida com sucesso!");

        return redirect()->route('plano-contas.index');
    }

    public function retornaContas()
    {
        $planoContas = PlanoConta::query()->where("empresa_id",session()->get('empresaAtual'))->orderBy('descricao')->get();
        return json_encode($planoContas);
    }
}
