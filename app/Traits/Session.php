<?php


namespace App\Traits;



use App\Services\BuscadorEmpresasDisponiveisUsuario;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait Session
{
    public $empresas;
    public $empresaAtual;
    public function __construct(BuscadorEmpresasDisponiveisUsuario $buscadorEmpresas)
    {
        $this->empresas = $buscadorEmpresas->permissoesEmpresasUser();
        session()->put('empresasUsuario', $this->empresas);
        $this->empresaAtual = $this->sessionEmpresaAtual();
        dd($this->empresas);
    }

    public function sessionEmpresaAtual()
    {
        if(session()->has('empresaAtual')){
            return session()->get('empresaAtual');
        }

        return $this->setEmpresaAtualSession();
    }

    public function setEmpresaAtualSession()
    {
        if (auth()->user()->tipo === 'user'){
            session()->put('empresaAtual', $this->empresas->id);
            return session()->get('empresaAtual');
        }
        return $this->verificaArrayEmpresasDisponiveis();
    }

    public function verificaArrayEmpresasDisponiveis()
    {
        if (!empty($this->empresas)){
            session()->put('empresaAtual', $this->empresas_disponiveis[0]->id );
            return session()->get('empresaAtual');
        }
    }
}
