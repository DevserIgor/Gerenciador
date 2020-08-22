<?php

namespace App\Http\Controllers;

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
        $tiposDespesas = TipoDespesa::query()->orderBy('descricao')->get();
        $mensagemAlerta = $request->session()->get("mensagemAlerta");
        return view("tipoDespesas.index", compact('tableLayout', 'tiposDespesas', 'mensagemAlerta'));
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');
        $tipoDespesa = TipoDespesa::create($data);
        $request->session()->flash('mensagemAlerta', "O Tipo de Despesas '{$tipoDespesa->descricao}' criada com sucesso!");
        return redirect()->route('tipoDespesas.index');
    }
}
