<?php

namespace App\Http\Controllers;

use App\Empresa;
use App\Http\Requests\EmpresaEditarRequest;
use App\Http\Requests\EmpresaRequest;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    private $tableLayout;
    public function __construct()
    {
        $this->tableLayout = true;
    }

    public function index(Request $request)
    {
        $tableLayout = $this->tableLayout;
        $empresas = Empresa::query()->orderBy('nome')->get();
        $mensagemAlerta = $request->session()->get("mensagemAlerta");
        return view("empresas.index", compact('tableLayout', 'empresas', 'mensagemAlerta'));
    }

    public function store( EmpresaRequest $request )
    {
        //pego todas variaveis do request menos o token
        $data = $request->except('_token');
        //cria um user e ja instancia ele
        $empresa = Empresa::create($data);
        //flash mensagem top
        $request->session()->flash('mensagemAlerta', "Empresa ". $empresa->nome ." cadastrada com sucesso!" );

        return redirect()->route('empresas.index');
    }

    public function update(EmpresaEditarRequest $request, Empresa $empresa)
    {
        //$empresa = Empresa::find($empresaId);
        $empresa->nro_empresa = $request->nro_empresa;
        $empresa->cnpj = $request->cnpj;
        $empresa->nome = $request->nome;
        $empresa->save();
        $request->session()->flash('mensagemAlerta', "Empresa alterada com sucesso!");
        return redirect()->route('empresas.index');

    }

    public function destroy(int $id, Request $request)
    {
        Empresa::destroy($id);
        $request->session()->flash('mensagemAlerta', "Empresa removida com sucesso!");

        return redirect()->route('empresas.index');
    }

    public function retornaEmpresas()
    {
        $empresas = Empresa::query()->orderBy('nome')->get();
        return json_encode($empresas);
    }
}
