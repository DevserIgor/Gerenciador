<?php

namespace App\Http\Controllers;

use App\Documento;
use App\Http\Requests\DocumentoRequest;
use App\Services\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentoController extends Controller
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
        $documentos = Documento::query()
            ->where('empresa_id', session()->get('empresaAtual'))
            ->where('data_cadastro', '<=', date('Y-m-d',session()->get('tableDataFim')))
            ->where('data_cadastro', '>=', date('Y-m-d',session()->get('tableDataInicio')))
            ->orderBy('data_cadastro','desc')->get();

        $mensagemAlerta = $request->session()->get("mensagemAlerta");

        return view(
            "documentos.index",
            compact(
                'tableLayout',
                'documentos',
                'mensagemAlerta'
            )
        );

    }
        public function store(DocumentoRequest $request)
    {
        $data = $request->except('_token');
        $data['documento'] = $data['documento']->store('documentos/'.session()->get('empresaAtual'));
        Documento::create($data);
        $request->session()->flash('mensagemAlerta', "Doceumento adicionado com sucesso!");
        return redirect()->route('documentos.index');
    }

    public function update(DocumentoRequest $request, Documento $documento)
    {
        $documento->documento = $request->documento;
        $documento->descricao = $request->descricao;
        $documento->empresa_id = $request->empresa_id;
        $documento->save();
        $request->session()->flash('mensagemAlerta', "O  documento foi alterado com sucesso!");
        return redirect()->route('documentos.index');
    }


    public function destroy(int $id, Request $request)
    {
        $documento = Documento::find($id);
        if(Documento::destroy($id)){
            Storage::delete($documento->documento);
        };
        $request->session()->flash('mensagemAlerta', "Documento removido com sucesso!");

        return redirect()->route('documentos.index');
    }

    public function setaIntervaloTable(Request $request, Session $sessoes)
    {

        $data = $request->except('_token');
        $sessoes->getIntervaloBuscaGrid($data);
        return redirect()->route('documentos.index');
    }
}
