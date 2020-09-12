<?php


namespace App\Services;


class Session
{
    public function buscarEmpresas()
    {
        session()->put('empresasUsuario', BuscadorEmpresasDisponiveisUsuario::permissoesEmpresasUser());

        return session()->get('empresasUsuario');
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
        $empresas = session()->get('empresasUsuario');
        if (auth()->user()->tipo === 'user'){
            session()->put('empresaAtual', $empresas->id);
            return session()->get('empresaAtual');
        }
        return $this->verificaArrayEmpresasDisponiveis();
    }

    public function verificaArrayEmpresasDisponiveis()
    {
        $empresas = session()->get('empresasUsuario');
        if (!empty($empresas) && count($empresas) > 0){
            session()->put('empresaAtual', $empresas[0]->id );
            return session()->get('empresaAtual');
        }
        return false;
    }

    public function getIntervaloBuscaGrid($intervalo = false)
    {
        if($intervalo){

            session()->put(
                'tableDataInicio',
                strtotime(Util::validaData($intervalo['tableDataInicio']))
            );
            session()->put(
                'tableDataFim',
                strtotime(Util::validaData($intervalo['tableDataFim']))
            );
        }
        if(!$this->verificaIntervaloBuscaGrid()){
            session()->put('tableDataInicio', mktime(0, 0, 0, date('m') , 1 , date('Y')) );
            session()->put('tableDataFim', mktime(23, 59, 59, date('m'), date("t"), date('Y')));
        }

        return [
            'tableDataInicio' => session()->get('tableDataInicio'),
            'tableDataFim' => session()->get('tableDataFim'),
        ];
    }

    public function verificaIntervaloBuscaGrid()
    {
        if(session()->has('tableDataInicio') && session()->has('tableDataFim')){
            return true;
        }
        return false;
    }

}
